@extends('admin.layouts.admin')

@section('title', 'Semua Artikel Blog')

@section('content')
<div style="max-width: 1000px; margin: 0 auto; padding: 40px 32px;">
    {{-- Header --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 36px; height: 36px; background: rgba(0,0,0,0.05); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
            </div>
            <div>
                <h1 style="font-size: 20px; font-weight: 700; color: #111; margin: 0; letter-spacing: -0.3px;">Artikel Blog</h1>
                <p style="font-size: 13px; color: #666; margin: 0;">Kelola semua artikel blog Anda.</p>
            </div>
        </div>
        <a href="{{ route('admin.blog.posts.create') }}" style="background: #fff; color: #111; text-decoration: none; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 8px; transition: transform 150ms;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='translateY(0)'">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tulis Artikel
        </a>
    </div>

    @if(session('success'))
        <div style="background: rgba(52,211,153,0.1); border: 1px solid rgba(52,211,153,0.3); color: #6EE7B7; padding: 14px 18px; border-radius: 10px; font-size: 13px; font-weight: 600; margin-bottom: 24px;">{{ session('success') }}</div>
    @endif

    {{-- Filter & Search Form --}}
    <form action="{{ route('admin.blog.posts.index') }}" method="GET" style="display: flex; gap: 12px; margin-bottom: 24px; flex-wrap: wrap; align-items: center;">
        <div style="flex: 1; min-width: 250px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan judul, slug, atau kategori..." style="width: 100%; background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 13px; outline: none; transition: border-color 150ms;" onfocus="this.style.borderColor='rgba(255,255,255,0.3)'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
        </div>
            <select name="category" style="background: #161616; border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 13px; outline: none; cursor: pointer; transition: border-color 150ms;" onfocus="this.style.borderColor='rgba(255,255,255,0.3)'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                <option value="" style="color: #fff; background: #222;">Semua Kategori</option>
                @foreach($categories as $head)
                    <optgroup label="{{ $head['name'] }}" style="color: #888; font-weight: 700;">
                        <option value="{{ $head['slug'] }}" style="color: #fff; background: #222;" {{ request('category') == $head['slug'] ? 'selected' : '' }}>- Semua di {{ $head['name'] }} -</option>
                        @foreach($head['subs'] as $sub)
                            <option value="{{ $sub['slug'] }}" style="color: #fff; background: #222;" {{ request('category') == $sub['slug'] ? 'selected' : '' }}>{{ $sub['name'] }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        <div>
            <button type="submit" style="background: #333; border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: background 150ms;" onmouseover="this.style.background='#444'" onmouseout="this.style.background='#333'">
                Cari & Filter
            </button>
        </div>
        @if(request()->has('search') || request()->has('category'))
        <div>
            <a href="{{ route('admin.blog.posts.index') }}" style="color: #aaa; text-decoration: none; font-size: 13px; padding: 10px 14px; transition: color 150ms;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#aaa'">
                Reset Filter
            </a>
        </div>
        @endif
    </form>

    <div style="background: #161616; border: 1px solid rgba(255,255,255,0.07); border-radius: 12px; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); background: #1A1A1A;">
                    <th style="padding: 14px 20px; font-size: 11px; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 1px;">Judul & Kategori</th>
                    <th style="padding: 14px 20px; font-size: 11px; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 1px;">Status</th>
                    <th style="padding: 14px 20px; font-size: 11px; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 1px;">Tanggal</th>
                    <th style="padding: 14px 20px; font-size: 11px; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 1px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); transition: background 150ms;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 16px 20px;">
                        <div style="font-size: 14px; font-weight: 600; color: #E5E5E5; margin-bottom: 4px;">{{ $post->title }}</div>
                        <div style="font-size: 12px; color: #666;">
                            {{ \Illuminate\Support\Str::title(str_replace('-', ' ', $post->category)) ?? 'Tanpa Kategori' }}
                            <span style="margin:0 6px;">&bull;</span> {{ $post->views }} Views
                        </div>
                    </td>
                    <td style="padding: 16px 20px;">
                        @if($post->status == 'published')
                            <span style="background: rgba(52,211,153,0.1); color: #6EE7B7; border: 1px solid rgba(52,211,153,0.2); padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Published</span>
                        @elseif($post->status == 'draft')
                            <span style="background: rgba(255,255,255,0.05); color: #aaa; border: 1px solid rgba(255,255,255,0.1); padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Draft</span>
                        @else
                            <span style="background: rgba(245,158,11,0.1); color: #FCD34D; border: 1px solid rgba(245,158,11,0.2); padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Archived</span>
                        @endif
                    </td>
                    <td style="padding: 16px 20px; font-size: 12px; color: #888;">
                        {{ $post->published_at ? $post->published_at->format('d M Y') : '-' }}
                    </td>
                    <td style="padding: 16px 20px; text-align: right; display: flex; justify-content: flex-end; gap: 8px;">
                        <a href="{{ route('blog.show', $post->slug) }}" target="_blank" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 6px 12px; border-radius: 6px; font-size: 12px; text-decoration: none;">Lihat</a>
                        <a href="{{ route('admin.blog.posts.edit', $post->id) }}" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 6px 12px; border-radius: 6px; font-size: 12px; text-decoration: none;">Edit</a>
                        <form action="{{ route('admin.blog.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')">
                            @csrf @method('DELETE')
                            <button style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #ef4444; padding: 6px 12px; border-radius: 6px; font-size: 12px; cursor: pointer;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="padding: 32px; text-align: center; color: #666; font-size: 13px;">Belum ada artikel yang ditulis.</td></tr>
                @endforelse
            </tbody>
        </table>
        
        @if($posts->hasPages())
        <div style="padding: 16px 20px; border-top: 1px solid rgba(255,255,255,0.05);">
            {{ $posts->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
