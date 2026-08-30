@extends('layouts.app')

@section('title', $meta_title ?? 'Galeri | Coach Agam')
@section('meta_description', $meta_description ?? 'Koleksi momen dan kegiatan Coach Agam dalam dunia sepakbola profesional.')
@section('og_image', asset('storage/' . (\App\Models\SiteSetting::where('key', 'general.og_image')->value('value') ?? '')))

@section('content')

    <x-breadcrumb 
        title="{{ $headline }}"
        subtitle="{{ $subheadline }}"
        image="{{ $__globalBreadcrumbImage }}"
        :links="['Beranda' => '/', 'Galeri' => '']"
    />

{{-- Gallery Grid Section --}}
<section style="background:#FAFAFA; padding:80px 24px; min-height:60vh;">
    <div style="max-width:1400px; margin:0 auto;">
        
        @if(count($items) > 0)
            <div class="gallery-masonry">
                @foreach($items as $index => $item)
                    <div class="gallery-item" 
                         x-data="{ shown: false }" 
                         x-intersect.once="shown = true"
                         :style="shown ? 'opacity:1; transform:translateY(0); transition:all 0.8s cubic-bezier(0.16,1,0.3,1) {{ $index * 0.1 }}s' : 'opacity:0; transform:translateY(30px)'">
                        
                        <div class="gallery-card" 
                             style="cursor:pointer;" 
                             @click="$dispatch('open-lightbox', { src: '{{ asset('storage/'.$item['image']) }}', caption: '{{ addslashes($item['caption'] ?? '') }}' })">
                            <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['alt'] ?? $item['caption'] ?? 'Galeri Coach Agam' }}" loading="lazy">
                            <div class="gallery-overlay">
                                @if(!empty($item['caption']))
                                    <h3 class="gallery-caption">{{ $item['caption'] }}</h3>
                                @endif
                                <div class="gallery-zoom-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align:center; padding:100px 20px; color:#999;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="margin-bottom:16px; opacity:0.5;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <p style="font-size:1.2rem; font-weight:300;">Galeri foto belum tersedia.</p>
            </div>
        @endif

    </div>
</section>

<style>
/* Modern Centered Grid Layout */
.gallery-masonry {
    display: grid;
    /* Lebar foto optimal (sekitar 380px), otomatis turun baris jika layar kecil, selalu di tengah */
    grid-template-columns: repeat(auto-fit, minmax(320px, 380px));
    justify-content: center;
    gap: 32px;
}

.gallery-item {
    width: 100%;
}

.gallery-card {
    position: relative;
    border-radius: 0;
    overflow: hidden;
    background: #fff;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    border: 1px solid #E5E7EB;
    transform: translateZ(0);
}

.gallery-card img {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
}

.gallery-overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 50%, rgba(0,0,0,0) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 24px;
}

.gallery-caption {
    color: #fff;
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
    transform: translateY(15px);
    transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.gallery-zoom-icon {
    position: absolute;
    top: 24px; right: 24px;
    color: #fff;
    opacity: 0.8;
    transform: scale(0.8);
    transition: all 0.4s ease;
}

.gallery-card:hover img {
    transform: scale(1.05);
}

.gallery-card:hover .gallery-overlay {
    opacity: 1;
}

.gallery-card:hover .gallery-caption {
    transform: translateY(0);
}

.gallery-card:hover .gallery-zoom-icon {
    transform: scale(1);
    opacity: 1;
}
</style>

<x-cta-kerjasama />

@endsection
