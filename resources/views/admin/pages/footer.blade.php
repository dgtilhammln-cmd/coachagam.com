@extends('admin.layouts.admin')

@section('title', 'Footer — Page Management')

@section('content')
<div style="max-width: 960px; margin: 0 auto; padding: 40px 32px;">

    {{-- Header --}}
    <div style="margin-bottom: 32px;">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
            <div style="width: 36px; height: 36px; background: rgba(255,255,255,0.07); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#aaa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
            </div>
            <div>
                <h1 style="font-size: 20px; font-weight: 700; color: #F5F5F5; margin: 0; letter-spacing: -0.3px;">Pengaturan Footer</h1>
                <p style="font-size: 13px; color: #555; margin: 0;">Kelola semua konten yang tampil di footer website.</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div style="background: rgba(52,211,153,0.1); border: 1px solid rgba(52,211,153,0.3); color: #6EE7B7; padding: 14px 18px; border-radius: 10px; font-size: 13px; font-weight: 600; margin-bottom: 28px; display: flex; align-items: center; gap: 10px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.pages.footer.update') }}" method="POST">
        @csrf

        {{-- ─── NOTE: Logo & Kontak ──────────────────────────────────── --}}
        <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07); border-radius: 12px; padding: 20px 24px; margin-bottom: 24px;">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span style="font-size: 12px; font-weight: 600; color: #6B7280; text-transform: uppercase; letter-spacing: 1px;">Info</span>
            </div>
            <p style="font-size: 13px; color: #666; margin: 0; line-height: 1.6;">
                <strong style="color: #999;">Logo, Nomor WhatsApp, Email, dan Alamat</strong> diambil otomatis dari menu
                <a href="{{ route('admin.settings.general') }}" style="color: #A1A1AA; text-decoration: underline;">Site Settings → General</a>.
                <br>
                <strong style="color: #999;">Icon Media Sosial</strong> diambil dari menu
                <a href="{{ route('admin.pages.profile') }}" style="color: #A1A1AA; text-decoration: underline;">Page Management → Profile Coach Agam</a>.
            </p>
        </div>

        {{-- ─── KOLOM NAVIGASI ─────────────────────────────────────────── --}}
        <div style="background: #161616; border: 1px solid rgba(255,255,255,0.07); border-radius: 14px; overflow: hidden; margin-bottom: 24px;">
            <div style="padding: 20px 24px; border-bottom: 1px solid rgba(255,255,255,0.05);">
                <h2 style="font-size: 14px; font-weight: 700; color: #E5E5E5; margin: 0 0 2px;">Kolom Navigasi</h2>
                <p style="font-size: 12px; color: #555; margin: 0;">Daftar tautan yang muncul di kolom kiri footer.</p>
            </div>
            <div style="padding: 20px 24px;" id="nav-links-container">
                @foreach($navLinks as $i => $link)
                <div class="link-row" data-type="nav" style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 12px; align-items: center; margin-bottom: 12px;">
                    <div>
                        <label style="font-size: 11px; color: #555; display: block; margin-bottom: 4px;">Label</label>
                        <input type="text" name="nav_links[{{ $i }}][label]" value="{{ $link['label'] }}" required
                            style="width: 100%; box-sizing: border-box; background: #1A1A1A; border: 1px solid rgba(255,255,255,0.08); border-radius: 7px; padding: 9px 12px; font-size: 13px; color: #ddd; outline: none;"
                            onfocus="this.style.borderColor='rgba(255,255,255,0.2)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
                    </div>
                    <div>
                        <label style="font-size: 11px; color: #555; display: block; margin-bottom: 4px;">URL / Href</label>
                        <input type="text" name="nav_links[{{ $i }}][href]" value="{{ $link['href'] }}" required
                            style="width: 100%; box-sizing: border-box; background: #1A1A1A; border: 1px solid rgba(255,255,255,0.08); border-radius: 7px; padding: 9px 12px; font-size: 13px; color: #ddd; outline: none;"
                            onfocus="this.style.borderColor='rgba(255,255,255,0.2)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
                    </div>
                    <button type="button" onclick="this.closest('.link-row').remove()" title="Hapus baris"
                        style="width: 32px; height: 32px; background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2); border-radius: 7px; color: #f87171; cursor: pointer; display: flex; align-items: center; justify-content: center; margin-top: 16px; flex-shrink: 0;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>
                    </button>
                </div>
                @endforeach
            </div>
            <div style="padding: 0 24px 20px;">
                <button type="button" onclick="addLinkRow('nav-links-container', 'nav_links')"
                    style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: rgba(255,255,255,0.04); border: 1px dashed rgba(255,255,255,0.12); border-radius: 7px; color: #666; font-size: 12px; font-weight: 600; cursor: pointer;">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                    Tambah Link
                </button>
            </div>
        </div>

        {{-- ─── KOLOM LAYANAN ───────────────────────────────────────────── --}}
        <div style="background: #161616; border: 1px solid rgba(255,255,255,0.07); border-radius: 14px; overflow: hidden; margin-bottom: 24px;">
            <div style="padding: 20px 24px; border-bottom: 1px solid rgba(255,255,255,0.05);">
                <h2 style="font-size: 14px; font-weight: 700; color: #E5E5E5; margin: 0 0 2px;">Kolom Layanan</h2>
                <p style="font-size: 12px; color: #555; margin: 0;">Daftar tautan yang muncul di kolom layanan footer.</p>
            </div>
            <div style="padding: 20px 24px;" id="service-links-container">
                @foreach($serviceLinks as $i => $link)
                <div class="link-row" data-type="service" style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 12px; align-items: center; margin-bottom: 12px;">
                    <div>
                        <label style="font-size: 11px; color: #555; display: block; margin-bottom: 4px;">Label</label>
                        <input type="text" name="service_links[{{ $i }}][label]" value="{{ $link['label'] }}" required
                            style="width: 100%; box-sizing: border-box; background: #1A1A1A; border: 1px solid rgba(255,255,255,0.08); border-radius: 7px; padding: 9px 12px; font-size: 13px; color: #ddd; outline: none;"
                            onfocus="this.style.borderColor='rgba(255,255,255,0.2)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
                    </div>
                    <div>
                        <label style="font-size: 11px; color: #555; display: block; margin-bottom: 4px;">URL / Href</label>
                        <input type="text" name="service_links[{{ $i }}][href]" value="{{ $link['href'] }}" required
                            style="width: 100%; box-sizing: border-box; background: #1A1A1A; border: 1px solid rgba(255,255,255,0.08); border-radius: 7px; padding: 9px 12px; font-size: 13px; color: #ddd; outline: none;"
                            onfocus="this.style.borderColor='rgba(255,255,255,0.2)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
                    </div>
                    <button type="button" onclick="this.closest('.link-row').remove()" title="Hapus baris"
                        style="width: 32px; height: 32px; background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2); border-radius: 7px; color: #f87171; cursor: pointer; display: flex; align-items: center; justify-content: center; margin-top: 16px; flex-shrink: 0;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>
                    </button>
                </div>
                @endforeach
            </div>
            <div style="padding: 0 24px 20px;">
                <button type="button" onclick="addLinkRow('service-links-container', 'service_links')"
                    style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; background: rgba(255,255,255,0.04); border: 1px dashed rgba(255,255,255,0.12); border-radius: 7px; color: #666; font-size: 12px; font-weight: 600; cursor: pointer;">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                    Tambah Link
                </button>
            </div>
        </div>

        {{-- ─── PENGATURAN UMUM ─────────────────────────────────────────── --}}
        <div style="background: #161616; border: 1px solid rgba(255,255,255,0.07); border-radius: 14px; overflow: hidden; margin-bottom: 32px;">
            <div style="padding: 20px 24px; border-bottom: 1px solid rgba(255,255,255,0.05);">
                <h2 style="font-size: 14px; font-weight: 700; color: #E5E5E5; margin: 0 0 2px;">Pengaturan Umum Footer</h2>
                <p style="font-size: 12px; color: #555; margin: 0;">Teks hak cipta dan tautan kebijakan di bagian bawah.</p>
            </div>
            <div style="padding: 20px 24px; display: flex; flex-direction: column; gap: 20px;">
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #888; text-transform: uppercase; letter-spacing: 0.8px; display: block; margin-bottom: 8px;">Teks Copyright</label>
                    <input type="text" name="copyright_text" value="{{ $copyrightText }}"
                        style="width: 100%; box-sizing: border-box; background: #1A1A1A; border: 1px solid rgba(255,255,255,0.08); border-radius: 8px; padding: 11px 14px; font-size: 13px; color: #ddd; outline: none;"
                        onfocus="this.style.borderColor='rgba(255,255,255,0.2)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'"
                        placeholder="&copy; 2026 Coach Agam. All rights reserved.">
                    <p style="font-size: 11px; color: #555; margin: 6px 0 0;">Mendukung HTML (misalnya &amp;copy; untuk simbol ©).</p>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 600; color: #888; text-transform: uppercase; letter-spacing: 0.8px; display: block; margin-bottom: 8px;">Link Privacy Policy</label>
                        <input type="text" name="privacy_link" value="{{ $privacyLink }}"
                            style="width: 100%; box-sizing: border-box; background: #1A1A1A; border: 1px solid rgba(255,255,255,0.08); border-radius: 8px; padding: 11px 14px; font-size: 13px; color: #ddd; outline: none;"
                            onfocus="this.style.borderColor='rgba(255,255,255,0.2)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'"
                            placeholder="https://... atau /privacy">
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 600; color: #888; text-transform: uppercase; letter-spacing: 0.8px; display: block; margin-bottom: 8px;">Link Terms of Service</label>
                        <input type="text" name="terms_link" value="{{ $termsLink }}"
                            style="width: 100%; box-sizing: border-box; background: #1A1A1A; border: 1px solid rgba(255,255,255,0.08); border-radius: 8px; padding: 11px 14px; font-size: 13px; color: #ddd; outline: none;"
                            onfocus="this.style.borderColor='rgba(255,255,255,0.2)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'"
                            placeholder="https://... atau /terms">
                    </div>
                </div>
            </div>
        </div>

        {{-- Save Button --}}
        <div style="display: flex; justify-content: flex-end;">
            <button type="submit"
                style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px; background: #fff; color: #111; border: none; border-radius: 9px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 150ms;"
                onmouseover="this.style.background='#E5E5E5'" onmouseout="this.style.background='#fff'">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Simpan Pengaturan Footer
            </button>
        </div>
    </form>
</div>

<script>
function addLinkRow(containerId, fieldName) {
    const container = document.getElementById(containerId);
    const rows = container.querySelectorAll('.link-row');
    const index = rows.length;

    const row = document.createElement('div');
    row.className = 'link-row';
    row.style.cssText = 'display: grid; grid-template-columns: 1fr 1fr auto; gap: 12px; align-items: center; margin-bottom: 12px;';
    row.innerHTML = `
        <div>
            <label style="font-size: 11px; color: #555; display: block; margin-bottom: 4px;">Label</label>
            <input type="text" name="${fieldName}[${index}][label]" required placeholder="Nama Link"
                style="width: 100%; box-sizing: border-box; background: #1A1A1A; border: 1px solid rgba(255,255,255,0.08); border-radius: 7px; padding: 9px 12px; font-size: 13px; color: #ddd; outline: none;"
                onfocus="this.style.borderColor='rgba(255,255,255,0.2)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
        </div>
        <div>
            <label style="font-size: 11px; color: #555; display: block; margin-bottom: 4px;">URL / Href</label>
            <input type="text" name="${fieldName}[${index}][href]" required placeholder="/ atau https://..."
                style="width: 100%; box-sizing: border-box; background: #1A1A1A; border: 1px solid rgba(255,255,255,0.08); border-radius: 7px; padding: 9px 12px; font-size: 13px; color: #ddd; outline: none;"
                onfocus="this.style.borderColor='rgba(255,255,255,0.2)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'">
        </div>
        <button type="button" onclick="this.closest('.link-row').remove()" title="Hapus baris"
            style="width: 32px; height: 32px; background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2); border-radius: 7px; color: #f87171; cursor: pointer; display: flex; align-items: center; justify-content: center; margin-top: 16px; flex-shrink: 0;">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
    `;
    container.appendChild(row);
}
</script>
@endsection
