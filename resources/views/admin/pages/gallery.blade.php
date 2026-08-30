@extends('admin.layouts.admin')

@section('title', 'Page Management - Gallery')

@section('content')

@php
    $s = function($key, $default = '') use ($settings) {
        return $settings[$key]->value ?? $default;
    };
    $items = json_decode($s('page_gallery.items', '[]'), true) ?? [];
@endphp

<div style="max-width:900px; margin:0 auto;">
    
    {{-- Header --}}
    <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:24px;">
        <div>
            <h1 style="font-size:24px; font-weight:800; color:#111; letter-spacing:-0.5px; margin-bottom:4px;">Gallery Page</h1>
            <p style="font-size:14px; color:#666;">Kelola tampilan halaman Galeri dan konten foto.</p>
        </div>
        <a href="{{ route('gallery') }}" target="_blank" style="display:inline-flex; align-items:center; gap:8px; font-size:13px; font-weight:600; color:#111; text-decoration:none; padding:8px 16px; border:1px solid #ddd; border-radius:8px; background:#fff;" onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='#fff'">
            Lihat Halaman
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        </a>
    </div>

    @if(session('success'))
        <div style="background:#ECFDF5; border:1px solid #10B981; color:#065F46; padding:12px 16px; border-radius:8px; margin-bottom:24px; font-size:14px; font-weight:500;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background:#FEF2F2; border:1px solid #EF4444; color:#991B1B; padding:12px 16px; border-radius:8px; margin-bottom:24px; font-size:14px; font-weight:500;">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div style="background:#FEF2F2; border:1px solid #EF4444; color:#991B1B; padding:12px 16px; border-radius:8px; margin-bottom:24px; font-size:14px; font-weight:500;">
            <ul style="margin:0; padding-left:16px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 1. SEO & Headline --}}
    <div style="background:#fff; border:1px solid #eee; border-radius:12px; margin-bottom:24px; overflow:hidden;">
        <div style="padding:16px 24px; border-bottom:1px solid #eee; background:#FAFAFA;">
            <h2 style="font-size:15px; font-weight:700; color:#111;">1. SEO & Headline</h2>
        </div>
        <form action="{{ route('admin.pages.gallery.update') }}" method="POST" enctype="multipart/form-data" style="padding:24px;">
            @csrf
            
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
                <div>
                    <label style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:6px;">Meta Title (SEO)</label>
                    <input type="text" name="meta_title" value="{{ $s('page_gallery.meta_title') }}" style="width:100%; padding:10px 14px; border:1px solid #ddd; border-radius:8px; font-size:14px; font-family:inherit; box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:6px;">Meta Description (SEO)</label>
                    <input type="text" name="meta_description" value="{{ $s('page_gallery.meta_description') }}" style="width:100%; padding:10px 14px; border:1px solid #ddd; border-radius:8px; font-size:14px; font-family:inherit; box-sizing:border-box;">
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px;">
                <div>
                    <label style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:6px;">Headline Utama</label>
                    <input type="text" name="headline" value="{{ $s('page_gallery.headline', 'Galeri Foto') }}" style="width:100%; padding:10px 14px; border:1px solid #ddd; border-radius:8px; font-size:14px; font-family:inherit; box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:6px;">Sub-headline</label>
                    <input type="text" name="subheadline" value="{{ $s('page_gallery.subheadline') }}" style="width:100%; padding:10px 14px; border:1px solid #ddd; border-radius:8px; font-size:14px; font-family:inherit; box-sizing:border-box;">
                </div>
            </div>

            <div style="margin-bottom:24px; padding:14px 16px; border:1px solid #D1FAE5; border-radius:8px; background:#ECFDF5; display:flex; align-items:center; gap:12px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <p style="font-size:13px; color:#065F46; margin:0;">Foto Breadcrumb/Banner kini dikelola secara <strong>global</strong> di <a href="{{ route('admin.settings.general') }}" style="color:#047857; font-weight:700;">General Settings → Foto Breadcrumb</a>. Upload di sana untuk mengubah header semua halaman sekaligus.</p>
            </div>

            <button type="submit" style="background:#111; color:#fff; font-weight:600; padding:10px 24px; border:none; border-radius:8px; font-size:14px; cursor:pointer;">Simpan Pengaturan</button>
        </form>
    </div>

    {{-- 2. Gallery Items --}}
    <div style="background:#fff; border:1px solid #eee; border-radius:12px; overflow:hidden; margin-bottom:40px;">
        <div style="padding:16px 24px; border-bottom:1px solid #eee; background:#FAFAFA; display:flex; justify-content:space-between; align-items:center;">
            <h2 style="font-size:15px; font-weight:700; color:#111;">2. Foto Galeri <span style="font-size:13px; font-weight:500; color:#888;">({{ count($items) }} foto)</span></h2>
        </div>
        
        <div style="padding:24px;">
            {{-- Form Tambah Foto --}}
            <form action="{{ route('admin.pages.gallery.add-item') }}" method="POST" enctype="multipart/form-data" style="background:#f9f9f9; padding:20px; border-radius:8px; border:1px dashed #ccc; margin-bottom:24px;">
                @csrf
                <p style="font-size:13px; font-weight:700; color:#333; margin-bottom:14px;">+ Tambah Foto Baru</p>
                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:14px; align-items:end;">
                    <div>
                        <label style="display:block; font-size:12px; font-weight:600; color:#444; margin-bottom:6px;">Upload Foto (Auto WebP) *</label>
                        <input type="file" name="image" required accept="image/*" style="font-size:13px;">
                    </div>
                    <div>
                        <label style="display:block; font-size:12px; font-weight:600; color:#444; margin-bottom:6px;">Alt Text / Keterangan SEO *</label>
                        <input type="text" name="alt" placeholder="Misal: Coach Agam melatih passing" required style="width:100%; padding:8px 12px; border:1px solid #ddd; border-radius:6px; font-size:13px; font-family:inherit; box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block; font-size:12px; font-weight:600; color:#444; margin-bottom:6px;">Caption Tampilan (Opsional)</label>
                        <input type="text" name="caption" placeholder="Keterangan singkat foto" style="width:100%; padding:8px 12px; border:1px solid #ddd; border-radius:6px; font-size:13px; font-family:inherit; box-sizing:border-box;">
                    </div>
                </div>
                <div style="margin-top:14px;">
                    <button type="submit" style="background:#111; color:#fff; font-weight:600; padding:9px 20px; border:none; border-radius:6px; font-size:13px; cursor:pointer;">+ Tambah Foto</button>
                </div>
            </form>

            {{-- Daftar Foto --}}
            @if(count($items) > 0)
                <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(220px, 1fr)); gap:20px;">
                    @foreach($items as $index => $item)
                        <div style="border:1px solid #eee; border-radius:8px; overflow:hidden; background:#fff;">
                            <div style="height:150px; background:#f5f5f5; overflow:hidden;">
                                <img src="{{ asset('storage/'.$item['image']) }}" 
                                     alt="{{ $item['alt'] ?? $item['caption'] ?? 'Gallery' }}" 
                                     style="width:100%; height:100%; object-fit:cover;">
                            </div>
                            <div style="padding:12px;">
                                {{-- Edit Form --}}
                                <form action="{{ route('admin.pages.gallery.update-item', $index) }}" method="POST" style="margin-bottom:8px;">
                                    @csrf
                                    <input type="text" name="alt" value="{{ $item['alt'] ?? '' }}" placeholder="Alt Text SEO" 
                                           style="width:100%; padding:6px 10px; border:1px solid #ddd; border-radius:5px; font-size:12px; margin-bottom:6px; box-sizing:border-box;">
                                    <input type="text" name="caption" value="{{ $item['caption'] ?? '' }}" placeholder="Caption" 
                                           style="width:100%; padding:6px 10px; border:1px solid #ddd; border-radius:5px; font-size:12px; margin-bottom:8px; box-sizing:border-box;">
                                    <button type="submit" style="background:#f0f0f0; border:1px solid #ddd; color:#333; font-size:11px; font-weight:600; padding:5px 12px; border-radius:5px; cursor:pointer; width:100%;">Simpan Perubahan</button>
                                </form>

                                {{-- Delete Form --}}
                                <form action="{{ route('admin.pages.gallery.delete-item', $index) }}" method="POST" onsubmit="return confirm('Hapus foto ini?');">
                                    @csrf
                                    <button type="submit" style="background:transparent; border:1px solid #FCA5A5; color:#EF4444; font-size:11px; font-weight:600; padding:5px 12px; border-radius:5px; cursor:pointer; width:100%;">Hapus Foto</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align:center; padding:48px; color:#888; font-size:14px; border:1px dashed #ddd; border-radius:8px;">
                    Belum ada foto. Tambahkan foto pertama di form di atas.
                </div>
            @endif
        </div>
    </div>

</div>

@endsection
