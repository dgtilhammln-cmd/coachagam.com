@props([
    'post' => null
])

@php
    if (!$post) return;
@endphp

<a href="{{ route('blog.show', $post->slug) }}" class="blog-card" style="background:#FFFFFF; display:flex; flex-direction:column; text-decoration:none; transition:all 300ms ease; border:1px solid #E5E7EB; border-radius:0; font-family:'Montserrat',sans-serif;" 
   onmouseover="this.style.background='#F9FAFB'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.03)'; this.style.transform='translateY(-2px)';" 
   onmouseout="this.style.background='#FFFFFF'; this.style.boxShadow='none'; this.style.transform='none';">
    {{-- Image --}}
    <div style="aspect-ratio:16/9; background:#E5E7EB; overflow:hidden; position:relative; flex-shrink:0;">
        @if($post->featured_image)
            <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}"
                 style="width:100%; height:100%; object-fit:cover; transition:transform 400ms; display:block;"
                 onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
        @else
            <div style="width:100%; height:100%; background:linear-gradient(135deg,#1A1A1A 0%,#3A3A3A 100%); display:flex; align-items:center; justify-content:center;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
            </div>
        @endif
        @if($post->category)
        <div style="position:absolute; top:12px; left:12px; background:#1A1A1A; color:#fff; font-size:9px; font-weight:700; letter-spacing:2px; text-transform:uppercase; padding:4px 10px; font-family:'Montserrat',sans-serif;">
            {{ \Illuminate\Support\Str::title(str_replace('-', ' ', $post->category)) }}
        </div>
        @endif
    </div>
    {{-- Content --}}
    <div style="padding:24px; display:flex; flex-direction:column; flex-grow:1;">
        <div style="flex-grow:1;">
            <h3 style="font-size:17px; font-weight:700; color:#0D0D0D; line-height:1.3; margin-bottom:10px; letter-spacing:-0.2px; font-family:'Montserrat',sans-serif;">{{ $post->title }}</h3>
            <p style="font-size:13px; line-height:1.65; color:#6B7280; margin-bottom:16px; font-family:'Montserrat',sans-serif;">
                {{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->body), 100) }}
            </p>
        </div>
        <div style="display:flex; align-items:center; justify-content:space-between; border-top:1px solid #F3F4F6; padding-top:14px; margin-top:auto;">
            <div style="font-size:11px; color:#9CA3AF; font-weight:600; font-family:'Montserrat',sans-serif; text-transform:uppercase; letter-spacing:0.5px;">{{ $post->author_name }}</div>
            <div style="font-size:11px; color:#9CA3AF; font-family:'Montserrat',sans-serif;">{{ $post->read_time_text }}</div>
        </div>
    </div>
</a>
