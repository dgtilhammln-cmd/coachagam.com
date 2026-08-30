@extends('admin.layouts.admin')

@section('title', 'Page Management - ' . $pageTitle)

@section('content')

@php
    $s = function($key, $default = '') use ($settings, $page) {
        $fullKey = 'page_' . $page . '.' . $key;
        return $settings[$fullKey]->value ?? $default;
    };
@endphp

<div style="max-width:800px; margin:0 auto;">
    
    {{-- Header --}}
    <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:24px;">
        <div>
            <h1 style="font-size:24px; font-weight:800; color:#111; letter-spacing:-0.5px; margin-bottom:4px;">{{ $pageTitle }}</h1>
            <p style="font-size:14px; color:#666;">Kelola tampilan header dan SEO untuk halaman ini.</p>
        </div>
    </div>

    @if(session('success'))
        <div style="background:#ECFDF5; border:1px solid #10B981; color:#065F46; padding:12px 16px; border-radius:8px; margin-bottom:24px; font-size:14px; font-weight:500;">
            {{ session('success') }}
        </div>
    @endif

    {{-- General & SEO Settings --}}
    <div style="background:#fff; border:1px solid #eee; border-radius:12px; margin-bottom:24px; overflow:hidden;">
        <div style="padding:16px 24px; border-bottom:1px solid #eee; background:#FAFAFA;">
            <h2 style="font-size:15px; font-weight:700; color:#111;">Pengaturan Halaman & Banner</h2>
        </div>
        <form action="{{ route('admin.pages.generic.update', $page) }}" method="POST" enctype="multipart/form-data" style="padding:24px;">
            @csrf
            
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px;">
                <div>
                    <label style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:6px;">Headline Utama</label>
                    <input type="text" name="headline" value="{{ $s('headline', $pageTitle) }}" placeholder="Contoh: {{ $pageTitle }}" style="width:100%; padding:10px 14px; border:1px solid #ddd; border-radius:8px; font-size:14px; font-family:inherit; box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:6px;">Sub-headline (Opsional)</label>
                    <input type="text" name="subheadline" value="{{ $s('subheadline') }}" placeholder="Contoh: Info selengkapnya..." style="width:100%; padding:10px 14px; border:1px solid #ddd; border-radius:8px; font-size:14px; font-family:inherit; box-sizing:border-box;">
                </div>
            </div>

            <div style="margin-bottom:24px; padding:14px 16px; border:1px solid #D1FAE5; border-radius:8px; background:#ECFDF5; display:flex; align-items:center; gap:12px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <p style="font-size:13px; color:#065F46; margin:0;">Foto Breadcrumb/Banner kini dikelola secara <strong>global</strong> di <a href="{{ route('admin.settings.general') }}" style="color:#047857; font-weight:700;">General Settings → Foto Breadcrumb</a>. Upload di sana untuk mengubah header semua halaman sekaligus.</p>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px;">
                <div>
                    <label style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:6px;">Meta Title (SEO)</label>
                    <input type="text" name="meta_title" value="{{ $s('meta_title', $pageTitle . ' | Coach Agam') }}" style="width:100%; padding:10px 14px; border:1px solid #ddd; border-radius:8px; font-size:14px; font-family:inherit; box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:6px;">Meta Description (SEO)</label>
                    <input type="text" name="meta_description" value="{{ $s('meta_description') }}" style="width:100%; padding:10px 14px; border:1px solid #ddd; border-radius:8px; font-size:14px; font-family:inherit; box-sizing:border-box;">
                </div>
            </div>

            <button type="submit" style="background:#111; color:#fff; font-weight:600; padding:10px 24px; border:none; border-radius:8px; font-size:14px; cursor:pointer; letter-spacing:0.3px;">Simpan Pengaturan</button>
        </form>
    </div>

</div>

@endsection
