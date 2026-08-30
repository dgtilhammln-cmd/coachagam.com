@props([
    'title' => 'Judul Halaman',
    'subtitle' => null,
    'image' => null,
    'links' => [],
    'titleTag' => 'h1'
])

<style>
    /* bc-wrap: no margin-top so it's truly centered inside bc-section flex */
    .bc-wrap { padding:48px 24px; max-width:800px; position:relative; z-index:3; margin-left:auto; margin-right:auto; width:100%; }
    .bc-links { display:flex; align-items:center; justify-content:center; gap:8px; margin-bottom:16px; font-size:12px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#fff; text-shadow: 0 1px 4px rgba(0,0,0,0.8); }
    .bc-title { font-size:clamp(1.5rem, 3.5vw, 2.5rem); font-weight:800; letter-spacing:-0.5px; color:#fff; line-height:1.3; margin:0 0 12px 0; text-transform:uppercase; }
    .bc-subtitle { font-size:1rem; font-weight:400; color:#E5E7EB; max-width:600px; margin:0 auto; letter-spacing:0.5px; line-height:1.6; }
    .bc-section { position:relative; width:100%; min-height:45vh; display:flex; align-items:center; justify-content:center; text-align:center; overflow:hidden; background:#111; }
    @media (max-width: 768px) {
        .bc-section { min-height: 200px; }
        .bc-wrap { padding:28px 16px; }
        .bc-links { font-size:10px; margin-bottom:10px; }
        .bc-title { font-size:clamp(1.1rem, 5vw, 1.5rem); margin-bottom:6px; letter-spacing:-0.2px; }
        .bc-subtitle { font-size:0.85rem; line-height:1.4; }
    }
</style>

<section class="bc-section">
    {{-- Background Image --}}
    @if(!empty($image))
        <div style="position:absolute; inset:0; z-index:1;">
            <img src="{{ asset('storage/'.$image) }}" alt="Banner {{ $title ?? '' }}" style="width:100%; height:100%; object-fit:cover; display:block; filter:grayscale(20%);">
        </div>
    @else
        {{-- Fallback Subtle Grid Background --}}
        <div style="position:absolute; inset:0; opacity:0.04; background-image:linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size:40px 40px; pointer-events:none; z-index:1;"></div>
    @endif

    {{-- Dark Gradient Overlay (Tegas) --}}
    <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.6) 50%, rgba(0,0,0,0.85) 100%); z-index:2;"></div>

    {{-- Content --}}
    <div class="bc-wrap" x-data="{ shown: false }" x-intersect.once="shown = true">
        
        {{-- Breadcrumb Links --}}
        @if(!empty($links))
        @php
            // Mencegah judul muncul 2 kali (di path dan di title besar)
            $filteredLinks = [];
            foreach($links as $label => $url) {
                if(strcasecmp(trim($label), trim($title)) !== 0) {
                    $filteredLinks[$label] = $url;
                }
            }
        @endphp
        @if(count($filteredLinks) > 0)
        <div class="bc-links"
             :style="shown ? 'opacity:1; transform:translateY(0); transition:all 0.8s cubic-bezier(0.16,1,0.3,1)' : 'opacity:0; transform:translateY(20px)'">
            @foreach($filteredLinks as $label => $url)
                @if(!$loop->last)
                    <a href="{{ $url }}" style="color:#fff; text-decoration:none; transition:color 150ms;" onmouseover="this.style.color='#ddd'" onmouseout="this.style.color='#fff'">{{ $label }}</a>
                    <span style="color:#bbb;">/</span>
                @else
                    <span style="color:#ddd;">{{ $label }}</span>
                @endif
            @endforeach
        </div>
        @endif
        @endif

        {{-- Main Title --}}
        <{{ $titleTag }} class="bc-title"
            :style="shown ? 'opacity:1; transform:translateY(0); transition:all 0.8s cubic-bezier(0.16,1,0.3,1) 0.1s' : 'opacity:0; transform:translateY(30px)'">
            {!! $title ?? 'Judul Halaman' !!}
        </{{ $titleTag }}>

        {{-- Subtitle --}}
        @if(!empty($subtitle))
        <p class="bc-subtitle"
           :style="shown ? 'opacity:1; transform:translateY(0); transition:all 0.8s cubic-bezier(0.16,1,0.3,1) 0.2s' : 'opacity:0; transform:translateY(30px)'">
            {!! $subtitle !!}
        </p>
        @endif
    </div>
</section>
