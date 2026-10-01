<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\UserTokenUsage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ChatController extends Controller
{
    private function getSystemPrompt(): string
    {
        return <<<PROMPT
Kamu adalah Sora (空 / そら), asisten AI resmi dari Aozora Nihongo Club (青空日本語部) — ekstrakurikuler bahasa dan kebudayaan Jepang di SMKN 1 Purwokerto, Banyumas, Jawa Tengah.

Informasi utama mengenai Aozora Nihongo Club:
- Sekolah: SMKN 1 Purwokerto (SMECO)
- Lokasi kegiatan: Ruang Kelas SMKN 1 Purwokerto, Jl. Dr. Soeparno No. 29, Karangwangkal, Purwokerto Timur, Banyumas 53123
- Jadwal kumpul rutin: Setiap hari Kamis, pukul 16.00 - 17.00 WIB
- Email resmi: noreplyaozora@gmail.com
- Media sosial: Instagram @ancsmecone, TikTok @ancsmecone, YouTube @ancsmecone
- Bidang/Divisi: Kaiwa (percakapan bahasa Jepang), Shodo (kaligrafi kanji), Cosplay & Costuming, Matsuri & Event Kebudayaan, Anime & Pop Culture Jepang
- Sistem Keanggotaan: Terbuka untuk seluruh siswa/i SMKN 1 Purwokerto yang tertarik belajar bahasa & kebudayaan Jepang.
- Moto: 一期一会 (Ichigo Ichie - setiap pertemuan berharga) & "Aozora: Blue Skies Ahead".

Kepribadian & Gaya Bicara Sora:
- Nama: Sora (artinya "Langit Biru", melambangkan keterbukaan dan harapan sesuai nama Aozora).
- Karakter: Ceria, sopan, antusias, ramah, dan sangat suportif layaknya sahabat/senpai yang menyenangkan.
- Bahasa: Utamanya menggunakan Bahasa Indonesia santun dan akrab, diselingi kata/frasa Bahasa Jepang ringan (seperti: Konnichiwa, Arigatou, Sugoi, Ganbatte, Yoroshiku, dsb.) dengan terjemahan bila perlu.
- Gunakan emoji bernuansa Jepang/ceria secukupnya (🌸, ✨, 🇯🇵, 🍵, 🎐, dsb.).
- Selalu siap membantu menjawab pertanyaan seputar klub Aozora, event, jadwal, kosa kata atau tata bahasa Jepang dasar, budaya Jepang, dan rekomendasi kegiatan.
- Jika ditanya di luar topik Aozora atau Jepang, jawab dengan ringkas dan sopan, lalu ajak kembali mengobrol santai seputar Aozora atau kebudayaan Jepang.

ATURAN PENTING:
- Jawab SINGKAT dan PADAT, idealnya 1-3 kalimat saja.
- Jangan mengulang pertanyaan user.
- Langsung ke inti jawaban, hindari basa-basi berlebihan.
- Jika topik butuh penjelasan panjang, berikan ringkasan singkat lalu tawarkan "Mau Sora jelaskan lebih detail?".
PROMPT;
    }

    /**
     * Build conversation prompt from message history.
     */
    private function buildPrompt(string $userText, string $sessionId, $user): string
    {
        $history = ChatMessage::where('user_id', $user->id)
            ->where('session_id', $sessionId)
            ->orderBy('id', 'asc')
            ->take(12)
            ->get();

        $conversationText = "";
        foreach ($history as $item) {
            $speaker = $item->role === 'user' ? ($user->name ?: 'Pengguna') : 'Sora';
            $conversationText .= "{$speaker}: {$item->content}\n";
        }

        return $this->getSystemPrompt() . "\n\nPercakapan terkini:\n" . $conversationText . "Sora: ";
    }

    /**
     * Get recent chat messages for current user/session.
     */
    public function history(Request $request): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json([
                'authenticated' => false,
                'messages' => [],
            ]);
        }

        $sessionId = $request->query('session_id');
        $dailyLimit = config('services.ai.daily_token_limit', 5000);

        $query = ChatMessage::where('user_id', Auth::id());
        if ($sessionId) {
            $query->where('session_id', $sessionId);
        }

        $messages = $query->orderBy('created_at', 'asc')
            ->take(40)
            ->get(['id', 'role', 'content', 'created_at'])
            ->map(function ($msg) {
                return [
                    'id' => $msg->id,
                    'role' => $msg->role,
                    'content' => $msg->content,
                    'time' => $msg->created_at->format('H:i'),
                ];
            });

        return response()->json([
            'authenticated' => true,
            'user' => [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'messages' => $messages,
            'token_remaining' => UserTokenUsage::remainingTokens(Auth::id(), $dailyLimit),
        ]);
    }

    /**
     * Send message to Sora AI with streaming response.
     * Proxies the Ollama NDJSON stream directly to the browser.
     */
    public function sendStream(Request $request): StreamedResponse
    {
        if (!Auth::check()) {
            return new StreamedResponse(function () {
                echo json_encode(['error' => 'Silakan masuk terlebih dahulu untuk ngobrol dengan Sora 🌸']) . "\n";
            }, 401, ['Content-Type' => 'text/plain']);
        }

        $request->validate([
            'message' => ['required', 'string', 'max:1000'],
            'session_id' => ['nullable', 'string', 'max:100'],
        ]);

        $user = Auth::user();
        $dailyLimit = config('services.ai.daily_token_limit', 5000);

        // Check daily token budget
        if (!UserTokenUsage::hasQuota($user->id, $dailyLimit)) {
            return new StreamedResponse(function () use ($user, $dailyLimit) {
                $remaining = UserTokenUsage::remainingTokens($user->id, $dailyLimit);
                echo json_encode([
                    'error' => 'Kuota harian Sora kamu sudah habis 🌸 Coba lagi besok ya!',
                    'quota_exceeded' => true,
                    'tokens_remaining' => $remaining,
                ]) . "\n";
            }, 429, ['Content-Type' => 'text/plain']);
        }

        $sessionId = $request->input('session_id') ?: ('sess_' . $user->id . '_' . date('Ymd'));
        $userText = trim($request->input('message'));

        // Save user message to database
        ChatMessage::create([
            'user_id' => $user->id,
            'role' => 'user',
            'content' => $userText,
            'session_id' => $sessionId,
        ]);

        // Build the full prompt
        $fullPrompt = $this->buildPrompt($userText, $sessionId, $user);

        $apiUrl = config('services.ai.url', 'http://ai.api.fahrimandriva.web.id/api/generate');
        $model = config('services.ai.model', 'qwen2.5:1.5b');
        $maxTokens = config('services.ai.max_tokens', 350);

        $payload = json_encode([
            'model' => $model,
            'prompt' => $fullPrompt,
            'stream' => true,
            'options' => [
                'num_predict' => $maxTokens,
                'temperature' => 0.7,
                'top_p' => 0.9,
            ],
        ]);

        $response = new StreamedResponse(function () use ($apiUrl, $payload, $user, $sessionId, $dailyLimit) {
            @set_time_limit(120);
            $fullReply = '';
            $totalEvalCount = 0;
            $lineBuffer = '';

            try {
                // Open a cURL stream to the Ollama API
                $ch = curl_init();
                curl_setopt_array($ch, [
                    CURLOPT_URL => $apiUrl,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $payload,
                    CURLOPT_HTTPHEADER => [
                        'Content-Type: application/json',
                        'Accept: application/x-ndjson, application/json',
                    ],
                    CURLOPT_RETURNTRANSFER => false,
                    CURLOPT_TIMEOUT => 60,
                    CURLOPT_CONNECTTIMEOUT => 10,
                    CURLOPT_WRITEFUNCTION => function ($ch, $chunk) use (&$fullReply, &$totalEvalCount, &$lineBuffer) {
                        $lineBuffer .= $chunk;
                        $lines = explode("\n", $lineBuffer);
                        // The last element might be incomplete; keep it in the buffer
                        $lineBuffer = array_pop($lines);

                        foreach ($lines as $line) {
                            $trimmed = trim($line);
                            if ($trimmed === '') continue;

                            $data = json_decode($trimmed, true);
                            if ($data) {
                                if (isset($data['response'])) {
                                    $fullReply .= $data['response'];
                                }
                                if (isset($data['done']) && $data['done'] === true) {
                                    $totalEvalCount = $data['eval_count'] ?? 0;
                                }
                            }

                            // Relay the line directly to the browser
                            echo $trimmed . "\n";
                            if (ob_get_level()) ob_flush();
                            flush();
                        }

                        return strlen($chunk);
                    },
                ]);

                $result = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $curlError = curl_error($ch);
                curl_close($ch);

                // Process any leftover content in lineBuffer
                if (!empty(trim($lineBuffer))) {
                    $trimmed = trim($lineBuffer);
                    $data = json_decode($trimmed, true);
                    if ($data) {
                        if (isset($data['response'])) {
                            $fullReply .= $data['response'];
                        }
                        if (isset($data['done']) && $data['done'] === true) {
                            $totalEvalCount = $data['eval_count'] ?? 0;
                        }
                    }
                    echo $trimmed . "\n";
                    if (ob_get_level()) ob_flush();
                    flush();
                }

                if ($result === false || $httpCode !== 200) {
                    Log::warning('AI stream failed', [
                        'http_code' => $httpCode,
                        'curl_error' => $curlError,
                    ]);

                    if (empty($fullReply)) {
                        $fullReply = 'Gomen ne 🌸 Sora sedang agak sibuk. Coba lagi sebentar lagi ya!';
                        echo json_encode(['response' => $fullReply, 'done' => true]) . "\n";
                        if (ob_get_level()) ob_flush();
                        flush();
                    }
                }

            } catch (Exception $e) {
                Log::error('AI stream exception: ' . $e->getMessage());
                $fullReply = 'Gomen ne 🌸 Koneksi ke Sora sedang terganggu sejenak.';
                echo json_encode(['response' => $fullReply, 'done' => true]) . "\n";
                if (ob_get_level()) ob_flush();
                flush();
            }

            // Save the complete assistant reply to database
            if (!empty(trim($fullReply))) {
                ChatMessage::create([
                    'user_id' => $user->id,
                    'role' => 'assistant',
                    'content' => trim($fullReply),
                    'session_id' => $sessionId,
                ]);

                // Track token usage
                if ($totalEvalCount > 0) {
                    UserTokenUsage::addTokens($user->id, $totalEvalCount);
                }
            }

            // Send a final metadata line so frontend knows remaining quota
            $remaining = UserTokenUsage::remainingTokens($user->id, $dailyLimit);
            echo json_encode([
                'sora_meta' => true,
                'tokens_used' => $totalEvalCount,
                'tokens_remaining' => $remaining,
            ]) . "\n";
            if (ob_get_level()) ob_flush();
            flush();

        }, 200, [
            'Content-Type' => 'text/plain; charset=utf-8',
            'Cache-Control' => 'no-cache',
            'X-Accel-Buffering' => 'no',
            'Connection' => 'keep-alive',
        ]);

        return $response;
    }

    /**
     * Send message to Sora AI (non-streaming fallback).
     */
    public function send(Request $request): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json([
                'error' => 'Silakan masuk terlebih dahulu untuk ngobrol dengan Sora 🌸',
            ], 401);
        }

        $request->validate([
            'message' => ['required', 'string', 'max:1000'],
            'session_id' => ['nullable', 'string', 'max:100'],
        ]);

        $user = Auth::user();
        $dailyLimit = config('services.ai.daily_token_limit', 5000);
        $sessionId = $request->input('session_id') ?: ('sess_' . $user->id . '_' . date('Ymd'));
        $userText = trim($request->input('message'));

        // Check daily token budget
        if (!UserTokenUsage::hasQuota($user->id, $dailyLimit)) {
            return response()->json([
                'error' => 'Kuota harian Sora kamu sudah habis 🌸 Coba lagi besok ya!',
                'quota_exceeded' => true,
            ], 429);
        }

        // Save user message to database
        ChatMessage::create([
            'user_id' => $user->id,
            'role' => 'user',
            'content' => $userText,
            'session_id' => $sessionId,
        ]);

        $fullPrompt = $this->buildPrompt($userText, $sessionId, $user);

        $apiUrl = config('services.ai.url', 'http://ai.api.fahrimandriva.web.id/api/generate');
        $model = config('services.ai.model', 'qwen2.5:1.5b');
        $maxTokens = config('services.ai.max_tokens', 350);

        try {
            $response = \Illuminate\Support\Facades\Http::timeout(50)->post($apiUrl, [
                'model' => $model,
                'prompt' => $fullPrompt,
                'stream' => false,
                'options' => [
                    'num_predict' => $maxTokens,
                    'temperature' => 0.7,
                    'top_p' => 0.9,
                ],
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = trim($data['response'] ?? '');
                $evalCount = $data['eval_count'] ?? 0;

                if (empty($reply)) {
                    $reply = "Konnichiwa! 🌸 Sora mendengarmu, tapi jawabannya kosong nih. Ada yang bisa kubantu lagi?";
                }

                // Track token usage
                if ($evalCount > 0) {
                    UserTokenUsage::addTokens($user->id, $evalCount);
                }
            } else {
                Log::warning('AI API non-200 response: ' . $response->body());
                $reply = "Gomen ne 🌸 Sora sedang agak sibuk melayani teman-teman lainnya. Boleh coba ketik ulang beberapa detik lagi?";
            }
        } catch (Exception $e) {
            Log::error('AI API request failed: ' . $e->getMessage());
            $reply = "Gomen ne 🌸 Koneksi ke Sora sedang terganggu sejenak. Pastikan koneksi internetmu lancar ya!";
        }

        // Save assistant reply
        $assistantMessage = ChatMessage::create([
            'user_id' => $user->id,
            'role' => 'assistant',
            'content' => $reply,
            'session_id' => $sessionId,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => [
                'id' => $assistantMessage->id,
                'role' => 'assistant',
                'content' => $reply,
                'time' => $assistantMessage->created_at->format('H:i'),
            ],
            'session_id' => $sessionId,
            'tokens_remaining' => UserTokenUsage::remainingTokens($user->id, $dailyLimit),
        ]);
    }

    /**
     * Clear chat history for user session.
     */
    public function clear(Request $request): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'unauthorized'], 401);
        }

        $sessionId = $request->input('session_id');
        $query = ChatMessage::where('user_id', Auth::id());
        if ($sessionId) {
            $query->where('session_id', $sessionId);
        }
        $query->delete();

        return response()->json(['status' => 'cleared']);
    }
}
