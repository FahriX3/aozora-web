{{-- JAPANESE AMBIENT COMPONENT: FALLING SAKURA PETALS & TRADITIONAL KOTO BGM --}}
<div>
    {{-- 1. Fullscreen Falling Sakura Canvas (Background Layer z-[1]) --}}
    <canvas id="sakura-canvas" class="fixed inset-0 pointer-events-none z-[1] w-full h-full"
        aria-hidden="true"></canvas>

    {{-- 2. Audio Element --}}
    <audio id="aozora-bgm"
        src="{{ asset('audio/koto_bgm.mp3') }}?v={{ file_exists(public_path('audio/koto_bgm.mp3')) ? filemtime(public_path('audio/koto_bgm.mp3')) : '1' }}"
        preload="auto" loop></audio>
</div>

<style>
    /* Equalizer Bouncing Animation */
    @keyframes eq-bounce-1 {

        0%,
        100% {
            height: 4px;
        }

        50% {
            height: 12px;
        }
    }

    @keyframes eq-bounce-2 {

        0%,
        100% {
            height: 12px;
        }

        50% {
            height: 6px;
        }
    }

    @keyframes eq-bounce-3 {

        0%,
        100% {
            height: 6px;
        }

        50% {
            height: 14px;
        }
    }

    @keyframes eq-bounce-4 {

        0%,
        100% {
            height: 10px;
        }

        50% {
            height: 3px;
        }
    }

    .bgm-playing #bgm-equalizer {
        opacity: 1;
    }

    .bgm-playing .eq-bar:nth-child(1) {
        animation: eq-bounce-1 0.8s ease-in-out infinite;
    }

    .bgm-playing .eq-bar:nth-child(2) {
        animation: eq-bounce-2 0.7s ease-in-out infinite 0.1s;
    }

    .bgm-playing .eq-bar:nth-child(3) {
        animation: eq-bounce-3 0.9s ease-in-out infinite 0.2s;
    }

    .bgm-playing .eq-bar:nth-child(4) {
        animation: eq-bounce-4 0.75s ease-in-out infinite 0.15s;
    }

    .bgm-playing #bgm-disc-icon {
        display: inline-block;
        animation: spin 8s linear infinite;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }
</style>

<script>
    (function () {
        // =======================================================
        // 1. FALLING SAKURA ENGINE WITH SCROLL PARALLAX & DEPTH
        // =======================================================
        const canvas = document.getElementById('sakura-canvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');

        let width = canvas.width = window.innerWidth;
        let height = canvas.height = window.innerHeight;

        let petals = [];
        let sakuraEnabled = localStorage.getItem('aozora_sakura_enabled') !== 'false';
        let animationFrameId = null;

        // Scroll Tracking for Natural Parallax Physics
        let lastScrollY = window.pageYOffset || document.documentElement.scrollTop;
        let targetScrollDelta = 0;
        let currentScrollVelocity = 0;

        function onScroll() {
            const currentScrollY = window.pageYOffset || document.documentElement.scrollTop;
            const diff = currentScrollY - lastScrollY;
            lastScrollY = currentScrollY;

            // Cap instant jumps (e.g. clicking anchor link jumping 2000px in 1ms)
            const maxInstantJump = 280;
            if (Math.abs(diff) > maxInstantJump) {
                targetScrollDelta += Math.sign(diff) * maxInstantJump;
            } else {
                targetScrollDelta += diff;
            }
        }
        window.addEventListener('scroll', onScroll, { passive: true });

        // Resize handler
        function onResize() {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
            lastScrollY = window.pageYOffset || document.documentElement.scrollTop;
            targetScrollDelta = 0;
        }
        window.addEventListener('resize', onResize);

        // Sakura Petal Class with 3D Depth Layering
        class Petal {
            constructor() {
                this.reset(true);
            }

            reset(initial = false, fromBottom = false) {
                this.x = Math.random() * width;
                // 3D Parallax Depth: 0.35 (deep background) to 1.05 (near background)
                this.depth = Math.random() * 0.7 + 0.35;

                if (initial) {
                    this.y = Math.random() * height;
                } else if (fromBottom) {
                    this.y = height + 15 + Math.random() * 40;
                } else {
                    this.y = -20 - Math.random() * 50;
                }

                // Scale size and speeds by depth
                this.size = (Math.random() * 6 + 7) * (0.65 + this.depth * 0.45); // 7px - 16px
                this.speedX = (Math.random() * 1.0 + 0.4) * (0.8 + this.depth * 0.3); // drifting right
                this.speedY = (Math.random() * 0.8 + 0.8) * (0.7 + this.depth * 0.35); // gravity fall
                this.angle = Math.random() * Math.PI * 2;
                this.rotationSpeed = (Math.random() - 0.5) * 0.03;
                this.roll = Math.random() * Math.PI * 2;
                this.rollSpeed = Math.random() * 0.035 + 0.015;
                this.swaySpeed = Math.random() * 0.02 + 0.015;
                this.swayOffset = Math.random() * Math.PI * 2;
                this.driftFactor = (Math.random() - 0.3) * 1.5; // individual wind susceptibility
                this.opacity = (Math.random() * 0.25 + 0.5) * (0.6 + this.depth * 0.4); // 0.4 - 0.85

                // Color palette (soft cherry blossom gradients)
                const colors = [
                    { r: 255, g: 183, b: 197 }, // Classic sakura pink
                    { r: 255, g: 197, b: 211 }, // Light blossom
                    { r: 253, g: 226, b: 233 }, // Very soft pastel pink
                    { r: 251, g: 168, b: 188 }  // Deeper rose pink
                ];
                this.color = colors[Math.floor(Math.random() * colors.length)];
            }

            update(scrollStep, scrollVel) {
                // 1. Natural gravity fall
                this.y += this.speedY;

                // 2. Horizontal gentle organic sway
                this.x += Math.sin(this.swayOffset) * 0.75 + this.speedX;
                this.swayOffset += this.swaySpeed;

                // 3. Scroll Parallax Reaction ("ngikutin halaman aslinya"):
                // Scrolling DOWN (page scrolls UP, scrollStep > 0): Petals move UP relative to viewport!
                // Scrolling UP (page scrolls DOWN, scrollStep < 0): Petals move DOWN relative to viewport!
                // Depth factor ensures distant petals move slower, near petals move 1:1 with page
                this.y -= scrollStep * (this.depth * 0.92);

                // 4. Scroll Airflow & Wind Swirl ("lebih fleksible"):
                this.x += scrollStep * 0.035 * this.driftFactor;
                this.angle += this.rotationSpeed + scrollVel * 0.003;
                this.roll += this.rollSpeed + Math.abs(scrollVel) * 0.007;

                // 5. Boundary wrapping & smooth replenishment:
                // Petal moved past top (from user scrolling down quickly)
                if (this.y < -45) {
                    this.reset(false, true); // wrap to bottom
                }
                // Petal moved past bottom (natural fall or user scrolling up quickly)
                else if (this.y > height + 45) {
                    this.reset(false, false); // wrap to top
                }

                // Horizontal wrap-around
                if (this.x > width + 40) {
                    this.x = -35;
                } else if (this.x < -40) {
                    this.x = width + 35;
                }
            }

            draw() {
                ctx.save();
                ctx.translate(this.x, this.y);
                ctx.rotate(this.angle);
                // 3D flipping effect
                ctx.scale(1, Math.cos(this.roll));

                ctx.beginPath();
                // Realistic organic petal curve with heart-notch
                ctx.moveTo(0, -this.size);
                ctx.bezierCurveTo(this.size * 0.8, -this.size * 0.8, this.size * 0.8, this.size * 0.5, 0, this.size);
                ctx.bezierCurveTo(-this.size * 0.8, this.size * 0.5, -this.size * 0.8, -this.size * 0.8, 0, -this.size);

                // Gradient fill
                const grad = ctx.createRadialGradient(0, 0, 0, 0, 0, this.size);
                grad.addColorStop(0, `rgba(${this.color.r + 10}, ${this.color.g + 10}, ${this.color.b + 10}, ${this.opacity})`);
                grad.addColorStop(0.8, `rgba(${this.color.r}, ${this.color.g}, ${this.color.b}, ${this.opacity * 0.9})`);
                grad.addColorStop(1, `rgba(244, 114, 182, ${this.opacity * 0.55})`);

                ctx.fillStyle = grad;
                ctx.fill();
                ctx.restore();
            }
        }

        // Initialize Petal Pool (balanced for high performance 60 FPS)
        function initPetals() {
            const count = window.innerWidth < 768 ? 18 : 34;
            petals = [];
            for (let i = 0; i < count; i++) {
                petals.push(new Petal());
            }
        }
        initPetals();

        // Render Loop with Fluid Damping
        function renderSakura() {
            if (!sakuraEnabled) {
                ctx.clearRect(0, 0, width, height);
                return;
            }

            // Smoothly consume scroll delta with lerp dampening for buttery 60 FPS motion
            const scrollStep = targetScrollDelta * 0.65;
            targetScrollDelta -= scrollStep;
            if (Math.abs(targetScrollDelta) < 0.08) targetScrollDelta = 0;

            // Calculate decaying scroll velocity for wind airflow physics
            currentScrollVelocity = currentScrollVelocity * 0.85 + scrollStep * 0.15;

            ctx.clearRect(0, 0, width, height);
            for (let i = 0; i < petals.length; i++) {
                petals[i].update(scrollStep, currentScrollVelocity);
                petals[i].draw();
            }

            animationFrameId = requestAnimationFrame(renderSakura);
        }

        // Pause animation when tab is inactive to save battery/resources
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                if (animationFrameId) cancelAnimationFrame(animationFrameId);
            } else if (sakuraEnabled) {
                lastScrollY = window.pageYOffset || document.documentElement.scrollTop;
                targetScrollDelta = 0;
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
            if (container) {
                if (playing) {
                    container.classList.add('bgm-playing');
                } else {
                    container.classList.remove('bgm-playing');
                }
            }
            if (playIcon) playIcon.textContent = playing ? 'pause' : 'play_arrow';
            if (statusText) statusText.textContent = playing ? 'Sedang Memutar 🌸' : 'Tradisional Koto';
            if (autoplayHint && playing) autoplayHint.classList.add('hidden');

            // Desktop Navbar Toggle
            const headerBtn = document.getElementById('header-bgm-toggle');
            const headerIcon = document.getElementById('header-bgm-icon');
            const headerDisc = document.getElementById('header-bgm-disc');
            const headerLabel = document.getElementById('header-bgm-label');
            if (headerIcon) {
                headerIcon.textContent = playing ? 'volume_up' : 'volume_off';
            }
            if (headerDisc) {
                headerDisc.style.display = 'inline-block';
                headerDisc.style.animation = playing ? 'spin 4s linear infinite' : 'none';
            }
            if (headerLabel) {
                headerLabel.textContent = 'Musik';
            }
            if (headerBtn) {
                headerBtn.setAttribute('title', playing ? 'Jeda Musik Koto' : 'Putar Musik Koto');
            }

            // Mobile Drawer Toggle (Strip 3)
            const mobileIcon = document.getElementById('mobile-drawer-bgm-icon');
            const mobileDisc = document.getElementById('mobile-drawer-bgm-disc');
            const mobileLabel = document.getElementById('mobile-drawer-bgm-label');
            if (mobileIcon) {
                mobileIcon.textContent = playing ? 'volume_up' : 'volume_off';
            }
            if (mobileDisc) {
                mobileDisc.style.display = 'inline-block';
                mobileDisc.style.animation = playing ? 'spin 4s linear infinite' : 'none';
            }
            if (mobileLabel) {
                mobileLabel.textContent = playing ? 'Musik: Sedang Memutar' : 'Musik: Dijeda';
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