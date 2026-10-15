<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\Event;
use App\Models\InventarisItem;
use App\Models\Pengurus;
use App\Models\UserTokenUsage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ChatController extends Controller
{
    /**
     * Get authoritative base knowledge about the club, core administrators, and events.
     */
    private function getBaseKnowledge(): string
    {
        return Cache::remember('sora_base_knowledge_v6', 300, function () {
            $lines = [];

            // 1. Profil Umum & Sekolah
            $lines[] = '• Profil: Aozora Nihongo Club adalah ekstrakurikuler Bahasa dan Budaya Jepang resmi di SMK Negeri 1 Purwokerto (Smecone).';
            $lines[] = '• Lokasi Sekolah: SMKN 1 Purwokerto, Jl. Dr. Soeparno No. 29, Purwokerto Timur, Kab. Banyumas, Jawa Tengah.';
            $lines[] = '• Jadwal Kumpul Rutin: Setiap hari Kamis pukul 16.00 - 17.00 WIB di lingkungan SMKN 1 Purwokerto.';
            $lines[] = "• Slogan: 'Ichigo Ichie' (一期一会 - satu pertemuan seumur hidup) & 'Aozora: Blue Skies Ahead'.";
            $lines[] = '• Maskot Resmi: Sora-chan (空ちゃん) - siswi ceria berambut biru toska khas Aozora.';

            // 6 Divisi Resmi Aozora
            $lines[] = '• 6 DIVISI RESMI AOZORA (SEBUTKAN SECARA SINGKAT 1 BARIS PER POIN):';
            $lines[] = '  1. Pemateri (Bahasa Jepang, kaiwa, tata bahasa, kanji & JLPT)';
            $lines[] = '  2. Kegiatan (Agenda rutin, matsuri & festival bunkasai)';
            $lines[] = '  3. Budaya Bahasa (Shodo kaligrafi, origami & kebudayaan Jepang)';
            $lines[] = '  4. PDD (Publikasi, Desain & Dokumentasi fotografi kegiatan)';
            $lines[] = '  5. Mediakom (Media Sosial Instagram/TikTok & konten kreatif)';
            $lines[] = '  6. Perkap (Perlengkapan, inventaris alat & properti event)';

            // Koordinator Divisi (Hanya sebutkan jika ditanya siapa koordinatornya)
            try {
                $koordinators = Pengurus::where('jabatan', 'like', 'Koordinator%')->orderBy('urutan')->get();
                if ($koordinators->isNotEmpty()) {
                    $lines[] = '• Koordinator Divisi (HANYA sebutkan jika ditanya siapa koordinatornya):';
                    $divGroups = $koordinators->groupBy('divisi');
                    foreach ($divGroups as $divName => $koorItems) {
                        $kStr = $koorItems->map(fn ($k) => "{$k->nama} ({$k->kelas})")->join(' & ');
                        $lines[] = "  - Divisi {$divName}: {$kStr}";
                    }
                }
            } catch (\Throwable) {
                // Ignore
            }

            // 2. Data Pengurus Real dari Database
            try {
                $pembina = Pengurus::where('divisi', 'Pembina')
                    ->orWhere('jabatan', 'like', '%Pembina%')
                    ->first();
                $namaPembina = $pembina ? $pembina->nama : 'Kikie Astri Mahdalika S.Pd';
                $lines[] = "• Pembina Ekstrakurikuler: {$namaPembina} (Guru Pembina).";

                $ketua = Pengurus::where('jabatan', 'Ketua Umum')->first();
                $namaKetua = $ketua ? "{$ketua->nama} ({$ketua->kelas})" : 'Tegar Satrio Utomo (XI PPLG 2)';
                $lines[] = "• Ketua Umum (Ketua Klub/Ketua Jepang): {$namaKetua}.";

                $wakil = Pengurus::where('jabatan', 'Wakil Ketua')->first();
                $namaWakil = $wakil ? "{$wakil->nama} ({$wakil->kelas})" : 'Deris Novaliza Khusnul Khotimah (XI TJKT 1)';
                $lines[] = "• Wakil Ketua: {$namaWakil}.";

                $sekretaris = Pengurus::where('jabatan', 'like', 'Sekretaris%')->orderBy('urutan')->get();
                if ($sekretaris->isNotEmpty()) {
                    $sekList = $sekretaris->map(fn ($p) => "{$p->nama} ({$p->jabatan}, {$p->kelas})")->join(', ');
                    $lines[] = "• Sekretaris: {$sekList}.";
                }

                $bendahara = Pengurus::where('jabatan', 'like', 'Bendahara%')->orderBy('urutan')->get();
                if ($bendahara->isNotEmpty()) {
                    $benList = $bendahara->map(fn ($p) => "{$p->nama} ({$p->jabatan}, {$p->kelas})")->join(', ');
                    $lines[] = "• Bendahara: {$benList}.";
                }

                $humas = Pengurus::where('jabatan', 'like', 'Humas%')->orderBy('urutan')->get();
                if ($humas->isNotEmpty()) {
                    $humList = $humas->map(fn ($p) => "{$p->nama} ({$p->jabatan}, {$p->kelas})")->join(', ');
                    $lines[] = "• Humas: {$humList}.";
                }
            } catch (\Throwable) {
                $lines[] = '• Pembina: Kikie Astri Mahdalika S.Pd';
                $lines[] = '• Ketua Umum: Tegar Satrio Utomo (XI PPLG 2)';
                $lines[] = '• Wakil Ketua: Deris Novaliza Khusnul Khotimah (XI TJKT 1)';
            }

            // 3. Agenda Event dari Database
            try {
                $events = Event::orderBy('event_date', 'asc')->get();
                if ($events->isNotEmpty()) {
                    $upcoming = $events->where('status', '!=', 'completed');
                    $past = $events->where('status', 'completed');

                    if ($upcoming->isNotEmpty()) {
                        $lines[] = '• Event Mendatang / Agenda Terbaru:';
                        foreach ($upcoming as $ev) {
                            $tgl = $ev->event_date ? date('d M Y', strtotime($ev->event_date)) : '-';
                            $lines[] = "  - {$ev->title} (Tanggal: {$tgl}, Lokasi: {$ev->location}): {$ev->description}";
                        }
                    }

                    if ($past->isNotEmpty()) {
                        $lines[] = '• Event yang Pernah Diselenggarakan / Dokumentasi:';
                        foreach ($past as $ev) {
                            $tgl = $ev->event_date ? date('d M Y', strtotime($ev->event_date)) : '-';
                            $lines[] = "  - {$ev->title} (Tanggal: {$tgl}, Lokasi: {$ev->location}): {$ev->description}";
                        }
                    }
                }
            } catch (\Throwable) {
                // Ignore
            }

            return implode("\n", $lines);
        });
    }

    /**
     * Get query-specific context if the user asks about specific members, divisions, or inventory.
     */
    private function getDynamicContext(string $userQuery): string
    {
        if (trim($userQuery) === '') {
            return '';
        }

        $query = mb_strtolower($userQuery);
        $extras = [];

        // Cek jika menanyakan divisi secara umum
        if (str_contains($query, 'divisi') || str_contains($query, 'bidang') || str_contains($query, 'bagian')) {
            $extras[] = '• ATURAN JAWAB DIVISI: Sebutkan 6 divisi resmi ini secara ringkas (1 baris per nomor): 1. Pemateri, 2. Kegiatan, 3. Budaya Bahasa, 4. PDD, 5. Mediakom, 6. Perkap. Jangan sertakan nama orang/koordinator agar jawaban ringkas dan tidak kepanjangan.';
        }

        $divKeywords = [
            'pemateri' => 'Pemateri',
            'materi' => 'Pemateri',
            'kaiwa' => 'Pemateri',
            'bunpou' => 'Pemateri',
            'kanji' => 'Pemateri',
            'jlpt' => 'Pemateri',
            'kegiatan' => 'Kegiatan',
            'acara' => 'Kegiatan',
            'budaya bahasa' => 'Budaya Bahasa',
            'budaya' => 'Budaya Bahasa',
            'shodo' => 'Budaya Bahasa',
            'kaligrafi' => 'Budaya Bahasa',
            'origami' => 'Budaya Bahasa',
            'pdd' => 'PDD',
            'dokumentasi' => 'PDD',
            'fotografi' => 'PDD',
            'desain' => 'PDD',
            'mediakom' => 'Mediakom',
            'medsos' => 'Mediakom',
            'instagram' => 'Mediakom',
            'perkap' => 'Perkap',
            'perlengkapan' => 'Perkap',
            'properti' => 'Perkap',
        ];

        foreach ($divKeywords as $keyword => $divLabel) {
            if (str_contains($query, $keyword)) {
                try {
                    $members = Pengurus::where('divisi', $divLabel)->orderBy('urutan')->get();
                    if ($members->isNotEmpty()) {
                        $koors = $members->where('jabatan', 'like', 'Koordinator%')->map(fn ($m) => "{$m->nama} ({$m->kelas})")->join(' & ');
                        $anggotas = $members->where('jabatan', 'Anggota')->map(fn ($m) => "{$m->nama} ({$m->kelas})")->join(', ');
                        $extras[] = "• Detail Divisi {$divLabel}: Koordinator: {$koors}. Anggota ({$members->where('jabatan', 'Anggota')->count()} orang): {$anggotas}.";
                    }
                } catch (\Throwable) {
                    // Ignore
                }
                break;
            }
        }

        // Check if query is asking about Pembina / Guru
        if (str_contains($query, 'pembina') || str_contains($query, 'guru')) {
            $extras[] = '• Pembina Ekstrakurikuler: Kikie Astri Mahdalika S.Pd (Guru Pembina Smecone).';
        }

        // Check if query is asking about Ketua / Wakil
        if (str_contains($query, 'ketua') || str_contains($query, 'wakil')) {
            $extras[] = '• Ketua Umum: Tegar Satrio Utomo (XI PPLG 2); Wakil Ketua: Deris Novaliza Khusnul Khotimah (XI TJKT 1).';
        }

        // Check if query is asking for events / agenda
        $eventKeywords = ['event', 'acara', 'lomba', 'matsuri', 'agenda', 'bunkasai', 'kegiatan', 'terbaru'];
        foreach ($eventKeywords as $ek) {
            if (str_contains($query, $ek)) {
                try {
                    $evList = Event::orderBy('event_date', 'asc')->get();
                    if ($evList->isNotEmpty()) {
                        $evLines = $evList->map(function ($e) {
                            $st = $e->status === 'completed' ? 'Sudah Terlaksana' : 'Mendatang';
                            $tgl = $e->event_date ? date('d M Y', strtotime($e->event_date)) : '-';

                            return "{$e->title} [{$st}] ({$tgl} di {$e->location})";
                        })->join('; ');
                        $extras[] = "• Event & Acara Aozora: {$evLines}";
                    }
                } catch (\Throwable) {
                    // Ignore
                }
                break;
            }
        }

        $invKeywords = ['inventaris', 'barang', 'alat', 'pinjam', 'kostum', 'yukata', 'kuas', 'properti'];
        foreach ($invKeywords as $kw) {
            if (str_contains($query, $kw)) {
                try {
                    $items = InventarisItem::where('jumlah_tersedia', '>', 0)->take(6)->get();
                    if ($items->isNotEmpty()) {
                        $itemList = $items->map(fn ($it) => "{$it->nama_barang} ({$it->jumlah_tersedia} unit)")->join(', ');
                        $extras[] = "• Inventaris/Barang Klub Siap Dipinjam: {$itemList}";
                    }
                } catch (\Throwable) {
                    // Ignore
                }
                break;
            }
        }

        if (empty($extras)) {
            return '';
        }

        return "\n=== DATA SPESIFIK RELEVAN ===\n".implode("\n", $extras);
    }

    private function getSystemPrompt(string $userQuery = ''): string
    {
        $baseKnowledge = $this->getBaseKnowledge();
        $dynamicContext = $this->getDynamicContext($userQuery);

        return <<<PROMPT
Kamu adalah Sora (そら), asisten AI resmi sekaligus maskot Aozora Nihongo Club di SMKN 1 Purwokerto (Smecone), Banyumas, Jawa Tengah.

KEPRIBADIAN & GAYA KOMUNIKASI:
1. Ramah, ceria, sopan, dan hangat layaknya teman sebaya di sekolah (genki & bersahabat).
2. Selalu gunakan BAHASA INDONESIA santai dan akrab sebagai bahasa utama.
3. Boleh menyelipkan sapaan atau ungkapan ringan BAHASA JEPANG alami (contoh: Konnichiwa! 🌸, Arigatou gozaimasu, Sugoi ne, Ganbatte, Yoroshiku ne~).
4. DILARANG menggunakan bahasa Inggris (jangan pernah menyapa "Hello there", "How can I help", atau "assist").
5. JAWAB SINGKAT, PADAT, DAN JELAS:
   - Sapaan / basa-basi: 1 sampai 2 kalimat saja.
   - Pertanyaan informasi / daftar: Jawab ringkas 1 baris per poin. DILARANG bertele-tele atau membuat penjabaran panjang.
6. DILARANG menulis label awalan nama seperti "Sora:", "AI:", atau "Asisten:".
7. DILARANG menulis pengantar kaku/robotik seperti "berdasarkan fakta yang diberikan", "menurut data", atau "berikut adalah penjelasannya". Berbicaralah alami, ceria, dan akrab sebagai Sora!
8. JIKA DITANYA DAFTAR DIVISI: Cukup sebutkan nama 6 divisi dan fokus singkatnya saja dalam 1 baris per nomor. JANGAN sertakan nama koordinator kecuali jika pengguna bertanya siapa koordinatornya.

ATURAN KEBENARAN FAKTA (GROUNDING DATA):
1. Identitas & Sekolahmu HANYA SATU: SMKN 1 Purwokerto (Smecone), Banyumas, Jawa Tengah. DILARANG KERAS menyebut sekolah atau kota lain (DILARANG menyebut Klaten, Kebumen, Solo, dsb).
2. Jawab pertanyaan seputar klub, sekolah, pengurus, ketua, pembina, jadwal, divisi, dan event HANYA berdasarkan "FAKTA RESMI AOZORA" di bawah ini.
3. DILARANG KERAS mengarang nama orang, organisasi, atau sekolah lain.
4. Jika ditanya hal seputar klub yang tidak tercantum dalam fakta di bawah, katakan dengan sopan dan ramah bahwa kamu belum memiliki informasi tersebut.

=== CONTOH CARA MENJAWAB (IKUTI CONTOH INI) ===
Pengguna: Halo / Hai / P
Sora: Konnichiwa! 🌸 Halo! Senang ketemu kamu. Ada yang ingin kamu tanyakan seputar Aozora Nihongo Club hari ini?

Pengguna: Kamu siapa? / Siapa kamu?
Sora: Aku Sora (そら), maskot resmi sekaligus asisten AI Aozora Nihongo Club di SMKN 1 Purwokerto! Aku siap bantu kamu seputar info klub, kegiatan, event, dan belajar bahasa Jepang bareng 🌸

Pengguna: Apa saja divisi di Aozora? / Divisi apa saja yang ada?
Sora: Di Aozora Nihongo Club ada 6 divisi resmi lho! 🌸
1. Pemateri (Kaiwa, tata bahasa, kanji & JLPT)
2. Kegiatan (Agenda rutin, matsuri & bunkasai)
3. Budaya Bahasa (Shodo, origami & kebudayaan Jepang)
4. PDD (Publikasi, Desain & Dokumentasi)
5. Mediakom (Media Sosial & Komunikasi kreatif)
6. Perkap (Perlengkapan & properti event)
Ada divisi yang ingin kamu ketahui lebih lanjut? 😊

Pengguna: Siapa ketua klub?
Sora: Ketua Umum Aozora Nihongo Club adalah Tegar Satrio Utomo (XI PPLG 2).

Pengguna: Kalo pembinanya siapa? / Siapa pembinanya?
Sora: Pembina ekstrakurikuler Aozora adalah Bu Kikie Astri Mahdalika S.Pd (Guru Pembina) 🌸

Pengguna: Ada event apa saja? / Ada event terbaru?
Sora: Event mendatang kami adalah Aozora Nihongo Speech & Quiz Contest pada 20 November 2026 di Ruang Teater Mini SMKN 1 Purwokerto! Sebelumnya kami juga menggelar Bunkasai Matsuri "Haru no Hikari" dengan cosplay walk, stan takoyaki, dan live band anisong 🌸

=== FAKTA RESMI AOZORA NIHONGO CLUB ===
{$baseKnowledge}
{$dynamicContext}
PROMPT;
    }

    /**
     * Build messages array for Ollama /api/chat.
     */
    private function buildMessages(int $userId, string $currentUserMessage = ''): array
    {
        $history = ChatMessage::where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->take(8)
            ->get()
            ->reverse();

        $messages = [];
        $messages[] = [
            'role' => 'system',
            'content' => $this->getSystemPrompt($currentUserMessage),
        ];

        foreach ($history as $item) {
            $content = trim($item->content);
            if ($item->role === 'assistant') {
                $content = preg_replace('/^(Sora|AI|Asisten):\s*/i', '', $content);
                // Sanitize corrupted historical responses so they do not poison context
                if (
                    str_contains($content, 'Google Anthropic') ||
                    str_contains($content, 'Sisi Robot') ||
                    str_contains($content, 'Kebumen') ||
                    str_contains($content, 'Klaten') ||
                    str_contains($content, 'SMA Klaten') ||
                    str_contains($content, 'tidak dapat berbagi detail pribadi')
                ) {
                    continue;
                }
            }
            if (! empty($content)) {
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
        if (! Auth::check()) {
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
        if (! Auth::check()) {
            return new StreamedResponse(function () {
                echo json_encode(['error' => 'Silakan masuk terlebih dahulu untuk ngobrol dengan Sora 🌸'])."\n";
            }, 401, ['Content-Type' => 'text/plain']);
        }

        $request->validate([
            'message' => ['required', 'string', 'max:1000'],
            'session_id' => ['nullable', 'string', 'max:100'],
        ]);

        $user = Auth::user();
        $dailyLimit = config('services.ai.daily_token_limit', 5000);

        // Check daily token budget
        if (! UserTokenUsage::hasQuota($user->id, $dailyLimit)) {
            return new StreamedResponse(function () use ($user, $dailyLimit) {
                $remaining = UserTokenUsage::remainingTokens($user->id, $dailyLimit);
                echo json_encode([
                    'error' => 'Kuota harian Sora kamu sudah habis 🌸 Coba lagi besok ya!',
                    'quota_exceeded' => true,
                    'daily_limit' => $dailyLimit,
                    'tokens_remaining' => $remaining,
                ])."\n";
            }, 429, ['Content-Type' => 'text/plain']);
        }

        $sessionId = 'user_'.$user->id;
        $userText = trim($request->input('message'));

        // Save user message to database
        ChatMessage::create([
            'user_id' => $user->id,
            'role' => 'user',
            'content' => $userText,
            'session_id' => $sessionId,
        ]);

        // Build messages array for Ollama /api/chat
        $messages = $this->buildMessages($user->id, $userText);

        $apiUrl = config('services.ai.url', 'http://ai.api.fahrimandriva.web.id/api/chat');
        if (str_contains($apiUrl, '/api/generate')) {
            $apiUrl = str_replace('/api/generate', '/api/chat', $apiUrl);
        }

        $model = config('services.ai.model', 'qwen2.5:3b');
        $maxTokens = config('services.ai.max_tokens', 350);

        $payload = json_encode([
            'model' => $model,
            'messages' => $messages,
            'stream' => true,
            'options' => [
                'num_predict' => $maxTokens,
                'temperature' => 0.5,
                'top_p' => 0.85,
                'repeat_penalty' => 1.1,
                'repeat_last_n' => 64,
                'stop' => [
                    '<|im_end|>',
                    "\n".($user->name ?: 'Pengguna').':',
                    "\nUser:",
                    "\nPengguna:",
                    "\nHuman:",
                    "\nAssistant:",
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
                    CURLOPT_TIMEOUT => 120,
                    CURLOPT_CONNECTTIMEOUT => 10,
                    CURLOPT_WRITEFUNCTION => function ($ch, $chunk) use (&$fullReply, &$totalEvalCount, &$lineBuffer) {
                        $lineBuffer .= $chunk;
                        $lines = explode("\n", $lineBuffer);
                        // The last element might be incomplete; keep it in the buffer
                        $lineBuffer = array_pop($lines);

                        foreach ($lines as $line) {
                            $trimmed = trim($line);
                            if ($trimmed === '') {
                                continue;
                            }

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
                                ])."\n";
                            } else {
                                echo $trimmed."\n";
                            }

                            if (ob_get_level()) {
                                ob_flush();
                            }
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
                if (! empty(trim($lineBuffer))) {
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
                        ])."\n";
                    }
                    if (ob_get_level()) {
                        ob_flush();
                    }
                    flush();
                }

                if ($result === false || $httpCode !== 200) {
                    Log::warning('AI stream failed', [
                        'http_code' => $httpCode,
                        'curl_error' => $curlError,
                    ]);

                    if (empty($fullReply)) {
                        $fullReply = 'Gomen ne 🌸 Sora sedang agak sibuk. Coba lagi sebentar lagi ya!';
                        echo json_encode(['response' => $fullReply, 'done' => true])."\n";
                        if (ob_get_level()) {
                            ob_flush();
                        }
                        flush();
                    }
                }

            } catch (Exception $e) {
                Log::error('AI stream exception: '.$e->getMessage());
                $fullReply = 'Gomen ne 🌸 Koneksi ke Sora sedang terganggu sejenak.';
                echo json_encode(['response' => $fullReply, 'done' => true])."\n";
                if (ob_get_level()) {
                    ob_flush();
                }
                flush();
            }

            // Save the complete assistant reply to database (stripping accidental 'Sora: ' or English greetings if present)
            $cleanReply = preg_replace('/^(Sora|AI|Asisten):\s*/i', '', trim($fullReply));
            if (empty($cleanReply)) {
                $cleanReply = 'Konnichiwa! 🌸 Halo! Senang bertemu denganmu. Ada yang ingin kamu tanyakan seputar Aozora Nihongo Club hari ini?';
                echo json_encode(['response' => $cleanReply, 'done' => true])."\n";
                if (ob_get_level()) {
                    ob_flush();
                }
                flush();
            }
            if (! empty($cleanReply)) {
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
            ])."\n";
            if (ob_get_level()) {
                ob_flush();
            }
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
        if (! Auth::check()) {
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
        $sessionId = 'user_'.$user->id;
        $userText = trim($request->input('message'));

        // Check daily token budget
        if (! UserTokenUsage::hasQuota($user->id, $dailyLimit)) {
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

        $model = config('services.ai.model', 'qwen2.5:3b');
        $maxTokens = config('services.ai.max_tokens', 350);
        $messages = $this->buildMessages($user->id, $userText);

        try {
            $response = Http::timeout(120)->post($apiUrl, [
                'model' => $model,
                'messages' => $messages,
                'stream' => false,
                'options' => [
                    'num_predict' => $maxTokens,
                    'temperature' => 0.5,
                    'top_p' => 0.85,
                    'repeat_penalty' => 1.1,
                    'repeat_last_n' => 64,
                    'stop' => [
                        '<|im_end|>',
                        "\n".($user->name ?: 'Pengguna').':',
                        "\nUser:",
                        "\nPengguna:",
                        "\nHuman:",
                        "\nAssistant:",
                    ],
                ],
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = trim($data['message']['content'] ?? ($data['response'] ?? ''));
                $reply = preg_replace('/^(Sora|AI|Asisten):\s*/i', '', $reply);
                $evalCount = $data['eval_count'] ?? 0;

                if (empty($reply)) {
                    $reply = 'Konnichiwa! 🌸 Sora mendengarmu, tapi jawabannya kosong nih. Ada yang bisa kubantu lagi?';
                }

                // Track token usage
                if ($evalCount > 0) {
                    UserTokenUsage::addTokens($user->id, $evalCount);
                } elseif (mb_strlen($reply) > 0) {
                    $fallbackTokens = max(1, (int) ceil(mb_strlen($reply) / 3.5));
                    UserTokenUsage::addTokens($user->id, $fallbackTokens);
                }
            } else {
                Log::warning('AI API non-200 response: '.$response->body());
                $reply = 'Gomen ne 🌸 Sora sedang agak sibuk melayani teman-teman lainnya. Boleh coba ketik ulang beberapa detik lagi?';
            }
        } catch (Exception $e) {
            Log::error('AI API request failed: '.$e->getMessage());
            $reply = 'Gomen ne 🌸 Koneksi ke Sora sedang terganggu sejenak. Pastikan koneksi internetmu lancar ya!';
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
        if (! Auth::check()) {
            return response()->json(['status' => 'unauthorized'], 401);
        }

        ChatMessage::where('user_id', Auth::id())->delete();

        return response()->json(['status' => 'cleared']);
    }
}
