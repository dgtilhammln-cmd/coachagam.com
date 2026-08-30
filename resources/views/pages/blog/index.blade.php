@extends('layouts.app')

@section('title', 'Blog — Coach Agam')
@section('meta_description', 'Artikel seputar Sport Science, Materi Kepelatihan, dan Filosofi & Spiritualitas dari Coach Agam.')

@section('schema_extra')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Blog",
  "name": "Blog Coach Agam",
  "description": "Artikel seputar Sport Science, Materi Kepelatihan, dan Filosofi & Spiritualitas",
  "url": "{{ url('/blog') }}"
}
</script>
@endsection

@section('content')

{{-- 1. BREADCRUMB --}}
<x-breadcrumb
    title="Blog & Artikel"
    subtitle="Insights dari Coach Agam"
    image="{{ $__globalBreadcrumbImage }}"
    :links="['Beranda' => '/', 'Blog' => '']"
/>

{{-- 2. BLOG INDEX --}}
<section style="background:#F8F8F8; color:#1A1A1A; padding:60px 0 80px;">
        <style>
            .blog-container { padding: 0 40px; }
            .other-posts-grid { grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); }
            .featured-post-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0; }
            .featured-content { padding: 48px 40px; }
            @media (max-width: 768px) {
                .blog-container { padding: 0 16px; }
                .other-posts-grid { grid-template-columns: 1fr; }
                .featured-post-grid { grid-template-columns: 1fr; }
                .featured-content { padding: 32px 24px; }
            }
        </style>
        <div class="blog-container" style="max-width:1140px; margin:0 auto;">

        {{-- Category, Search & Sort Controls --}}
        <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:24px; margin-bottom:48px; border-bottom:1px solid #E5E7EB; padding-bottom:24px;">
            
            {{-- Category Filter --}}
            <div style="display:flex; align-items:flex-start; gap:16px; flex-wrap:wrap; flex:1; min-width:280px;">
                <a href="{{ route('blog.index') }}"
                   style="display:inline-block; font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase; padding:8px 18px; text-decoration:none; transition:all 150ms;
                          {{ !$category ? 'background:#1A1A1A; color:#fff;' : 'background:#FFFFFF; color:#6B7280; border:1px solid #E5E7EB;' }}">
                    Semua
                </a>
                @foreach($categories as $head)
                    <a href="/blog/category/{{ $head['slug'] }}"
                       style="display:inline-block; font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase; padding:8px 18px; text-decoration:none; transition:all 150ms;
                              {{ $category === $head['slug'] ? 'background:#1A1A1A; color:#fff;' : 'background:#FFFFFF; color:#6B7280; border:1px solid #E5E7EB;' }}"
                       onmouseover="if(this.style.background !== 'rgb(26, 26, 26)'){this.style.background='#F3F4F6';}"
                       onmouseout="if(this.style.background !== 'rgb(26, 26, 26)'){this.style.background='#FFFFFF';}">
                        {{ $head['name'] }}
                    </a>
                @endforeach
            </div>

            {{-- Search & Sort Form --}}
            <form action="{{ route('blog.index') }}" method="GET" style="display:flex; gap:12px; flex-wrap:wrap; align-items:center;">
                @if($category)
                    <input type="hidden" name="category" value="{{ $category }}">
                @endif
                <div style="position:relative;">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari artikel..." 
                           style="padding:10px 16px 10px 36px; border:1px solid #E5E7EB; font-size:13px; outline:none; width:100%; max-width:200px; color:#1A1A1A; transition:border 200ms;"
                           onfocus="this.style.borderColor='#1A1A1A'" onblur="this.style.borderColor='#E5E7EB'">
                    <svg style="position:absolute; left:12px; top:12px; width:16px; height:16px; color:#9CA3AF;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </div>
                <select name="sort" onchange="this.form.submit()" 
                        style="padding:10px 32px 10px 16px; border:1px solid #E5E7EB; font-size:13px; font-weight:600; outline:none; background:#fff; color:#1A1A1A; cursor:pointer; appearance:none; transition:border 200ms;"
                        onfocus="this.style.borderColor='#1A1A1A'" onblur="this.style.borderColor='#E5E7EB'">
                    <option value="terbaru" {{ (isset($sort) && $sort === 'terbaru') ? 'selected' : '' }}>Terbaru</option>
                    <option value="terlama" {{ (isset($sort) && $sort === 'terlama') ? 'selected' : '' }}>Terlama</option>
                    <option value="terpopuler" {{ (isset($sort) && $sort === 'terpopuler') ? 'selected' : '' }}>Terpopuler</option>
                </select>
                {{-- Custom arrow for select --}}
                <div style="position:relative; right:28px; width:0; height:0; pointer-events:none;">
                    <svg style="position:absolute; top:-6px; width:12px; height:12px; color:#1A1A1A;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </div>
                @if(isset($search) && $search != '')
                    <a href="{{ route('blog.index', ['category' => $category]) }}" style="font-size:12px; color:#EF4444; text-decoration:none; margin-left:-16px;">Reset</a>
                @endif
            </form>

        </div>

        @if($posts->count() > 0)

        {{-- Featured Post (First) --}}
        @php $featured = $posts->first(); @endphp
        <div style="margin-bottom:48px;">
            <a href="{{ route('blog.show', $featured->slug) }}" class="featured-post-grid" style="text-decoration:none; border:1px solid #E5E7EB; overflow:hidden; transition:all 300ms ease;"
               onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.03)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.boxShadow='none'; this.style.transform='none';">
                {{-- Image --}}
                <div style="aspect-ratio:16/9; background:#E5E7EB; overflow:hidden; position:relative;">
                    @if($featured->featured_image)
                        <img src="{{ asset('storage/'.$featured->featured_image) }}" alt="{{ $featured->title }}"
                             style="width:100%; height:100%; object-fit:cover; transition:transform 500ms;" 
                             onmouseover="this.style.transform='scale(1.04)'" onmouseout="this.style.transform='scale(1)'">
                    @else
                        <div style="width:100%; height:100%; background:linear-gradient(135deg,#1A1A1A 0%,#3A3A3A 100%); display:flex; align-items:center; justify-content:center;">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                        </div>
                    @endif
                    {{-- Category Tag on Image --}}
                    @if($featured->category)
                    <div style="position:absolute; top:16px; left:16px; background:#1A1A1A; color:#fff; font-size:10px; font-weight:700; letter-spacing:2px; text-transform:uppercase; padding:5px 12px;">
                        {{ \Illuminate\Support\Str::title(str_replace('-', ' ', $featured->category)) }}
                    </div>
                    @endif
                </div>
                {{-- Content --}}
                <div class="featured-content" style="background:#FFFFFF; display:flex; flex-direction:column; justify-content:center;">
                    <div style="font-size:10px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#9CA3AF; margin-bottom:16px;">
                        Artikel Unggulan &nbsp;—&nbsp; {{ $featured->read_time_text }}
                    </div>
                    <h2 style="font-size:clamp(20px,2vw,30px); font-weight:800; color:#0D0D0D; line-height:1.25; letter-spacing:-0.5px; margin-bottom:16px;">{{ $featured->title }}</h2>
                    <p style="font-size:14px; line-height:1.75; color:#4B5563; margin-bottom:24px;">
                        {{ $featured->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($featured->body), 160) }}
                    </p>
                    <div style="display:flex; align-items:center; gap:12px;">
                        <div style="width:32px; height:32px; background:#1A1A1A; border-radius:50%; display:flex; align-items:center; justify-content:center;">
                            <span style="font-size:12px; font-weight:700; color:#fff;">{{ strtoupper(substr($featured->author_name, 0, 1)) }}</span>
                        </div>
                        <div>
                            <div style="font-size:12px; font-weight:700; color:#1A1A1A;">{{ $featured->author_name }}</div>
                            <div style="font-size:11px; color:#9CA3AF;">{{ $featured->published_at ? $featured->published_at->translatedFormat('d F Y') : '' }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Other Posts Grid --}}
        @if($posts->count() > 1)
        <div class="other-posts-grid" style="display:grid; gap:1px; background:#E5E7EB; border:1px solid #E5E7EB;">
            @foreach($posts->skip(1) as $post)
                <x-blog-card :post="$post" />
            @endforeach
        </div>
        @endif

        {{-- Pagination --}}
        @if($posts->hasPages())
        <div style="margin-top:48px; display:flex; justify-content:center; gap:8px;">
            {{ $posts->appends(['category' => $category ?? null, 'search' => $search ?? null, 'sort' => $sort ?? null])->links() }}
        </div>
        @endif

        @else
        {{-- Empty State --}}
        <div style="text-align:center; padding:80px 0;">
            <div style="font-size:40px; margin-bottom:16px;">📄</div>
            <div style="font-size:16px; color:#6B7280;">Belum ada artikel untuk kategori ini.</div>
            <a href="{{ route('blog.index') }}" style="display:inline-block; margin-top:20px; font-size:13px; font-weight:600; color:#1A1A1A; text-decoration:underline;">Lihat semua artikel</a>
        </div>
        @endif

    </div>
</section>

<x-cta-kerjasama />

@endsection
