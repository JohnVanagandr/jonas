import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Asignamos la app al objeto window para que welcome.blade.php la encuentre
window.nightmareApp = function() {
    return {
        modalOpen: false,
        modalOpenedAt: 0,
        selectedGiftId: null,
        selectedGiftName: '',
        musicPlaying: false,
        audioInit: false,
        showScrollTop: false, 
        isSubmitting: false, 
        
        init() {
            window.addEventListener('scroll', () => {
                this.showScrollTop = window.scrollY > 400;
            });

            const unlockAudio = () => {
                if (!this.audioInit) this.startAudio();
            };
            // passive + capture: nunca bloquea ni cancela el toque del usuario
            window.addEventListener('pointerup', unlockAudio, { once: true, passive: true, capture: true });

            this.bindGiftButtons();

            // Ejecutamos el observador de scroll SOLO en PC
            if (window.innerWidth >= 1024) {
                setTimeout(() => {
                    const observer = new IntersectionObserver((entries, obs) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('is-visible');
                                obs.unobserve(entry.target); 
                            }
                        });
                    }, {
                        rootMargin: '100px',
                        threshold: 0 
                    });

                    document.querySelectorAll('.reveal-card').forEach(card => {
                        observer.observe(card);
                    });
                }, 100);
            }
        },
        
        // Listeners nativos delegados en fase de captura, independientes del render de Alpine
        bindGiftButtons() {
            let lastFire = 0;
            let start = null;

            const fire = (btn) => {
                const now = Date.now();
                if (now - lastFire < 600) return; // dedupe touchend + click
                lastFire = now;
                this.openGift(Number(btn.dataset.giftId), btn.dataset.giftName || '');
            };
            const findBtn = (e) => e.target && e.target.closest ? e.target.closest('.js-gift-btn') : null;

            document.addEventListener('touchstart', (e) => {
                const t = e.touches[0];
                start = t ? { x: t.clientX, y: t.clientY } : null;
            }, { passive: true, capture: true });

            document.addEventListener('touchend', (e) => {
                const btn = findBtn(e);
                if (!btn || !start) return;
                const t = e.changedTouches[0];
                const moved = Math.abs(t.clientX - start.x) > 10 || Math.abs(t.clientY - start.y) > 10;
                start = null;
                if (moved) return; // fue scroll, no toque
                if (e.cancelable) e.preventDefault(); // evita el click fantasma
                fire(btn);
            }, { passive: false, capture: true });

            document.addEventListener('click', (e) => {
                const btn = findBtn(e);
                if (btn) fire(btn);
            }, { capture: true });
        },

        startAudio() {
            if (!this.audioInit) {
                this.audioInit = true;
                const music = this.$refs.bgMusic;
                if (music) {
                    try {
                        music.volume = 0.4;
                        const p = music.play();
                        if (p && p.then) {
                            p.then(() => { this.musicPlaying = true; })
                             .catch(() => { this.audioInit = false; });
                        }
                    } catch (e) {
                        this.audioInit = false;
                    }
                }
            }
        },
        
        toggleMusic() {
            const music = this.$refs.bgMusic;
            if (!music) return;

            if (this.musicPlaying) {
                music.pause();
                this.musicPlaying = false;
            } else {
                music.volume = 0.4;
                music.play().then(() => {
                    this.musicPlaying = true;
                    this.audioInit = true;
                }).catch(e => {});
            }
        },
        
        openGift(id, name) {
            if (this.modalOpen) return;
            this.selectedGiftId = id;
            this.selectedGiftName = name;
            this.modalOpenedAt = Date.now();
            this.modalOpen = true;
            // El audio se difiere: nunca debe bloquear la apertura del modal
            setTimeout(() => this.playClick(), 0);
        },

        closeModalFromOutside() {
            // Evita que el mismo toque que abre el modal lo cierre en móviles
            if (Date.now() - this.modalOpenedAt < 400) return;
            if (!this.isSubmitting) this.modalOpen = false;
        },

        playClick() {
            try {
                if (!this.audioInit) {
                    this.startAudio();
                    return;
                }
                const sfx = this.$refs.clickSfx;
                if (sfx) {
                    sfx.currentTime = 0;
                    const p = sfx.play();
                    if (p && p.catch) p.catch(() => {});
                }
            } catch (e) {}
        },

        scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }
};

Alpine.start();