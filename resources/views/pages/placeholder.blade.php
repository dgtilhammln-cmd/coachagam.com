@extends('layouts.app')

@section('title', $page . ' — Coach Agam')
@section('meta_description', 'Halaman ' . $page . ' — Coach Agam, Pelatih Sepakbola Profesional Indonesia.')
@section('canonical', url()->current())

@section('content')
    @if(isset($settings) && isset($key))
        <x-breadcrumb 
            title="{{ $settings['page_'.$key.'.headline']->value ?? $page }}"
            subtitle="{{ $settings['page_'.$key.'.subheadline']->value ?? 'Segera hadir dengan konten terbaik untuk Anda.' }}"
            image="{{ $__globalBreadcrumbImage }}"
            :links="['Beranda' => '/', $page => '']"
        />
    @else
        <x-breadcrumb 
            title="{{ $page }}"
            subtitle="Segera hadir dengan konten terbaik untuk Anda."
            image="{{ $__globalBreadcrumbImage }}"
            :links="['Beranda' => '/', $page => '']"
        />
    @endif

    <section
        style="min-height:40vh;display:flex;align-items:center;justify-content:center;padding:80px 24px;background:#0F0F0F;">
        <div style="text-align:center;max-width:480px;">
            {{-- Icon --}}
            <div
                style="width:64px;height:64px;border-radius:0;background:rgba(192,192,192,0.08);border:1px solid rgba(192,192,192,0.2);display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#A8A8A8" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="12" />
                    <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
            </div>

            <p style="font-size:16px;color:#6B7280;line-height:1.7;margin:0 0 32px;">
                Halaman ini sedang dalam pengembangan.
            </p>

            <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('home') }}"
                    style="display:inline-flex;align-items:center;gap:7px;background:linear-gradient(135deg,#F0F0F0,#C0C0C0,#A8A8A8);color:#0F0F0F;font-size:14px;font-weight:700;padding:11px 22px;border-radius:0;text-decoration:none;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        aria-hidden="true">
                        <polyline points="15 18 9 12 15 6" />
                    </svg>
                    Kembali ke Beranda
                </a>
                <a href="{{ route('kontak') }}"
                    style="display:inline-flex;align-items:center;gap:7px;background:#1A1A1A;color:#D3D3D3;font-size:14px;font-weight:600;padding:11px 22px;border-radius:0;text-decoration:none;border:1px solid rgba(211,211,211,0.25);">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

<x-cta-kerjasama />

@endsection