@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' — Blog Coach Agam')
@section('meta_description', $post->meta_description ?: ($post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->body), 155)))

{{-- Open Graph --}}
@section('og_type', 'article')
@section('og_title', $post->meta_title ?: $post->title)
@section('og_description', $post->meta_description ?: $post->excerpt)
@section('og_url', route('blog.show', $post->slug))
@if($post->featured_image)
    @section('og_image', url('storage/'.$post->featured_image))
    @section('twitter_image', url('storage/'.$post->featured_image))
@endif
@section('twitter_title', $post->meta_title ?: $post->title)

@if($post->meta_keywords)
    @section('meta_keywords', $post->meta_keywords)
@endif

{{-- Article meta --}}
@section('article_published_time', $post->published_at?->toIso8601String())
@section('article_modified_time', $post->updated_at?->toIso8601String())
@section('article_section', $post->category ? \Illuminate\Support\Str::title(str_replace('-', ' ', $post->category)) : 'Blog')

{{-- WebPage schema dates (overrides global @graph datePublished) --}}
@section('webpage_date_published', $post->published_at?->toIso8601String() ?? $post->created_at->toIso8601String())
@section('webpage_date_modified', $post->updated_at->toIso8601String())

@section('schema_extra')
@php
    $__blogLogo = \App\Models\SiteSetting::where('key', 'general.logo')->value('value');
    $__blogLogoUrl = $__blogLogo ? asset('storage/'.$__blogLogo) : asset('images/logo.png');
@endphp
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Article",
  "headline": "{{ addslashes($post->title) }}",
  "description": "{{ addslashes($post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->body), 155)) }}",
  "image": {
    "@@type": "ImageObject",
    "url": "{{ $post->featured_image ? url('storage/'.$post->featured_image) : url('/images/og-default.jpg') }}",
    "width": 1200,
    "height": 630
  },
  "author": {
    "@@type": "Person",
    "@@id": "{{ config('app.url') }}/#coach",
    "name": "{{ $post->author_name }}",
    "url": "{{ url('/profil-coach-agam') }}",
    "sameAs": [
      "https://www.instagram.com/coachagam",
      "https://www.youtube.com/@coachagam",
      "https://www.linkedin.com/in/agam-haris-pambudi",
      "https://www.transfermarkt.com/agam-haris-pambudi/profil/trainer/99999",
      "https://www.facebook.com/coachagam"
    ]
  },
  "publisher": {
    "@@type": "Organization",
    "@@id": "{{ config('app.url') }}/#organization",
    "name": "Coach Agam",
    "logo": {
      "@@type": "ImageObject",
      "url": "{{ $__blogLogoUrl }}"
    }
  },
  "datePublished": "{{ $post->published_at?->toIso8601String() }}",
  "dateModified": "{{ $post->updated_at?->toIso8601String() }}",
  "mainEntityOfPage": {
    "@@type": "WebPage",
    "@@id": "{{ route('blog.show', $post->slug) }}"
  },
  "url": "{{ route('blog.show', $post->slug) }}"
}
</script>

{{-- BreadcrumbList Schema --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BreadcrumbList",
  "itemListElement": [
    {"@@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}"},
    {"@@type": "ListItem", "position": 2, "name": "Blog", "item": "{{ url('/blog') }}"},
    {"@@type": "ListItem", "position": 3, "name": "{{ addslashes($post->title) }}", "item": "{{ url('/blog/'.$post->slug) }}"}
  ]
}
</script>
@endsection

@section('content')

{{-- 1. BREADCRUMB - gunakan featured image artikel, fallback ke global breadcrumb --}}
<x-breadcrumb
    title="{{ $post->title }}"
    subtitle="{{ $post->category ? \Illuminate\Support\Str::title(str_replace('-', ' ', $post->category)) : 'Blog' }}"
    image="{{ $post->featured_image ?: $__globalBreadcrumbImage }}"
    :links="['Beranda' => '/', 'Blog' => '/blog', $post->title => '']"
    titleTag="h2"
/>

{{-- 2. ARTICLE CONTENT --}}
<section style="background:#F8F8F8; padding:60px 0 80px;">
    <div style="max-width:1140px; margin:0 auto; padding:0 40px;">
        <div class="blog-grid" style="display:grid; grid-template-columns:1fr 340px; gap:40px; align-items:start;">

            {{-- MAIN ARTICLE --}}
            <article>
                {{-- Article Header - NO BOX, menyatu background --}}
                <div style="padding:0 0 32px 0; margin-bottom:0;">
                    {{-- Meta Row --}}
                    <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap; margin-bottom:20px;">
                        @if($post->category)
                        <span style="background:#1A1A1A; color:#fff; font-size:9px; font-weight:700; letter-spacing:2px; text-transform:uppercase; padding:5px 14px;">
                            {{ \Illuminate\Support\Str::title(str_replace('-', ' ', $post->category)) }}
                        </span>
                        @endif
                        <span style="font-size:12px; color:#6B7280; font-weight:500;">{{ $post->read_time_text }}</span>
                        <span style="color:#D1D5DB; font-size:12px;">·</span>
                        <span style="font-size:12px; color:#6B7280;">{{ $post->views }} dibaca</span>
                    </div>

                    {{-- H1 adalah satu-satunya di halaman ini. Breadcrumb pakai <h2> di komponen --}}
                    <h1 style="font-size:clamp(26px, 3vw, 40px); font-weight:900; color:#0D0D0D; line-height:1.15; letter-spacing:-1px; margin-bottom:28px;">
                        {{ $post->title }}
                    </h1>

                    {{-- Author Row --}}
                    <div style="display:flex; align-items:center; gap:14px; padding-bottom:32px; border-bottom:2px solid #1A1A1A;">
                        @php $__authorLogo = \App\Models\SiteSetting::where('key', 'general.logo')->value('value'); @endphp
                        <img src="{{ $__authorLogo ? asset('storage/'.$__authorLogo) : asset('images/logo.png') }}"
                             alt="{{ $post->author_name }}"
                             width="44" height="44"
                             loading="lazy"
                             style="width:44px; height:44px; border-radius:8px; object-fit:cover; flex-shrink:0; background:#eee;">
                        <div>
                            <div style="font-size:14px; font-weight:800; color:#1A1A1A; letter-spacing:-0.2px;">{{ $post->author_name }}</div>
                            <div style="font-size:12px; color:#9CA3AF; margin-top:2px;">
                                Diterbitkan {{ $post->published_at ? $post->published_at->translatedFormat('d F Y') : '' }}
                                @if($post->published_at && $post->published_at->ne($post->updated_at))
                                &nbsp;·&nbsp; Diperbarui {{ $post->updated_at->diffForHumans() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Featured Image — LCP candidate, NO lazy loading, fetchpriority=high --}}
                @if($post->featured_image)
                <div style="width:100%; aspect-ratio:16/9; overflow:hidden; margin-bottom:0; background:#E5E7EB;">
                    <img src="{{ asset('storage/'.$post->featured_image) }}"
                         alt="{{ $post->title }}"
                         width="1280" height="720"
                         fetchpriority="high"
                         style="width:100%; height:100%; object-fit:cover; display:block;">
                </div>
                @endif

                {{-- Article Body --}}
                <div style="padding:40px 0;">
                    {{-- Table of Contents --}}
                    <div id="toc-container" style="display:none; background:#fff; border-left:4px solid #1A1A1A; padding:20px 24px; margin-bottom:40px;">
                        <h4 style="font-size:11px; font-weight:800; color:#1A1A1A; margin:0 0 14px; text-transform:uppercase; letter-spacing:2px;">Daftar Isi</h4>
                        <ul id="toc-list" style="margin:0; padding-left:16px; font-size:14px; color:#4B5563; line-height:2;"></ul>
                    </div>

                    <div class="blog-article-content" style="font-size:16px; line-height:1.9; color:#374151; max-width:720px;">
                        {!! $post->body !!}
                    </div>


                {{-- ═══ PREMIUM SILVER CARD: Pelajari & Bagikan ═══ --}}
                <div style="
                    margin-top: 56px;
                    background: linear-gradient(145deg, #F8F8F8 0%, #EFEFEF 40%, #E8E8E8 100%);
                    border: 1px solid #D8D8D8;
                    border-top: 3px solid #1A1A1A;
                    box-shadow: 0 4px 24px rgba(0,0,0,0.07), inset 0 1px 0 rgba(255,255,255,0.8);
                ">
                    {{-- Pelajari Lebih Lanjut --}}
                    <div style="padding: 28px 32px 24px;">
                        <div style="display:flex;align-items:center;gap:10px;margin-bottom:18px;">
                            <div style="width:20px;height:2px;background:#1A1A1A;"></div>
                            <span style="font-size:9px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:#9E9E9E;">Pelajari Lebih Lanjut</span>
                        </div>
                        <div style="display:flex;flex-wrap:wrap;gap:8px;">
                            <a href="{{ route('profil') }}" style="
                                display:inline-flex;align-items:center;gap:7px;
                                font-size:11px;font-weight:600;color:#FFFFFF;
                                text-decoration:none;
                                background:#1A1A1A;
                                border:1px solid #1A1A1A;
                                padding:9px 18px;
                                letter-spacing:0.04em;
                                transition:all 200ms;
                            "
                            onmouseover="this.style.background='#374151';this.style.borderColor='#374151';"
                            onmouseout="this.style.background='#1A1A1A';this.style.borderColor='#1A1A1A';"
                            >
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                Profil Coach Agam
                            </a>
                            <a href="{{ route('ahp-training') }}" style="
                                display:inline-flex;align-items:center;gap:7px;
                                font-size:11px;font-weight:600;color:#FFFFFF;
                                text-decoration:none;
                                background:#1A1A1A;
                                border:1px solid #1A1A1A;
                                padding:9px 18px;
                                letter-spacing:0.04em;
                                transition:all 200ms;
                            "
                            onmouseover="this.style.background='#374151';this.style.borderColor='#374151';"
                            onmouseout="this.style.background='#1A1A1A';this.style.borderColor='#1A1A1A';"
                            >
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                                Program AHP Training
                            </a>
                            <a href="{{ url('/blog?category=modul-kepelatihan') }}" style="
                                display:inline-flex;align-items:center;gap:7px;
                                font-size:11px;font-weight:600;color:#FFFFFF;
                                text-decoration:none;
                                background:#1A1A1A;
                                border:1px solid #1A1A1A;
                                padding:9px 18px;
                                letter-spacing:0.04em;
                                transition:all 200ms;
                            "
                            onmouseover="this.style.background='#374151';this.style.borderColor='#374151';"
                            onmouseout="this.style.background='#1A1A1A';this.style.borderColor='#1A1A1A';"
                            >
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                                Modul Kepelatihan
                            </a>
                            <a href="{{ route('blog.index') }}" style="
                                display:inline-flex;align-items:center;gap:7px;
                                font-size:11px;font-weight:600;color:#FFFFFF;
                                text-decoration:none;
                                background:#1A1A1A;
                                border:1px solid #1A1A1A;
                                padding:9px 18px;
                                letter-spacing:0.04em;
                                transition:all 200ms;
                            "
                            onmouseover="this.style.background='#374151';this.style.borderColor='#374151';"
                            onmouseout="this.style.background='#1A1A1A';this.style.borderColor='#1A1A1A';"
                            >
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/></svg>
                                Semua Artikel Blog
                            </a>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div style="height:1px;background:linear-gradient(90deg,transparent,#C8C8C8,transparent);margin:0 32px;"></div>

                    {{-- Bagikan Artikel --}}
                    <div style="padding:20px 32px 28px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:20px;height:2px;background:#1A1A1A;"></div>
                            <span style="font-size:9px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:#9E9E9E;">Bagikan Artikel</span>
                        </div>
                        <div style="display:flex; gap:6px;">
                            {{-- WhatsApp --}}
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url('/blog/'.$post->slug)) }}" target="_blank" rel="noopener"
                               style="width:36px;height:36px;background:linear-gradient(135deg,#FFFFFF,#F0F0F0);border:1px solid #C8C8C8;box-shadow:0 1px 4px rgba(0,0,0,0.06);display:flex;align-items:center;justify-content:center;color:#1A1A1A;text-decoration:none;transition:all 200ms;"
                               onmouseover="this.style.background='#25D366';this.style.color='#fff';this.style.borderColor='#25D366';this.style.boxShadow='none';" onmouseout="this.style.background='linear-gradient(135deg,#FFFFFF,#F0F0F0)';this.style.color='#1A1A1A';this.style.borderColor='#C8C8C8';this.style.boxShadow='0 1px 4px rgba(0,0,0,0.06)';" title="WhatsApp">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                            </a>
                            {{-- Facebook --}}
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/blog/'.$post->slug)) }}" target="_blank" rel="noopener"
                               style="width:36px;height:36px;background:linear-gradient(135deg,#FFFFFF,#F0F0F0);border:1px solid #C8C8C8;box-shadow:0 1px 4px rgba(0,0,0,0.06);display:flex;align-items:center;justify-content:center;color:#1A1A1A;text-decoration:none;transition:all 200ms;"
                               onmouseover="this.style.background='#1877F2';this.style.color='#fff';this.style.borderColor='#1877F2';this.style.boxShadow='none';" onmouseout="this.style.background='linear-gradient(135deg,#FFFFFF,#F0F0F0)';this.style.color='#1A1A1A';this.style.borderColor='#C8C8C8';this.style.boxShadow='0 1px 4px rgba(0,0,0,0.06)';" title="Facebook">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            {{-- Twitter/X --}}
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url('/blog/'.$post->slug)) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener"
                               style="width:36px;height:36px;background:linear-gradient(135deg,#FFFFFF,#F0F0F0);border:1px solid #C8C8C8;box-shadow:0 1px 4px rgba(0,0,0,0.06);display:flex;align-items:center;justify-content:center;color:#1A1A1A;text-decoration:none;transition:all 200ms;"
                               onmouseover="this.style.background='#000';this.style.color='#fff';this.style.borderColor='#000';this.style.boxShadow='none';" onmouseout="this.style.background='linear-gradient(135deg,#FFFFFF,#F0F0F0)';this.style.color='#1A1A1A';this.style.borderColor='#C8C8C8';this.style.boxShadow='0 1px 4px rgba(0,0,0,0.06)';" title="X (Twitter)">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            </a>
                            {{-- Telegram --}}
                            <a href="https://t.me/share/url?url={{ urlencode(url('/blog/'.$post->slug)) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener"
                               style="width:36px;height:36px;background:linear-gradient(135deg,#FFFFFF,#F0F0F0);border:1px solid #C8C8C8;box-shadow:0 1px 4px rgba(0,0,0,0.06);display:flex;align-items:center;justify-content:center;color:#1A1A1A;text-decoration:none;transition:all 200ms;"
                               onmouseover="this.style.background='#229ED9';this.style.color='#fff';this.style.borderColor='#229ED9';this.style.boxShadow='none';" onmouseout="this.style.background='linear-gradient(135deg,#FFFFFF,#F0F0F0)';this.style.color='#1A1A1A';this.style.borderColor='#C8C8C8';this.style.boxShadow='0 1px 4px rgba(0,0,0,0.06)';" title="Telegram">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                            </a>
                            {{-- Copy Link --}}
                            <button id="copy-link-btn" onclick="navigator.clipboard.writeText('{{ url('/blog/'.$post->slug) }}').then(()=>{ document.getElementById('copy-link-btn').innerHTML='<svg width=\'13\' height=\'13\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2.5\'><polyline points=\'20 6 9 17 4 12\'/></svg>'; setTimeout(()=>{ document.getElementById('copy-link-btn').innerHTML='<svg width=\'14\' height=\'14\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\'><path d=\'M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71\'/><path d=\'M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71\'/></svg>'; },2000) })"
                               style="width:36px;height:36px;background:linear-gradient(135deg,#FFFFFF,#F0F0F0);border:1px solid #C8C8C8;box-shadow:0 1px 4px rgba(0,0,0,0.06);display:flex;align-items:center;justify-content:center;color:#1A1A1A;cursor:pointer;transition:all 200ms;"
                               onmouseover="this.style.background='#1A1A1A';this.style.color='#fff';this.style.borderColor='#1A1A1A';this.style.boxShadow='none';" onmouseout="this.style.background='linear-gradient(135deg,#FFFFFF,#F0F0F0)';this.style.color='#1A1A1A';this.style.borderColor='#C8C8C8';this.style.boxShadow='0 1px 4px rgba(0,0,0,0.06)';" title="Salin Tautan">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- FAQ SECTION --}}
                @if(!empty($post->faq) && is_array($post->faq))
                <div style="padding:40px 0 0; border-top:0;">
                    <h3 style="font-size:22px; font-weight:900; color:#0D0D0D; margin-bottom:24px; letter-spacing:-0.5px;">Pertanyaan Sering Diajukan (FAQ)</h3>
                    <div style="display:flex; flex-direction:column; gap:2px;">
                        @foreach($post->faq as $faq)
                        <details style="background:#fff; border-left:4px solid #1A1A1A; padding:0; cursor:pointer; group;">
                            <summary style="font-size:15px; font-weight:700; color:#1A1A1A; outline:none; user-select:none; padding:18px 20px; list-style:none; display:flex; justify-content:space-between; align-items:center;">
                                {{ $faq['q'] }}
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0; margin-left:12px;"><polyline points="6 9 12 15 18 9"/></svg>
                            </summary>
                            <div style="font-size:14px; color:#4B5563; line-height:1.8; padding:0 20px 20px;">
                                {{ $faq['a'] }}
                            </div>
                        </details>
                        @endforeach
                    </div>
                </div>
                @endif
            </article>

            {{-- SIDEBAR --}}
            <aside style="position:sticky; top:100px;">
                {{-- About Author Card --}}
                <div style="margin-bottom:2px;">
                    <x-profile-card />
                </div>

                {{-- Related Posts --}}
                @if($relatedPosts->count() > 0)
                <div style="background:#FFFFFF; border:1px solid #E5E7EB; padding:24px; margin-bottom:2px;">
                    <div style="font-size:10px; font-weight:700; letter-spacing:2px; color:#9CA3AF; text-transform:uppercase; margin-bottom:16px;">Artikel Terkait</div>
                    <div style="display:flex; flex-direction:column; gap:16px;">
                        @foreach($relatedPosts as $related)
                        <a href="{{ route('blog.show', $related->slug) }}" style="display:flex; gap:14px; text-decoration:none; padding-bottom:16px; border-bottom:1px solid #F3F4F6;">
                            <div style="width:64px; height:64px; background:#E5E7EB; flex-shrink:0; overflow:hidden;">
                                @if($related->featured_image)
                                    <img src="{{ asset('storage/'.$related->featured_image) }}" alt="{{ $related->title }}" width="64" height="64" loading="lazy" style="width:100%; height:100%; object-fit:cover;">
                                @else
                                    <div style="width:100%; height:100%; background:#1A1A1A;"></div>
                                @endif
                            </div>
                            <div>
                                <div style="font-size:13px; font-weight:600; color:#1A1A1A; line-height:1.4; margin-bottom:4px;" onmouseover="this.style.color='#6B7280'" onmouseout="this.style.color='#1A1A1A'">{{ \Illuminate\Support\Str::limit($related->title, 60) }}</div>
                                <div style="font-size:11px; color:#9CA3AF;">{{ $related->read_time_text }}</div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- CTA Removed to accommodate Profile Card --}}
            </aside>

        </div>
    </div>
</section>

{{-- 3. RELATED ARTICLES (Full-width Premium) --}}
@if($relatedPosts->count() > 0)
<section style="background:#0D0D0D; padding:80px 0;" aria-label="Artikel Terkait">
    <div style="max-width:1200px; margin:0 auto; padding:0 40px; box-sizing:border-box;">

        {{-- Header --}}
        <div style="display:flex; align-items:flex-end; justify-content:space-between; margin-bottom:48px; flex-wrap:wrap; gap:16px;">
            <div>
                <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px;">
                    <span style="font-size:10px; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:#4B5563;">Lanjutkan Membaca</span>
                    <div style="width:32px; height:1px; background:rgba(255,255,255,0.1);"></div>
                </div>
                <h2 style="font-size:clamp(22px, 3vw, 36px); line-height:1.1; letter-spacing:-1px; margin:0;">
                    <span style="font-weight:900; color:#FFFFFF;">Artikel</span>
                    <span style="font-weight:300; font-style:italic; color:#4B5563;"> Terkait</span>
                </h2>
            </div>
            <a href="{{ route('blog.index') }}" style="font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:rgba(255,255,255,0.3); text-decoration:none; display:flex; align-items:center; gap:8px; transition:color 150ms;" onmouseover="this.style.color='rgba(255,255,255,0.8)'" onmouseout="this.style.color='rgba(255,255,255,0.3)'">
                Semua Artikel
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </div>

        {{-- Cards Grid --}}
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:1px; background:rgba(255,255,255,0.05);">
            @foreach($relatedPosts as $rel)
            <article style="background:#0D0D0D;">
                <a href="{{ route('blog.show', $rel->slug) }}" style="display:block; text-decoration:none; height:100%;" onmouseover="this.closest('article').style.background='#161616'" onmouseout="this.closest('article').style.background='#0D0D0D'">
                    {{-- Image --}}
                    <figure style="aspect-ratio:16/9; background:#161616; overflow:hidden; margin:0;">
                        @if($rel->featured_image)
                            <img src="{{ asset('storage/'.$rel->featured_image) }}"
                                 alt="{{ $rel->title }} — artikel pelatihan sepakbola Coach Agam"
                                 width="400" height="225" loading="lazy"
                                 style="width:100%; height:100%; object-fit:cover; filter:contrast(1.05) saturate(0.9); transition:transform 400ms;"
                                 onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
                        @else
                            <div style="width:100%; height:100%; background:linear-gradient(135deg,#1A1A1A,#2A2A2A); display:flex; align-items:center; justify-content:center;">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            </div>
                        @endif
                    </figure>

                    {{-- Content --}}
                    <div style="padding:24px;">
                        <div style="font-size:9px; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:#4B5563; margin-bottom:10px;">
                            {{ \Illuminate\Support\Str::title(str_replace('-', ' ', $rel->category)) }}
                        </div>
                        <h3 style="font-size:15px; font-weight:700; color:#E5E5E5; line-height:1.4; margin-bottom:12px; letter-spacing:-0.2px;">
                            {{ \Illuminate\Support\Str::limit($rel->title, 70) }}
                        </h3>
                        <div style="display:flex; align-items:center; gap:8px; font-size:11px; color:#4B5563;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            {{ $rel->read_time_text }}
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- 4. Article Content Styling & Scripts --}}
<style>
.blog-article-content h1, .blog-article-content h4, .blog-article-content h5 {
    font-weight: 800; color: #0D0D0D; line-height: 1.25; letter-spacing: -0.3px; margin: 32px 0 16px;
}
.blog-article-content h2, .blog-article-content h3 {
    font-weight: 400; color: #0D0D0D; line-height: 1.25; letter-spacing: -0.3px; margin: 32px 0 16px;
}
.blog-article-content h2 b, .blog-article-content h3 b,
.blog-article-content h2 strong, .blog-article-content h3 strong {
    font-weight: 700;
}
.blog-article-content h1 { font-size: 28px; }
.blog-article-content h2 { font-size: 22px; }
.blog-article-content h3 { font-size: 18px; }
.blog-article-content h4 { font-size: 15px; }
.blog-article-content p { margin-bottom: 20px; }
.blog-article-content strong { font-weight: 700; color: #111; }
.blog-article-content a { color: #1A1A1A; font-weight: 600; text-decoration: underline; }
.blog-article-content ul, .blog-article-content ol { margin: 0 0 20px 24px; }
.blog-article-content li { margin-bottom: 8px; }
.blog-article-content blockquote {
    border-left: 4px solid #1A1A1A; margin: 28px 0; padding: 16px 24px;
    background: #F9FAFB; font-style: italic; color: #4B5563;
}
.blog-article-content img { max-width: 100%; height: auto; border-radius: 4px; margin: 24px 0; }
.blog-article-content pre, .blog-article-content code {
    background: #F3F4F6; border-radius: 4px; font-family: monospace; font-size: 13px;
}
.blog-article-content pre { padding: 20px; overflow-x: auto; margin: 20px 0; }
.blog-article-content code { padding: 2px 6px; }

@media (max-width: 900px) {
    .blog-grid { grid-template-columns: 1fr !important; }
}
@media (max-width: 600px) {
    .blog-grid { gap: 32px !important; }
    .blog-article-content { max-width: 100% !important; }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const article = document.querySelector('.blog-article-content');
    if(article) {
        const headings = article.querySelectorAll('h2, h3');
        if(headings.length > 0) {
            const tocContainer = document.getElementById('toc-container');
            const tocList = document.getElementById('toc-list');
            tocContainer.style.display = 'block';
            
            headings.forEach((heading, index) => {
                const id = 'heading-' + index;
                heading.id = id;
                
                const li = document.createElement('li');
                li.style.marginBottom = '6px';
                if(heading.tagName === 'H3') {
                    li.style.marginLeft = '16px';
                    li.style.listStyleType = 'circle';
                }
                
                const a = document.createElement('a');
                a.href = '#' + id;
                a.textContent = heading.innerText;
                a.style.color = '#374151';
                a.style.textDecoration = 'none';
                a.onmouseover = () => a.style.textDecoration = 'underline';
                a.onmouseout = () => a.style.textDecoration = 'none';
                
                li.appendChild(a);
                tocList.appendChild(li);
            });
        }
    }
});
</script>

@endsection
