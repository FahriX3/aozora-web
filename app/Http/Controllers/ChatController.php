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
Kamu adalah Sora (空), siswi SMA virtual ceria sekaligus asisten AI dari ekstrakurikuler Aozora Nihongo Club di SMKN 1 Purwokerto (SMECO). Teman bicaramu adalah teman sekolahmu.

Info Singkat Klub Aozora:
- Lokasi: Ruang Kelas SMKN 1 Purwokerto, Jl. Dr. Soeparno No. 29, Purwokerto Timur
- Kumpul rutin: Setiap hari Kamis pukul 16.00 - 17.00 WIB
- Divisi: Percakapan (Kaiwa), Kaligrafi (Shodo), Cosplay, Matsuri (Festival Budaya), Anime & Manga
- Slogan: Ichigo Ichie (一期一会) & "Aozora: Blue Skies Ahead"

GAYA BICARA & ATURAN PENTING:
1. Bicara santai, ramah, dan seru seperti teman sebaya di sekolah. BUKAN bot customer service, BUKAN pidato upacara!
2. WAJIB selalu gunakan Bahasa Indonesia santai (DILARANG menggunakan Bahasa Inggris).
3. JAWAB SINGKAT DAN PADAT (cukup 1 sampai 2 kalimat saja untuk sapaan atau obrolan santai, maksimal 3 kalimat untuk pertanyaan biasa). DILARANG menulis paragraf panjang berbelit-belit!
4. Jika disapa ("hai", "halo", "p"), balas SINGKAT dan ceria, contoh: "Halo! Konnichiwa~ 🌸 Lagi santai atau ada yang mau kamu tanyain tentang klub Aozora nih?"
5. DILARANG menulis awalan nama seperti "Sora:", "AI:", atau "Asisten:".
6. Jangan mengulang-ulang nama pengguna di setiap kalimat.
PROMPT;
    }

    /**
     * Build messages array for Ollama /api/chat.
     */
    private function buildMessages(int $userId): array
    {
        $history = ChatMessage::where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get()
            ->reverse();

        $messages = [];
        $messages[] = [
            'role' => 'system',
            'content' => $this->getSystemPrompt(),
        ];

        foreach ($history as $item) {
            $content = trim($item->content);
            if ($item->role === 'assistant') {
                // Strip historical "Sora: " prefixes so past errors don't poison current context
                $content = preg_replace('/^(Sora|AI|Asisten):\s*/i', '', $content);
            }
            if (!empty($content)) {
                $messages[] = [
                    'role' => $item->role === 'user' ? 'user' : 'assistant',
                    'content' => $content,
                ];
            }
        }

        return $messages;
    }

    /**
     * Get recent chat messages for current user (unified across devices).
     */
    public function history(Request $request): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json([
                'authenticated' => false,
                'messages' => [],
            ]);
        }

        $dailyLimit = config('services.ai.daily_token_limit', 5000);

        // Unified cross-device history: query all recent messages for this user
        $messages = ChatMessage::where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->take(40)
            ->get(['id', 'role', 'content', 'created_at'])
            ->reverse()
            ->values()
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
            'daily_limit' => $dailyLimit,
            'token_remaining' => UserTokenUsage::remainingTokens(Auth::id(), $dailyLimit),
        ]);
    }

    /**
     * Send message to Sora AI with streaming response.
     * Proxies the Ollama /api/chat NDJSON stream directly to the browser.
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
                    'daily_limit' => $dailyLimit,
                    'tokens_remaining' => $remaining,
                ]) . "\n";
            }, 429, ['Content-Type' => 'text/plain']);
        }

        $sessionId = 'user_' . $user->id;
        $userText = trim($request->input('message'));

        // Save user message to database
        ChatMessage::create([
            'user_id' => $user->id,
            'role' => 'user',
            'content' => $userText,
            'session_id' => $sessionId,
        ]);

        // Build messages array for Ollama /api/chat
        $messages = $this->buildMessages($user->id);

        $apiUrl = config('services.ai.url', 'http://ai.api.fahrimandriva.web.id/api/chat');
        if (str_contains($apiUrl, '/api/generate')) {
            $apiUrl = str_replace('/api/generate', '/api/chat', $apiUrl);
        }

        $model = config('services.ai.model', 'qwen2.5:1.5b');
        $maxTokens = config('services.ai.max_tokens', 350);

        $payload = json_encode([
            'model' => $model,
            'messages' => $messages,
            'stream' => true,
            'options' => [
                'num_predict' => $maxTokens,
                'temperature' => 0.35,
                'top_p' => 0.8,
                'repeat_penalty' => 1.3,
                'repeat_last_n' => 128,
                'stop' => [
                    '<|im_end|>',
                    "\n" . ($user->name ?: 'Pengguna') . ":",
                    "\nUser:",
                    "\nPengguna:",
                    "\nHuman:",
                    "\nAssistant:",
                    "Sora:",
                ],
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
                                $chunkText = $data['message']['content'] ?? ($data['response'] ?? '');
                                if ($chunkText !== '') {
                                    $fullReply .= $chunkText;
                                }

                                if (isset($data['done']) && $data['done'] === true) {
                                    $totalEvalCount = $data['eval_count'] ?? 0;
                                }

                                // Relay normalized line to the browser
                                echo json_encode([
                                    'response' => $chunkText,
                                    'done' => $data['done'] ?? false,
                                ]) . "\n";
                            } else {
                                echo $trimmed . "\n";
                            }

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
                        $chunkText = $data['message']['content'] ?? ($data['response'] ?? '');
                        if ($chunkText !== '') {
                            $fullReply .= $chunkText;
                        }
                        if (isset($data['done']) && $data['done'] === true) {
                            $totalEvalCount = $data['eval_count'] ?? 0;
                        }
                        echo json_encode([
                            'response' => $chunkText,
                            'done' => $data['done'] ?? false,
                        ]) . "\n";
                    }
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

            // Save the complete assistant reply to database (stripping accidental 'Sora: ' prefix if present)
            $cleanReply = preg_replace('/^(Sora|AI|Asisten):\s*/i', '', trim($fullReply));
            if (!empty($cleanReply)) {
                ChatMessage::create([
                    'user_id' => $user->id,
                    'role' => 'assistant',
                    'content' => $cleanReply,
                    'session_id' => $sessionId,
                ]);

                // Track token usage
                if ($totalEvalCount > 0) {
                    UserTokenUsage::addTokens($user->id, $totalEvalCount);
                } elseif (mb_strlen($cleanReply) > 0) {
                    // Fallback token estimation if stream connection was interrupted before done flag
                    $fallbackTokens = max(1, (int) ceil(mb_strlen($cleanReply) / 3.5));
                    UserTokenUsage::addTokens($user->id, $fallbackTokens);
                    $totalEvalCount = $fallbackTokens;
                }
            }

            // Send a final metadata line so frontend knows remaining quota and daily limit
            $remaining = UserTokenUsage::remainingTokens($user->id, $dailyLimit);
            echo json_encode([
                'sora_meta' => true,
                'tokens_used' => $totalEvalCount,
                'daily_limit' => $dailyLimit,
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
        $sessionId = 'user_' . $user->id;
        $userText = trim($request->input('message'));

        // Check daily token budget
        if (!UserTokenUsage::hasQuota($user->id, $dailyLimit)) {
            return response()->json([
                'error' => 'Kuota harian Sora kamu sudah habis 🌸 Coba lagi besok ya!',
                'quota_exceeded' => true,
                'daily_limit' => $dailyLimit,
                'tokens_remaining' => UserTokenUsage::remainingTokens($user->id, $dailyLimit),
            ], 429);
        }

        // Save user message to database
        ChatMessage::create([
            'user_id' => $user->id,
            'role' => 'user',
            'content' => $userText,
            'session_id' => $sessionId,
        ]);

        $apiUrl = config('services.ai.url', 'http://ai.api.fahrimandriva.web.id/api/chat');
        if (str_contains($apiUrl, '/api/generate')) {
            $apiUrl = str_replace('/api/generate', '/api/chat', $apiUrl);
        }

        $model = config('services.ai.model', 'qwen2.5:1.5b');
        $maxTokens = config('services.ai.max_tokens', 350);
        $messages = $this->buildMessages($user->id);

        try {
            $response = \Illuminate\Support\Facades\Http::timeout(50)->post($apiUrl, [
                'model' => $model,
                'messages' => $messages,
                'stream' => false,
                'options' => [
                    'num_predict' => $maxTokens,
                    'temperature' => 0.35,
                    'top_p' => 0.8,
                    'repeat_penalty' => 1.3,
                    'repeat_last_n' => 128,
                    'stop' => [
                        '<|im_end|>',
                        "\n" . ($user->name ?: 'Pengguna') . ":",
                        "\nUser:",
                        "\nPengguna:",
                        "\nHuman:",
                        "\nAssistant:",
                        "Sora:",
                    ],
                ],
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = trim($data['message']['content'] ?? ($data['response'] ?? ''));
                $reply = preg_replace('/^(Sora|AI|Asisten):\s*/i', '', $reply);
                $evalCount = $data['eval_count'] ?? 0;

                if (empty($reply)) {
                    $reply = "Konnichiwa! 🌸 Sora mendengarmu, tapi jawabannya kosong nih. Ada yang bisa kubantu lagi?";
                }

                // Track token usage
                if ($evalCount > 0) {
                    UserTokenUsage::addTokens($user->id, $evalCount);
                } elseif (mb_strlen($reply) > 0) {
                    $fallbackTokens = max(1, (int) ceil(mb_strlen($reply) / 3.5));
                    UserTokenUsage::addTokens($user->id, $fallbackTokens);
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
            'daily_limit' => $dailyLimit,
            'tokens_remaining' => UserTokenUsage::remainingTokens($user->id, $dailyLimit),
        ]);
    }

    /**
     * Clear chat history for current user.
     */
    public function clear(Request $request): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'unauthorized'], 401);
        }

        ChatMessage::where('user_id', Auth::id())->delete();

        return response()->json(['status' => 'cleared']);
    }
}
