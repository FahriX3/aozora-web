{{-- ===== CHATBOT SORA (AI ASSISTANT) WIDGET ===== --}}
<div id="sora-chat-widget" class="fixed bottom-5 right-5 z-[9990] font-sans">
    <style>
        #sora-messages::-webkit-scrollbar {
            width: 5px;
        }
        #sora-messages::-webkit-scrollbar-track {
            background: transparent;
        }
        #sora-messages::-webkit-scrollbar-thumb {
            background: rgba(0, 60, 173, 0.15);
            border-radius: 9999px;
        }
        #sora-messages::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 60, 173, 0.35);
        }
        .sora-stream-cursor::after {
            content: '▌';
            display: inline-block;
            margin-left: 2px;
            color: #003cad;
            animation: soraBlink 0.8s infinite;
        }
        @keyframes soraBlink {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0; }
        }
    </style>

    {{-- Floating Toggle Launcher Button --}}
    <button type="button" id="sora-launcher" onclick="toggleSoraChat()"
        class="group relative flex items-center gap-3 px-4 py-3 bg-gradient-to-r from-primary to-[#0052cc] hover:from-[#003399] hover:to-primary text-cloud-white rounded-full shadow-[0_10px_30px_rgba(0,60,173,0.35)] hover:shadow-[0_15px_35px_rgba(0,60,173,0.5)] transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer"
        aria-label="Buka Chat dengan Sora AI">
        
        {{-- Avatar Circle --}}
        <div class="relative w-9 h-9 rounded-full bg-white/15 backdrop-blur-sm border border-white/30 flex items-center justify-center font-bold text-base shadow-inner">
            <span class="text-white text-sm">空</span>
            {{-- Online pulse indicator --}}
            <span class="absolute -top-0.5 -right-0.5 flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500 border-2 border-white"></span>
            </span>
        </div>

        <div class="flex flex-col text-left">
            <span class="text-xs font-semibold tracking-wide uppercase text-aozora-sky/90 leading-tight">AI Assistant</span>
            <span class="text-sm font-bold tracking-tight text-white leading-tight flex items-center gap-1">
                Tanya Sora
                <span class="text-xs">🌸</span>
            </span>
        </div>

        {{-- Badge on hover --}}
        <span class="material-symbols-outlined text-lg text-white/80 group-hover:translate-x-0.5 transition-transform" id="sora-launcher-icon">
            chat_bubble
        </span>
    </button>

    {{-- Chat Box Window --}}
    <div id="sora-box"
        class="hidden fixed bottom-5 right-5 sm:bottom-6 sm:right-6 w-[calc(100vw-2rem)] sm:w-[410px] h-[570px] max-h-[86vh] bg-white rounded-3xl shadow-[0_25px_70px_rgba(11,16,33,0.3)] border border-gray-100/90 flex-col overflow-hidden transition-all duration-300 transform scale-95 opacity-0 pointer-events-none z-[9995]">
        
        {{-- Header --}}
        <div class="bg-gradient-to-r from-indigo-night via-[#003cad] to-primary p-4 text-white flex items-center justify-between shrink-0 relative overflow-hidden select-none">
            {{-- Subtle Japanese background art --}}
            <div class="absolute -right-4 -bottom-6 text-7xl font-black text-white/[0.07] select-none pointer-events-none">
                青空
            </div>

            <div class="flex items-center gap-3 relative z-10">
                <div class="w-10 h-10 rounded-full bg-white/15 backdrop-blur-md border border-white/30 flex items-center justify-center font-bold text-white shadow-md">
                    <span class="text-base">空</span>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h3 class="font-bold text-base leading-tight text-white font-headline-sm">Sora (そら)</h3>
                        <span class="px-2 py-0.5 rounded-full bg-emerald-500/20 border border-emerald-400/40 text-emerald-300 text-[10px] font-semibold">Online 🌸</span>
                    </div>
                    <div class="flex items-center gap-2 mt-0.5">
                        <p class="text-xs text-white/75 leading-tight">Asisten AI Aozora Club</p>
                        @auth
                            <span id="sora-quota-badge" class="hidden px-1.5 py-0.2 rounded bg-white/15 text-[10px] text-white/90">
                                5.000 token
                            </span>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-1.5 relative z-10">
                @auth
                    <button type="button" onclick="clearSoraChat()" title="Hapus Obrolan"
                        class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/25 text-white/80 hover:text-white flex items-center justify-center transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-base">delete</span>
                    </button>
                @endauth
                <button type="button" onclick="toggleSoraChat()" title="Tutup Chat"
                    class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/25 text-white/80 hover:text-white flex items-center justify-center transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-lg">close</span>
                </button>
            </div>
        </div>

        {{-- Messages Container (Scrollable) --}}
        <div id="sora-messages" class="flex-1 overflow-y-auto overscroll-contain p-4 space-y-3.5 bg-gray-50/70 text-sm leading-relaxed select-text">
            {{-- Default Greeting Message --}}
            <div id="sora-default-greeting" class="flex items-start gap-2.5">
                <div class="w-7 h-7 rounded-full bg-primary/10 border border-primary/20 text-primary flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                    空
                </div>
                <div class="bg-white rounded-2xl rounded-tl-sm p-3.5 shadow-xs border border-gray-100 max-w-[85%] text-gray-800">
                    <p class="font-medium text-primary text-xs mb-1 flex items-center gap-1">
                        <span>Sora</span>
                        <span class="text-gray-400">• Asisten Virtual</span>
                    </p>
                    <p class="text-[13px] leading-relaxed">
                        Konnichiwa! 🌸 Aku <strong>Sora</strong>, asisten AI resmi Aozora Nihongo Club SMKN 1 Purwokerto. 
                        Ada yang ingin kamu tanyakan seputar jadwal kumpul, divisi klub, kebudayaan Jepang, atau event matsuri?
                    </p>
                </div>
            </div>

            {{-- Suggested Prompts --}}
            <div id="sora-suggestions" class="pt-1 pb-1 flex flex-wrap gap-1.5 pl-9">
                <button type="button" onclick="sendSuggestion('Jadwal kumpul rutin Aozora kapan?')"
                    class="text-xs bg-white hover:bg-primary/5 hover:text-primary text-gray-600 border border-gray-200 hover:border-primary/30 px-3 py-1.5 rounded-full transition-all text-left shadow-2xs cursor-pointer">
                    📅 Jadwal kumpul kapan?
                </button>
                <button type="button" onclick="sendSuggestion('Divisi kegiatan apa saja yang ada di Aozora?')"
                    class="text-xs bg-white hover:bg-primary/5 hover:text-primary text-gray-600 border border-gray-200 hover:border-primary/30 px-3 py-1.5 rounded-full transition-all text-left shadow-2xs cursor-pointer">
                    🎭 Divisi apa aja?
                </button>
                <button type="button" onclick="sendSuggestion('Bagaimana cara bergabung dengan Aozora Club?')"
                    class="text-xs bg-white hover:bg-primary/5 hover:text-primary text-gray-600 border border-gray-200 hover:border-primary/30 px-3 py-1.5 rounded-full transition-all text-left shadow-2xs cursor-pointer">
                    ✨ Cara bergabung?
                </button>
            </div>
        </div>

        {{-- Typing Indicator --}}
        <div id="sora-typing" class="hidden px-4 py-2 bg-gray-50/90 border-t border-gray-100 flex items-center gap-2 text-xs text-gray-500 shrink-0">
            <div class="w-6 h-6 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-[10px]">空</div>
            <div class="flex items-center gap-1">
                <span class="inline-block w-1.5 h-1.5 bg-primary/60 rounded-full animate-bounce"></span>
                <span class="inline-block w-1.5 h-1.5 bg-primary/60 rounded-full animate-bounce [animation-delay:0.2s]"></span>
                <span class="inline-block w-1.5 h-1.5 bg-primary/60 rounded-full animate-bounce [animation-delay:0.4s]"></span>
                <span class="ml-1 text-gray-400">Sora sedang mengetik...</span>
            </div>
        </div>

        {{-- Input Footer Area --}}
        <div class="p-3 bg-white border-t border-gray-100 shrink-0">
            @auth
                <form id="sora-form" onsubmit="handleSoraSubmit(event)" class="flex items-center gap-2">
                    <input type="text" id="sora-input" required autocomplete="off"
                        placeholder="Tanya apa saja ke Sora..."
                        class="flex-1 px-4 py-2.5 text-sm bg-gray-50 hover:bg-gray-100/80 focus:bg-white border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/10 rounded-2xl outline-none transition-all placeholder:text-gray-400 text-gray-800" />
                    
                    <button type="submit" id="sora-send-btn"
                        class="w-10 h-10 rounded-2xl bg-primary hover:bg-[#003099] text-white flex items-center justify-center shadow-md hover:shadow-lg transition-all disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer shrink-0"
                        title="Kirim pesan">
                        <span class="material-symbols-outlined text-lg">send</span>
                    </button>
                </form>
                <div class="mt-1.5 flex items-center justify-between px-1">
                    <span class="text-[10px] text-gray-400">Tekan Enter untuk kirim</span>
                    <span class="text-[10px] text-gray-400 flex items-center gap-1">
                        <span id="sora-quota-label" class="text-gray-500 font-medium">🌸 Kuota hari ini: <strong id="sora-quota-number" class="text-primary font-bold">5.000</strong></span>
                    </span>
                </div>
            @else
                <div class="bg-primary/5 border border-primary/15 rounded-2xl p-3 text-center">
                    <p class="text-xs text-gray-700 font-medium mb-2">
                        Masuk untuk mengobrol langsung dengan <strong>Sora AI</strong> 🌸
                    </p>
                    <button type="button" onclick="openLoginModal()"
                        class="w-full py-2 px-3 bg-primary hover:bg-[#003099] text-white text-xs font-bold rounded-xl shadow-sm hover:shadow transition-all flex items-center justify-center gap-1.5 cursor-pointer">
                        <span class="material-symbols-outlined text-sm">login</span>
                        <span>Masuk Sekarang</span>
                    </button>
                </div>
            @endauth
        </div>
    </div>
</div>

<script>
    (function () {
        var soraOpen = false;
        var isToggling = false;
        var historyLoaded = false;
        var isStreaming = false;
        var soraSessionId = localStorage.getItem('aozora_sora_session');
        if (!soraSessionId) {
            soraSessionId = 'sess_' + Math.random().toString(36).substring(2, 12);
            localStorage.setItem('aozora_sora_session', soraSessionId);
        }

        window.toggleSoraChat = function () {
            if (isToggling) return;
            var box = document.getElementById('sora-box');
            var launcher = document.getElementById('sora-launcher');
            if (!box) return;

            isToggling = true;
            soraOpen = !soraOpen;

            if (soraOpen) {
                // Open Chat Box
                box.classList.remove('hidden');
                box.classList.add('flex');
                
                // Lock background scroll on mobile only
                if (window.innerWidth < 640) {
                    document.body.style.overflow = 'hidden';
                }

                // Force layout reflow before triggering CSS transitions
                void box.offsetHeight;

                box.classList.remove('scale-95', 'opacity-0', 'pointer-events-none');
                box.classList.add('scale-100', 'opacity-100', 'pointer-events-auto');

                if (launcher) launcher.classList.add('hidden');

                // Smooth scroll to bottom after layout finishes
                requestAnimationFrame(function () {
                    scrollSoraBottom(true);
                });

                @auth
                    if (!historyLoaded) {
                        loadSoraHistory();
                    }
                    setTimeout(function () {
                        var inp = document.getElementById('sora-input');
                        if (inp && !isStreaming) inp.focus();
                    }, 250);
                @endauth

                setTimeout(function () {
                    isToggling = false;
                }, 300);
            } else {
                // Close Chat Box
                box.classList.remove('scale-100', 'opacity-100', 'pointer-events-auto');
                box.classList.add('scale-95', 'opacity-0', 'pointer-events-none');

                if (window.innerWidth < 640) {
                    document.body.style.overflow = '';
                }

                setTimeout(function () {
                    box.classList.remove('flex');
                    box.classList.add('hidden');
                    if (launcher) launcher.classList.remove('hidden');
                    isToggling = false;
                }, 260);
            }
        };

        window.scrollSoraBottom = function (force) {
            var container = document.getElementById('sora-messages');
            if (!container) return;
            
            // Only auto-scroll if user is already near bottom, or if force is true
            var isNearBottom = (container.scrollHeight - container.scrollTop - container.clientHeight) < 140;
            if (force || isNearBottom) {
                container.scrollTop = container.scrollHeight;
            }
        };

        window.sendSuggestion = function (text) {
            @auth
                var input = document.getElementById('sora-input');
                if (input && !isStreaming) {
                    input.value = text;
                    handleSoraSubmit(new Event('submit'));
                }
            @else
                openLoginModal();
            @endauth
        };

        window.clearSoraChat = function () {
            if (isStreaming) return;
            if (!confirm('Hapus seluruh riwayat percakapan dengan Sora?')) return;

            fetch('{{ route('chat.clear') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ session_id: soraSessionId })
            }).then(function () {
                var container = document.getElementById('sora-messages');
                if (container) {
                    container.innerHTML = `
                        <div class="flex items-start gap-2.5">
                            <div class="w-7 h-7 rounded-full bg-primary/10 border border-primary/20 text-primary flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">空</div>
                            <div class="bg-white rounded-2xl rounded-tl-sm p-3.5 shadow-xs border border-gray-100 max-w-[85%] text-gray-800">
                                <p class="font-medium text-primary text-xs mb-1">Sora • Asisten Virtual</p>
                                <p class="text-[13px] leading-relaxed">Riwayat obrolan telah dibersihkan ✨ Ada yang ingin kamu tanyakan lagi ke Sora?</p>
                            </div>
                        </div>
                    `;
                }
                historyLoaded = true;
            }).catch(console.error);
        };

        function updateQuotaDisplay(remaining) {
            if (remaining === undefined || remaining === null) return;
            var numFormatted = Number(remaining).toLocaleString('id-ID');
            
            var badge = document.getElementById('sora-quota-badge');
            if (badge) {
                badge.textContent = numFormatted + ' token';
                badge.classList.remove('hidden');
            }

            var numSpan = document.getElementById('sora-quota-number');
            if (numSpan) {
                numSpan.textContent = numFormatted;
            }
        }

        function appendMessage(role, content, time) {
            var container = document.getElementById('sora-messages');
            if (!container) return null;

            var div = document.createElement('div');
            var nowTime = time || new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

            if (role === 'user') {
                div.className = 'flex items-end justify-end gap-2';
                div.innerHTML = `
                    <div class="bg-primary text-white rounded-2xl rounded-tr-sm p-3 shadow-xs max-w-[85%] text-[13px] leading-relaxed break-words">
                        <div>${escapeHtml(content)}</div>
                        <div class="text-[10px] text-white/70 text-right mt-1">${nowTime}</div>
                    </div>
                `;
            } else {
                div.className = 'flex items-start gap-2.5';
                div.innerHTML = `
                    <div class="w-7 h-7 rounded-full bg-primary/10 border border-primary/20 text-primary flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">空</div>
                    <div class="bg-white rounded-2xl rounded-tl-sm p-3.5 shadow-xs border border-gray-100 max-w-[85%] text-gray-800 text-[13px] leading-relaxed break-words">
                        <p class="font-medium text-primary text-xs mb-1 flex items-center gap-1">
                            <span>Sora</span>
                            <span class="text-emerald-500 text-[10px]">🌸</span>
                        </p>
                        <div class="sora-bubble-content">${formatSoraContent(content)}</div>
                        <div class="text-[10px] text-gray-400 text-right mt-1">${nowTime}</div>
                    </div>
                `;
            }

            container.appendChild(div);
            scrollSoraBottom(true);
            return div;
        }

        function createStreamingBubble() {
            var container = document.getElementById('sora-messages');
            if (!container) return null;

            var div = document.createElement('div');
            var nowTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            div.className = 'flex items-start gap-2.5';
            div.innerHTML = `
                <div class="w-7 h-7 rounded-full bg-primary/10 border border-primary/20 text-primary flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">空</div>
                <div class="bg-white rounded-2xl rounded-tl-sm p-3.5 shadow-xs border border-gray-100 max-w-[85%] text-gray-800 text-[13px] leading-relaxed break-words">
                    <p class="font-medium text-primary text-xs mb-1 flex items-center gap-1">
                        <span>Sora</span>
                        <span class="text-emerald-500 text-[10px]">🌸</span>
                    </p>
                    <div class="sora-bubble-content sora-stream-cursor"></div>
                    <div class="text-[10px] text-gray-400 text-right mt-1">${nowTime}</div>
                </div>
            `;
            container.appendChild(div);
            scrollSoraBottom(true);
            return div.querySelector('.sora-bubble-content');
        }

        function formatSoraContent(text) {
            if (!text) return '';
            var formatted = escapeHtml(text)
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                .replace(/`([^`]+)`/g, '<code class="bg-gray-100 text-primary px-1 py-0.5 rounded text-xs">$1</code>')
                .replace(/\n/g, '<br>');
            return formatted;
        }

        function escapeHtml(str) {
            return String(str)
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        window.loadSoraHistory = function () {
            fetch('{{ route('chat.history') }}?session_id=' + encodeURIComponent(soraSessionId))
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    historyLoaded = true;
                    if (data.token_remaining !== undefined) {
                        updateQuotaDisplay(data.token_remaining);
                    }

                    if (data.authenticated && data.messages && data.messages.length > 0) {
                        var container = document.getElementById('sora-messages');
                        var suggestions = document.getElementById('sora-suggestions');
                        var defaultGreeting = document.getElementById('sora-default-greeting');
                        
                        if (suggestions) suggestions.style.display = 'none';
                        if (defaultGreeting) defaultGreeting.style.display = 'none';

                        if (container) {
                            container.innerHTML = '';
                            data.messages.forEach(function (m) {
                                appendMessage(m.role, m.content, m.time);
                            });
                        }
                    }
                    scrollSoraBottom(true);
                })
                .catch(console.error);
        };

        window.handleSoraSubmit = async function (e) {
            if (e) e.preventDefault();
            if (isStreaming) return;

            var input = document.getElementById('sora-input');
            var btn = document.getElementById('sora-send-btn');
            var typing = document.getElementById('sora-typing');
            var suggestions = document.getElementById('sora-suggestions');

            if (!input) return;
            var text = input.value.trim();
            if (!text) return;

            // Hide suggestions on message send
            if (suggestions) suggestions.style.display = 'none';

            // Show user message immediately
            appendMessage('user', text);
            input.value = '';
            input.disabled = true;
            if (btn) btn.disabled = true;
            if (typing) typing.classList.remove('hidden');
            scrollSoraBottom(true);

            isStreaming = true;

            try {
                var response = await fetch('{{ route('chat.stream') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/x-ndjson, text/plain',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        message: text,
                        session_id: soraSessionId
                    })
                });

                if (response.status === 401) {
                    if (typing) typing.classList.add('hidden');
                    openLoginModal();
                    return;
                }

                if (response.status === 429) {
                    var errorData = await response.json();
                    if (typing) typing.classList.add('hidden');
                    appendMessage('assistant', errorData.error || 'Kuota harian kamu sudah habis 🌸 Coba lagi besok ya!');
                    if (errorData.tokens_remaining !== undefined) {
                        updateQuotaDisplay(errorData.tokens_remaining);
                    }
                    return;
                }

                if (!response.ok) {
                    throw new Error('HTTP error ' + response.status);
                }

                // Streaming started — hide typing indicator and create bubble with cursor
                if (typing) typing.classList.add('hidden');
                var bubbleContent = createStreamingBubble();
                var accumulatedText = '';

                var reader = response.body.getReader();
                var decoder = new TextDecoder();
                var buffer = '';

                while (true) {
                    var chunk = await reader.read();
                    if (chunk.done) break;

                    buffer += decoder.decode(chunk.value, { stream: true });
                    var lines = buffer.split('\n');
                    buffer = lines.pop(); // keep last incomplete line

                    for (var i = 0; i < lines.length; i++) {
                        var line = lines[i].trim();
                        if (!line) continue;

                        try {
                            var data = JSON.parse(line);

                            // Handle token usage metadata
                            if (data.sora_meta && data.tokens_remaining !== undefined) {
                                updateQuotaDisplay(data.tokens_remaining);
                                continue;
                            }

                            // Handle quota limit warning
                            if (data.quota_exceeded) {
                                accumulatedText = data.error || 'Kuota harian kamu sudah habis 🌸';
                                if (bubbleContent) bubbleContent.innerHTML = formatSoraContent(accumulatedText);
                                break;
                            }

                            // Handle token stream chunk
                            if (data.response) {
                                accumulatedText += data.response;
                                if (bubbleContent) {
                                    bubbleContent.innerHTML = formatSoraContent(accumulatedText);
                                    scrollSoraBottom(false);
                                }
                            }
                        } catch (err) {
                            // Partial or non-JSON line, continue
                        }
                    }
                }

                // Finalize streaming bubble: remove blinking cursor
                if (bubbleContent) {
                    bubbleContent.classList.remove('sora-stream-cursor');
                    bubbleContent.innerHTML = formatSoraContent(accumulatedText || '🌸 (Jawaban selesai)');
                }

            } catch (err) {
                console.error('Chat error:', err);
                if (typing) typing.classList.add('hidden');
                appendMessage('assistant', 'Gomen ne! 🌸 Terjadi kendala koneksi ke Sora. Coba lagi sebentar lagi ya!');
            } finally {
                isStreaming = false;
                input.disabled = false;
                if (btn) btn.disabled = false;
                if (typing) typing.classList.add('hidden');
                input.focus();
                scrollSoraBottom(true);
            }
        };

        // Open chat if redirected with ?chat=open
        document.addEventListener('DOMContentLoaded', function () {
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('chat') === 'open') {
                setTimeout(function () {
                    toggleSoraChat();
                }, 400);
            }
        });
    })();
</script>
