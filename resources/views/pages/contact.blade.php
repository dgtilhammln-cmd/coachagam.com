@extends('layouts.app')

@section('title', 'Kontak — Coach Agam')
@section('meta_description', 'Hubungi Coach Agam untuk kolaborasi, konsultasi, atau program pelatihan sepakbola profesional.')
@section('canonical', url()->current())

@section('content')
    @php
        // Try to get settings if available
        $settings = \App\Models\SiteSetting::where('group', 'page_kontak')
            ->orWhere('group', 'contact')
            ->get()->keyBy('key');
            
        $address = $settings['contact.location']->value ?? 'Jakarta, Indonesia';
        $email = $settings['contact.email']->value ?? 'info@coachagam.com';
        $waNum = $settings['contact.whatsapp_number']->value ?? '6281234567890';
        $waMsg = $settings['contact.whatsapp_message']->value ?? 'Halo Coach Agam, saya ingin berdiskusi.';
        $waUrl = "https://wa.me/" . preg_replace('/[^0-9]/', '', $waNum) . "?text=" . urlencode($waMsg);
    @endphp

    @php
        $headline = $settings['page_kontak.headline']->value ?? 'Hubungi Kami';
        $subheadline = $settings['page_kontak.subheadline']->value ?? 'Kami siap membantu pengembangan karir sepakbola Anda. Silakan isi form di bawah atau hubungi kami secara langsung melalui WhatsApp atau Email.';
        $bgImage = $settings['page_kontak.breadcrumb_image']->value ?? '';
    @endphp

    <x-breadcrumb 
        title="{{ $headline }}"
        subtitle="{{ $subheadline }}"
        image="{{ $__globalBreadcrumbImage }}"
        :links="['Beranda' => '/', 'Kontak' => '']"
    />

    {{-- Main Content --}}
    <section style="padding:80px 24px; background:#FAFAFA;">
        <div style="max-width:1140px; margin:0 auto; display:grid; grid-template-columns:1fr 1.5fr; gap:64px;" class="contact-grid">
            
            {{-- Left: Contact Info --}}
            <div>
                <h2 style="font-size:1.8rem; font-weight:700; color:#1A1A1A; margin-bottom:32px;">Informasi Kontak</h2>
                
                <div style="display:flex; flex-direction:column; gap:24px; margin-bottom:48px;">
                    <div style="display:flex; align-items:flex-start; gap:16px;">
                        <div style="width:48px; height:48px; background:#FFFFFF; border:1px solid #E5E7EB; border-radius:0; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1A1A1A" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <h3 style="font-size:14px; font-weight:700; color:#1A1A1A; margin:0 0 4px;">Alamat</h3>
                            <p style="font-size:14px; color:#4B5563; margin:0; line-height:1.5;">{{ $address }}</p>
                        </div>
                    </div>
                    
                    <div style="display:flex; align-items:flex-start; gap:16px;">
                        <div style="width:48px; height:48px; background:#FFFFFF; border:1px solid #E5E7EB; border-radius:0; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1A1A1A" stroke-width="2"><path d="M4 4h16v12H4z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div>
                            <h3 style="font-size:14px; font-weight:700; color:#1A1A1A; margin:0 0 4px;">Email</h3>
                            <p style="font-size:14px; color:#4B5563; margin:0;"><a href="mailto:{{ $email }}" style="color:inherit; text-decoration:none;">{{ $email }}</a></p>
                        </div>
                    </div>
                    
                    <div style="display:flex; align-items:flex-start; gap:16px;">
                        <div style="width:48px; height:48px; background:#FFFFFF; border:1px solid #E5E7EB; border-radius:0; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1A1A1A" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <div>
                            <h3 style="font-size:14px; font-weight:700; color:#1A1A1A; margin:0 0 4px;">WhatsApp</h3>
                            <p style="font-size:14px; color:#4B5563; margin:0;">{{ $waNum }}</p>
                        </div>
                    </div>
                </div>

                {{-- WA Button --}}
                <div style="background:#FFFFFF; padding:24px; border-radius:0; border:1px solid #E5E7EB; text-align:center;">
                    <h3 style="font-size:16px; font-weight:700; color:#1A1A1A; margin:0 0 8px;">Butuh Respons Cepat?</h3>
                    <p style="font-size:13px; color:#6B7280; margin:0 0 16px;">Konsultasi langsung dengan tim kami via WhatsApp untuk mendapatkan solusi terbaik.</p>
                    <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" 
                       style="display:inline-flex; align-items:center; justify-content:center; gap:8px; width:100%; background:#25D366; color:#FFFFFF; padding:14px; border-radius:0; font-weight:700; font-size:14px; text-decoration:none; transition:background 0.2s;"
                       onmouseover="this.style.background='#1DA851'" onmouseout="this.style.background='#25D366'">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6 6l.92-.92a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        Hubungi via WhatsApp
                    </a>
                </div>
            </div>

            {{-- Right: Contact Form --}}
            <div style="background:#FFFFFF; padding:40px; border-radius:0; border:1px solid #E5E7EB;">
                <h2 style="font-size:1.8rem; font-weight:700; color:#1A1A1A; margin-bottom:8px;">Kirim Pesan</h2>
                <p style="font-size:14px; color:#6B7280; margin-bottom:32px;">Punya pertanyaan? Isi form di bawah ini dan kami akan merespons secepat mungkin.</p>
                
                @if(session('success_contact'))
                    <div style="background:#DEF7EC; color:#03543F; padding:16px; border-radius:8px; margin-bottom:24px; font-size:14px; font-weight:600; display:flex; align-items:center; gap:8px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        {{ session('success_contact') }}
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;" class="form-grid">
                        <div>
                            <label for="name" style="display:block; font-size:13px; font-weight:600; color:#4B5563; margin-bottom:8px;">Nama Lengkap *</label>
                            <input type="text" id="name" name="name" required value="{{ old('name') }}" 
                                   style="width:100%; box-sizing:border-box; padding:14px; border:1px solid #D1D5DB; border-radius:0; outline:none; transition:border 0.2s;" onfocus="this.style.borderColor='#1A1A1A'" onblur="this.style.borderColor='#D1D5DB'" placeholder="Budi Santoso">
                            @error('name') <span style="color:#DC2626; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="phone" style="display:block; font-size:13px; font-weight:600; color:#4B5563; margin-bottom:8px;">Nomor WA / Telepon *</label>
                            <input type="tel" id="phone" name="phone" required value="{{ old('phone') }}" 
                                   style="width:100%; box-sizing:border-box; padding:14px; border:1px solid #D1D5DB; border-radius:0; outline:none; transition:border 0.2s;" onfocus="this.style.borderColor='#1A1A1A'" onblur="this.style.borderColor='#D1D5DB'" placeholder="08123456789">
                            @error('phone') <span style="color:#DC2626; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;" class="form-grid">
                        <div>
                            <label for="email" style="display:block; font-size:13px; font-weight:600; color:#4B5563; margin-bottom:8px;">Email Aktif *</label>
                            <input type="email" id="email" name="email" required value="{{ old('email') }}" 
                                   style="width:100%; box-sizing:border-box; padding:14px; border:1px solid #D1D5DB; border-radius:0; outline:none; transition:border 0.2s;" onfocus="this.style.borderColor='#1A1A1A'" onblur="this.style.borderColor='#D1D5DB'" placeholder="email@anda.com">
                            @error('email') <span style="color:#DC2626; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="service" style="display:block; font-size:13px; font-weight:600; color:#4B5563; margin-bottom:8px;">Kategori Layanan</label>
                            <select id="service" name="service" 
                                    style="width:100%; box-sizing:border-box; padding:14px; border:1px solid #D1D5DB; border-radius:0; outline:none; appearance:none; background:url('data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'16\' height=\'16\' fill=\'none\' stroke=\'%236B7280\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'><polyline points=\'6 9 12 15 18 9\'/></svg>') no-repeat right 14px center; transition:border 0.2s;" onfocus="this.style.borderColor='#1A1A1A'" onblur="this.style.borderColor='#D1D5DB'">
                                <option value="">Pilih Kategori (Opsional)</option>
                                <option value="AHP Training" {{ old('service') == 'AHP Training' ? 'selected' : '' }}>AHP Training</option>
                                <option value="Private Coaching" {{ old('service') == 'Private Coaching' ? 'selected' : '' }}>Private Coaching</option>
                                <option value="Team Consultation" {{ old('service') == 'Team Consultation' ? 'selected' : '' }}>Team Consultation</option>
                                <option value="Kerjasama Lainnya" {{ old('service') == 'Kerjasama Lainnya' ? 'selected' : '' }}>Kerjasama Lainnya</option>
                            </select>
                            @error('service') <span style="color:#DC2626; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div style="margin-bottom:32px;">
                        <label for="message" style="display:block; font-size:13px; font-weight:600; color:#4B5563; margin-bottom:8px;">Pesan Anda *</label>
                        <textarea id="message" name="message" required rows="5" 
                                  style="width:100%; box-sizing:border-box; padding:14px; border:1px solid #D1D5DB; border-radius:0; outline:none; resize:vertical; font-family:inherit; transition:border 0.2s;" onfocus="this.style.borderColor='#1A1A1A'" onblur="this.style.borderColor='#D1D5DB'" placeholder="Tuliskan detail pertanyaan atau keperluan Anda di sini...">{{ old('message') }}</textarea>
                        @error('message') <span style="color:#DC2626; font-size:12px; margin-top:4px; display:block;">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" 
                            style="width:100%; background:#1A1A1A; color:#FFFFFF; border:none; border-radius:0; padding:16px; font-size:14px; font-weight:700; letter-spacing:1px; cursor:pointer; text-transform:uppercase; transition:all 0.2s;"
                            onmouseover="this.style.background='#333333'; this.style.transform='translateY(-2px)';" 
                            onmouseout="this.style.background='#1A1A1A'; this.style.transform='translateY(0)';">
                        Kirim Pesan Sekarang
                    </button>
                </form>
            </div>
            
        </div>
    </section>

    <style>
        @media(max-width: 900px) {
            .contact-grid {
                grid-template-columns: 1fr !important;
                gap: 48px !important;
            }
        }
        @media(max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>

    <x-cta-kerjasama />
@endsection
