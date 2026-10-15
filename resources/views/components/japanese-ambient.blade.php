{{-- JAPANESE AMBIENT COMPONENT: FALLING SAKURA PETALS & TRADITIONAL KOTO BGM --}}
<div>
    {{-- 1. Fullscreen Falling Sakura Canvas --}}
    <canvas id="sakura-canvas" class="fixed inset-0 pointer-events-none z-[35] w-full h-full" aria-hidden="true"></canvas>

    {{-- 2. Audio Element --}}
    <audio id="aozora-bgm" src="{{ asset('audio/koto_bgm.mp3') }}" preload="auto" loop></audio>

    {{-- 3. Floating Japanese Ambient Controller (Bottom Left) --}}
    <div id="ambient-hud-container" class="fixed bottom-5 left-4 sm:left-6 z-[95] select-none font-sans">
        
        {{-- Autoplay Hint Tooltip (shown if browser blocked autoplay until user clicks) --}}
        <div id="bgm-autoplay-hint" class="hidden mb-2.5 px-3 py-1.5 rounded-full bg-slate-900/90 text-white text-[11px] font-medium shadow-lg backdrop-blur-md border border-white/10 items-center gap-1.5 animate-bounce">
            <span class="text-rose-400">🌸</span>
            <span>Sentuh layar untuk memutar alunan Koto</span>
        </div>

        {{-- Main Glassmorphism Controller Card --}}
        <div class="group relative flex items-center gap-2.5 px-3.5 py-2 rounded-2xl bg-white/95 backdrop-blur-md border border-rose-200/70 shadow-[0_8px_30px_rgb(0,0,0,0.12)] hover:shadow-[0_12px_36px_rgba(244,63,94,0.2)] transition-all duration-300">
            
            {{-- Rotating Sakura Vinyl / Icon --}}
            <button type="button" id="bgm-play-btn" onclick="window.AozoraAmbient.toggleBgm()" class="relative w-8 h-8 rounded-full bg-gradient-to-tr from-rose-500 to-amber-500 flex items-center justify-center text-white shadow-md hover:scale-105 active:scale-95 transition-all cursor-pointer shrink-0" title="Putar / Jeda Musik Koto">
                <span id="bgm-disc-icon" class="text-base transition-transform duration-300">🌸</span>
                <span id="bgm-action-overlay" class="absolute inset-0 rounded-full bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                    <span id="bgm-play-icon" class="material-symbols-outlined text-white text-base">play_arrow</span>
                </span>
            </button>

            {{-- Info & Live Audio Equalizer --}}
            <div class="flex flex-col cursor-pointer" onclick="window.AozoraAmbient.toggleBgm()">
                <div class="flex items-center gap-1.5">
                    <span class="text-[10px] font-bold text-torii-vermilion uppercase tracking-widest flex items-center gap-1">
                        <span>琴</span>
                        <span>Koto BGM</span>
                    </span>
                    {{-- Mini Equalizer Bars --}}
                    <div id="bgm-equalizer" class="flex items-end gap-0.5 h-3 opacity-40 transition-opacity">
                        <span class="eq-bar w-0.5 h-1.5 bg-rose-500 rounded-full"></span>
                        <span class="eq-bar w-0.5 h-3 bg-rose-500 rounded-full"></span>
                        <span class="eq-bar w-0.5 h-2 bg-rose-500 rounded-full"></span>
                        <span class="eq-bar w-0.5 h-2.5 bg-rose-500 rounded-full"></span>
                    </div>
                </div>
                <span id="bgm-status-text" class="text-[11px] font-semibold text-slate-700 truncate max-w-[120px] sm:max-w-[140px]">
                    Traditional Shamisen
                </span>
            </div>

            {{-- Extra Controls: Volume & Sakura Toggle --}}
            <div class="flex items-center gap-1 border-l border-rose-100 pl-2">
                {{-- Volume Mute Toggle --}}
                <button type="button" id="bgm-mute-btn" onclick="window.AozoraAmbient.toggleMute()" class="w-7 h-7 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 flex items-center justify-center transition-colors cursor-pointer" title="Bisukan / Aktifkan Suara">
                    <span id="bgm-volume-icon" class="material-symbols-outlined text-lg">volume_up</span>
                </button>

                {{-- Falling Sakura Toggle Button --}}
                <button type="button" id="sakura-toggle-btn" onclick="window.AozoraAmbient.toggleSakura()" class="w-7 h-7 rounded-lg text-rose-500 hover:text-rose-700 bg-rose-50 hover:bg-rose-100/80 flex items-center justify-center transition-all cursor-pointer" title="Aktifkan / Matikan Efek Guguran Sakura">
                    <span class="text-xs">🌸</span>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Equalizer Bouncing Animation */
    @keyframes eq-bounce-1 { 0%, 100% { height: 4px; } 50% { height: 12px; } }
    @keyframes eq-bounce-2 { 0%, 100% { height: 12px; } 50% { height: 6px; } }
    @keyframes eq-bounce-3 { 0%, 100% { height: 6px; } 50% { height: 14px; } }
    @keyframes eq-bounce-4 { 0%, 100% { height: 10px; } 50% { height: 3px; } }

    .bgm-playing #bgm-equalizer { opacity: 1; }
    .bgm-playing .eq-bar:nth-child(1) { animation: eq-bounce-1 0.8s ease-in-out infinite; }
    .bgm-playing .eq-bar:nth-child(2) { animation: eq-bounce-2 0.7s ease-in-out infinite 0.1s; }
    .bgm-playing .eq-bar:nth-child(3) { animation: eq-bounce-3 0.9s ease-in-out infinite 0.2s; }
    .bgm-playing .eq-bar:nth-child(4) { animation: eq-bounce-4 0.75s ease-in-out infinite 0.15s; }

    .bgm-playing #bgm-disc-icon {
        display: inline-block;
        animation: spin 8s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>

<script>
    (function () {
        // =======================================================
        // 1. FALLING SAKURA PETALS ENGINE (CANVAS 60FPS)
        // =======================================================
        const canvas = document.getElementById('sakura-canvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');

        let width = canvas.width = window.innerWidth;
        let height = canvas.height = window.innerHeight;

        let petals = [];
        let sakuraEnabled = localStorage.getItem('aozora_sakura_enabled') !== 'false';
        let animationFrameId = null;

        // Resize handler
        function onResize() {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
        }
        window.addEventListener('resize', onResize);

        // Sakura Petal Class
        class Petal {
            constructor() {
                this.reset(true);
            }

            reset(initial = false) {
                this.x = Math.random() * width;
                this.y = initial ? Math.random() * height : -20 - Math.random() * 50;
                this.size = Math.random() * 8 + 8; // 8px - 16px
                this.speedX = Math.random() * 1.5 + 0.5; // drifting right
                this.speedY = Math.random() * 1.2 + 0.9; // falling down
                this.angle = Math.random() * Math.PI * 2;
                this.rotationSpeed = (Math.random() - 0.5) * 0.03;
                this.roll = Math.random() * Math.PI * 2;
                this.rollSpeed = Math.random() * 0.04 + 0.01;
                this.opacity = Math.random() * 0.4 + 0.5; // 0.5 - 0.9
                
                // Color palette (soft cherry blossom gradients)
                const colors = [
                    { r: 255, g: 183, b: 197 }, // Classic sakura pink
                    { r: 255, g: 197, b: 211 }, // Light blossom
                    { r: 253, g: 226, b: 233 }, // Very soft pink
                    { r: 251, g: 168, b: 188 }  // Deeper rose pink
                ];
                this.color = colors[Math.floor(Math.random() * colors.length)];
            }

            update() {
                this.y += this.speedY;
                this.x += Math.sin(this.angle) * 0.8 + this.speedX;
                this.angle += this.rotationSpeed;
                this.roll += this.rollSpeed;

                // Reset when off screen
                if (this.y > height + 25 || this.x > width + 25 || this.x < -25) {
                    this.reset(false);
                }
            }

            draw() {
                ctx.save();
                ctx.translate(this.x, this.y);
                ctx.rotate(this.angle);
                // 3D flipping effect
                ctx.scale(1, Math.cos(this.roll));

                ctx.beginPath();
                // Draw realistic organic petal curve with a small heart-notch at top
                ctx.moveTo(0, -this.size);
                ctx.bezierCurveTo(this.size * 0.8, -this.size * 0.8, this.size * 0.8, this.size * 0.5, 0, this.size);
                ctx.bezierCurveTo(-this.size * 0.8, this.size * 0.5, -this.size * 0.8, -this.size * 0.8, 0, -this.size);

                // Gradient fill
                const grad = ctx.createRadialGradient(0, 0, 0, 0, 0, this.size);
                grad.addColorStop(0, `rgba(${this.color.r + 10}, ${this.color.g + 10}, ${this.color.b + 10}, ${this.opacity})`);
                grad.addColorStop(0.8, `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, ${this.opacity * 0.9})`);
                grad.addColorStop(1, `rgba(244, 114, 182, ${this.opacity * 0.6})`);

                ctx.fillStyle = grad;
                ctx.fill();
                ctx.restore();
            }
        }

        // Initialize Petal Pool (balanced for high performance)
        function initPetals() {
            const count = window.innerWidth < 768 ? 16 : 32;
            petals = [];
            for (let i = 0; i < count; i++) {
                petals.push(new Petal());
            }
        }
        initPetals();

        // Render Loop
        function renderSakura() {
            if (!sakuraEnabled) {
                ctx.clearRect(0, 0, width, height);
                return;
            }

            ctx.clearRect(0, 0, width, height);
            for (let i = 0; i < petals.length; i++) {
                petals[i].update();
                petals[i].draw();
            }

            animationFrameId = requestAnimationFrame(renderSakura);
        }

        // Pause animation when tab is inactive to save battery/resources
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                if (animationFrameId) cancelAnimationFrame(animationFrameId);
            } else if (sakuraEnabled) {
                renderSakura();
            }
        });

        // Start sakura loop
        if (sakuraEnabled) {
            renderSakura();
        }

        // =======================================================
        // 2. JAPANESE KOTO BACKSOUND CONTROLLER
        // =======================================================
        const audio = document.getElementById('aozora-bgm');
        const container = document.getElementById('ambient-hud-container');
        const playBtn = document.getElementById('bgm-play-btn');
        const playIcon = document.getElementById('bgm-play-icon');
        const discIcon = document.getElementById('bgm-disc-icon');
        const statusText = document.getElementById('bgm-status-text');
        const muteBtn = document.getElementById('bgm-mute-btn');
        const volumeIcon = document.getElementById('bgm-volume-icon');
        const sakuraToggleBtn = document.getElementById('sakura-toggle-btn');
        const autoplayHint = document.getElementById('bgm-autoplay-hint');

        // Comfortable gentle background volume
        const TARGET_VOLUME = 0.32;
        audio.volume = TARGET_VOLUME;

        let isPlaying = false;
        let isMuted = false;
        let userPaused = localStorage.getItem('aozora_bgm_user_paused') === 'true';

        function updateUI(playing) {
            isPlaying = playing;
            if (playing) {
                container.classList.add('bgm-playing');
                if (playIcon) playIcon.textContent = 'pause';
                if (statusText) statusText.textContent = 'Sedang Memutar 🌸';
                if (autoplayHint) autoplayHint.classList.add('hidden');
            } else {
                container.classList.remove('bgm-playing');
                if (playIcon) playIcon.textContent = 'play_arrow';
                if (statusText) statusText.textContent = 'Tradisional Koto';
            }
        }

        function playBgm() {
            audio.volume = TARGET_VOLUME;
            const promise = audio.play();
            if (promise !== undefined) {
                promise.then(() => {
                    updateUI(true);
                    userPaused = false;
                    localStorage.setItem('aozora_bgm_user_paused', 'false');
                }).catch(() => {
                    // Browser blocked unprompted autoplay - wait for interaction
                    updateUI(false);
                    if (!userPaused && autoplayHint) {
                        autoplayHint.classList.remove('hidden');
                        autoplayHint.classList.add('flex');
                    }
                });
            }
        }

        function pauseBgm() {
            audio.pause();
            updateUI(false);
            userPaused = true;
            localStorage.setItem('aozora_bgm_user_paused', 'true');
        }

        // Global Ambient API
        window.AozoraAmbient = {
            toggleBgm: function () {
                if (isPlaying) {
                    pauseBgm();
                } else {
                    playBgm();
                }
            },
            toggleMute: function () {
                isMuted = !isMuted;
                audio.muted = isMuted;
                if (volumeIcon) {
                    volumeIcon.textContent = isMuted ? 'volume_off' : 'volume_up';
                }
            },
            toggleSakura: function () {
                sakuraEnabled = !sakuraEnabled;
                localStorage.setItem('aozora_sakura_enabled', sakuraEnabled ? 'true' : 'false');
                if (sakuraToggleBtn) {
                    if (sakuraEnabled) {
                        sakuraToggleBtn.classList.remove('opacity-40');
                        renderSakura();
                    } else {
                        sakuraToggleBtn.classList.add('opacity-40');
                        ctx.clearRect(0, 0, width, height);
                        if (animationFrameId) cancelAnimationFrame(animationFrameId);
                    }
                }
            }
        };

        // Initialize Sakura button visual state
        if (!sakuraEnabled && sakuraToggleBtn) {
            sakuraToggleBtn.classList.add('opacity-40');
        }

        // First user interaction unlocker (for browser autoplay policies)
        function onFirstInteraction() {
            if (!userPaused && !isPlaying) {
                playBgm();
            }
            window.removeEventListener('pointerdown', onFirstInteraction);
            window.removeEventListener('keydown', onFirstInteraction);
        }

        window.addEventListener('pointerdown', onFirstInteraction, { once: true });
        window.addEventListener('keydown', onFirstInteraction, { once: true });

        // Auto-attempt play on load if not explicitly paused by user
        if (!userPaused) {
            playBgm();
        }

        // Livewire navigation persistence
        document.addEventListener('livewire:navigated', function () {
            // Re-bind canvas size if layout shifted
            onResize();
        });
    })();
</script>
