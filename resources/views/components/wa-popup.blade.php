<style>
    [x-cloak] { display: none !important; }
    .wa-popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter', 'Montserrat', sans-serif;
        padding: 20px;
        box-sizing: border-box;
    }
    .wa-popup-modal {
        position: relative;
        background: #FFFFFF;
        width: 100%;
        max-width: 420px;
        border-radius: 20px;
        box-shadow: 0 20px 40px -10px rgba(0,0,0,0.3);
        max-height: 90vh;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
    }
    .wa-popup-header {
        background: linear-gradient(135deg, #111111, #2A2A2A);
        padding: 32px 32px 24px;
        color: #FFFFFF;
        position: relative;
        flex-shrink: 0;
    }
    .wa-close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 36px;
        height: 36px;
        background: rgba(255,255,255,0.1);
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFFFFF;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(4px);
    }
    .wa-close-btn:hover {
        background: rgba(255,255,255,0.25);
        transform: rotate(90deg);
    }
    .wa-popup-body {
        padding: 32px;
        background: #FFFFFF;
    }
    .wa-input-group {
        margin-bottom: 20px;
    }
    .wa-input-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    .wa-input-wrapper {
        position: relative;
    }
    .wa-input-icon {
        position: absolute;
        left: 16px;
        top: 14px;
        color: #9CA3AF;
        transition: color 0.3s;
        pointer-events: none;
    }
    .wa-input, .wa-textarea {
        width: 100%;
        background: #F9FAFB;
        border: 1px solid #E5E7EB;
        border-radius: 12px;
        padding: 14px 16px 14px 46px;
        font-size: 14px;
        color: #111827;
        outline: none;
        box-sizing: border-box;
        transition: all 0.3s ease;
    }
    .wa-textarea {
        padding-left: 16px;
        resize: none;
        min-height: 100px;
    }
    .wa-input:focus, .wa-textarea:focus {
        background: #FFFFFF;
        border-color: #111111;
        box-shadow: 0 0 0 4px rgba(17,17,17,0.05);
    }
    .wa-submit-btn {
        width: 100%;
        padding: 16px;
        background: #111111;
        color: #FFFFFF;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.3s;
        margin-top: 10px;
    }
    .wa-submit-btn:hover:not(:disabled) {
        background: #222222;
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }
    .wa-submit-btn:active:not(:disabled) {
        transform: translateY(0);
    }
    .wa-submit-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    @media (max-width: 480px) {
        .wa-popup-modal { max-height: 95vh; }
        .wa-popup-header { padding: 24px 24px 20px; }
        .wa-popup-body { padding: 24px; }
    }
</style>

<div x-data="waPopupComponent()" 
     @open-wa-popup.window="openPopup($event.detail.url)"
     x-show="isOpen"
     x-cloak
     class="wa-popup-overlay">
    
    <!-- Backdrop -->
    <div x-show="isOpen" 
         x-transition.opacity.duration.300ms
         @click="closePopup()"
         style="position: absolute; inset: 0; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px);"></div>

    <!-- Modal -->
    <div x-show="isOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-8"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-8"
         class="wa-popup-modal">
        
        <!-- Header -->
        <div class="wa-popup-header">
            <button type="button" @click="closePopup()" class="wa-close-btn" title="Tutup">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
            </button>
            
            <div style="display:flex; align-items:center; gap:16px; margin-bottom:12px;">
                <div style="width:48px; height:48px; border-radius:50%; background:rgba(255,255,255,0.15); display:flex; align-items:center; justify-content:center;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                </div>
                <div>
                    <h3 style="margin:0; font-size:22px; font-weight:700; letter-spacing:-0.5px;">Tanya Coach Agam</h3>
                    <div style="display:flex; align-items:center; gap:6px; margin-top:4px;">
                        <span style="display:inline-block; width:8px; height:8px; background:#10B981; border-radius:50%;"></span>
                        <span style="font-size:12px; font-weight:500; color:rgba(255,255,255,0.8);">Online & siap membalas</span>
                    </div>
                </div>
            </div>
            <p style="margin:0; font-size:13px; color:rgba(255,255,255,0.7); line-height:1.6;">Halo! Silakan lengkapi form singkat ini agar saya bisa merespons kebutuhan Anda dengan cepat dan akurat.</p>
        </div>

        <!-- Body -->
        <div class="wa-popup-body">
            <form @submit.prevent="submitForm" style="margin: 0;">
                
                <div class="wa-input-group">
                    <label for="wa_name" class="wa-input-label">Nama Lengkap</label>
                    <div class="wa-input-wrapper">
                        <div class="wa-input-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <input type="text" id="wa_name" x-model="form.name" required placeholder="Masukkan nama Anda" class="wa-input" @focus="$el.previousElementSibling.style.color='#111'" @blur="$el.previousElementSibling.style.color='#9CA3AF'">
                    </div>
                </div>
                
                <div class="wa-input-group">
                    <label for="wa_phone" class="wa-input-label">Nomor WhatsApp</label>
                    <div class="wa-input-wrapper">
                        <div class="wa-input-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <input type="tel" id="wa_phone" x-model="form.phone" required placeholder="Contoh: 08123456789" class="wa-input" @focus="$el.previousElementSibling.style.color='#111'" @blur="$el.previousElementSibling.style.color='#9CA3AF'">
                    </div>
                </div>

                <div class="wa-input-group">
                    <label for="wa_kebutuhan" class="wa-input-label">Ada yang bisa dibantu?</label>
                    <textarea id="wa_kebutuhan" x-model="form.kebutuhan" required placeholder="Tuliskan pertanyaan atau kebutuhan Anda di sini..." class="wa-textarea" oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </div>

                <!-- Error Message -->
                <div x-show="errorMessage" x-text="errorMessage" style="color: #DC2626; font-size: 13px; margin-bottom: 20px; padding: 12px; background: #FEF2F2; border-radius: 8px; border: 1px solid #FCA5A5; display: none;"></div>

                <button type="submit" :disabled="isLoading" class="wa-submit-btn">
                    <span x-show="!isLoading">Kirim Pesan WhatsApp</span>
                    <span x-show="isLoading" style="display:none;">Memproses...</span>
                    <svg x-show="!isLoading" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function waPopupComponent() {
    return {
        isOpen: false,
        isLoading: false,
        targetUrl: '',
        errorMessage: '',
        form: {
            name: '',
            phone: '',
            kebutuhan: ''
        },
        openPopup(url) {
            this.targetUrl = url;
            this.isOpen = true;
            this.errorMessage = '';
            document.body.style.overflow = 'hidden';
            setTimeout(() => { document.getElementById('wa_name')?.focus() }, 100);
        },
        closePopup() {
            this.isOpen = false;
            document.body.style.overflow = '';
        },
        async submitForm() {
            this.isLoading = true;
            this.errorMessage = '';
            
            try {
                const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

                const response = await fetch('/api/wa-lead', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        name: this.form.name,
                        phone: this.form.phone,
                        kebutuhan: this.form.kebutuhan,
                        target_url: this.targetUrl
                    })
                });

                const data = await response.json();
                
                if (response.ok || response.status === 201) {
                    // Format pesan khusus ke nomor WA tujuan
                    const textMessage = `Halo Coach Agam,\n\nPerkenalkan saya *${this.form.name}*.\n\nSaya ingin berdiskusi mengenai:\n${this.form.kebutuhan}`;
                    
                    // Parse target URL
                    let finalUrl = data.redirect_url || this.targetUrl;
                    try {
                        let urlObj = new URL(finalUrl);
                        urlObj.searchParams.set('text', textMessage);
                        finalUrl = urlObj.toString();
                    } catch (e) {
                        if (finalUrl.includes('?')) {
                            finalUrl += '&text=' + encodeURIComponent(textMessage);
                        } else {
                            finalUrl += '?text=' + encodeURIComponent(textMessage);
                        }
                    }

                    // Reset form & Close
                    this.form.name = '';
                    this.form.phone = '';
                    this.form.kebutuhan = '';
                    this.closePopup();
                    
                    // Redirect
                    window.open(finalUrl, '_blank');
                } else {
                    this.errorMessage = data.message || 'Terjadi kesalahan, silakan coba lagi.';
                }
            } catch (error) {
                console.error(error);
                this.errorMessage = 'Gagal menghubungi server. Periksa koneksi Anda.';
            } finally {
                this.isLoading = false;
            }
        }
    }
}
</script>
