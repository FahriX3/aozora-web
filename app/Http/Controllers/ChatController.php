<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
- Jaga respon tetap ringkas, padat, rapi, dan mudah dibaca di layar chat yang kecil (hindari respon yang terlampau panjang kecuali diminta membuat rangkuman detail).
PROMPT;
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
        ]);
    }

    /**
     * Send message to Sora AI.
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
        $sessionId = $request->input('session_id') ?: ('sess_' . $user->id . '_' . date('Ymd'));
        $userText = trim($request->input('message'));

        // Save user message to database
        $userMessage = ChatMessage::create([
            'user_id' => $user->id,
            'role' => 'user',
            'content' => $userText,
            'session_id' => $sessionId,
        ]);

        // Retrieve last 10 messages for conversation context
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

        $fullPrompt = $this->getSystemPrompt() . "\n\nPercakapan terkini:\n" . $conversationText . "Sora: ";

        $apiUrl = config('services.ai.url', 'http://ai.api.fahrimandriva.web.id/api/generate');
        $model = config('services.ai.model', 'qwen2.5:3b');

        try {
            $response = Http::timeout(50)->post($apiUrl, [
                'model' => $model,
                'prompt' => $fullPrompt,
                'stream' => false,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = trim($data['response'] ?? '');
                
                if (empty($reply)) {
                    $reply = "Konnichiwa! 🌸 Sora mendengarmu, tapi jawabannya kosong nih. Ada yang bisa kubantu lagi?";
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
