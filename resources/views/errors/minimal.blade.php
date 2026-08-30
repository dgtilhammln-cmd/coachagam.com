@extends('layouts.app')

@section('title')
    @yield('title') — Coach Agam
@endsection

@section('content')
<section style="min-height: 80vh; display: flex; align-items: center; justify-content: center; background: #0D0D0D; color: #FFFFFF; padding: 60px 24px; text-align: center; position: relative; overflow: hidden;">
    {{-- Decorative grid background --}}
    <div style="position: absolute; inset: 0; opacity: 0.03; background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 40px 40px; pointer-events: none;"></div>
    
    {{-- Soft gradient glow --}}
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 600px; height: 600px; background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%); pointer-events: none;"></div>

    <div style="position: relative; z-index: 2; max-width: 600px; width: 100%;">
        <div style="font-size: clamp(80px, 15vw, 150px); font-weight: 900; line-height: 1; margin-bottom: 16px; background: linear-gradient(135deg, #FFFFFF, #9CA3AF); -webkit-background-clip: text; -webkit-text-fill-color: transparent; opacity: 0.9;">
            @yield('code')
        </div>
        <h1 style="font-size: clamp(20px, 5vw, 32px); font-weight: 800; margin-bottom: 24px; text-transform: uppercase; letter-spacing: 2px;">
            @yield('message')
        </h1>
        <p style="font-size: 15px; color: #9CA3AF; line-height: 1.6; margin-bottom: 40px; font-weight: 300;">
            Maaf, halaman yang Anda tuju tidak dapat ditemukan atau sedang terjadi kesalahan sistem. Silakan kembali ke halaman utama untuk melanjutkan.
        </p>
        
        <a href="{{ url('/') }}" style="display: inline-flex; align-items: center; justify-content: center; padding: 18px 36px; background: #FFFFFF; color: #0D0D0D; text-decoration: none; font-weight: 800; font-size: 12px; letter-spacing: 3px; text-transform: uppercase; transition: all 0.3s; box-shadow: 0 10px 30px rgba(255,255,255,0.1);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 12px;"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Kembali ke Beranda
        </a>
    </div>
</section>
@endsection
