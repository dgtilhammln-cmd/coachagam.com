@extends('admin.layouts.admin')

@section('title', 'Kategori Blog')

@section('content')
<div style="max-width: 960px; margin: 0 auto; padding: 40px 32px;">
    {{-- Header --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 36px; height: 36px; background: rgba(255,255,255,0.07); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#aaa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line>
                </svg>
            </div>
            <div>
                <h1 style="font-size: 20px; font-weight: 700; color: #F5F5F5; margin: 0; letter-spacing: -0.3px;">Kategori Blog</h1>
                <p style="font-size: 13px; color: #555; margin: 0;">Kelola kategori untuk artikel blog.</p>
            </div>
        </div>
        <button onclick="document.getElementById('modal-add').style.display='flex'" style="background: #fff; color: #111; border: none; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Kategori
        </button>
    </div>

    @if(session('success'))
        <div style="background: rgba(52,211,153,0.1); border: 1px solid rgba(52,211,153,0.3); color: #6EE7B7; padding: 14px 18px; border-radius: 10px; font-size: 13px; font-weight: 600; margin-bottom: 24px;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #F87171; padding: 14px 18px; border-radius: 10px; font-size: 13px; font-weight: 600; margin-bottom: 24px;">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #F87171; padding: 14px 18px; border-radius: 10px; font-size: 13px; font-weight: 600; margin-bottom: 24px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div style="background: #161616; border: 1px solid rgba(255,255,255,0.07); border-radius: 12px; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); background: #1A1A1A;">
                    <th style="padding: 14px 20px; font-size: 11px; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 1px;">Nama Kategori</th>
                    <th style="padding: 14px 20px; font-size: 11px; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 1px;">Slug</th>
                    <th style="padding: 14px 20px; font-size: 11px; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 1px; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <td style="padding: 16px 20px; font-size: 13px; font-weight: 600; color: #E5E5E5;">{{ $cat['name'] }}</td>
                    <td style="padding: 16px 20px; font-size: 12px; color: #888;">{{ $cat['slug'] }}</td>
                    <td style="padding: 16px 20px; text-align: right; display: flex; justify-content: flex-end; gap: 8px;">
                        <button onclick="editCat('{{ $cat['id'] }}', '{{ addslashes($cat['name']) }}')" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 6px 12px; border-radius: 6px; font-size: 12px; cursor: pointer;">Edit</button>
                        <form action="{{ route('admin.blog.categories.destroy', $cat['id']) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #ef4444; padding: 6px 12px; border-radius: 6px; font-size: 12px; cursor: pointer;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" style="padding: 24px; text-align: center; color: #666; font-size: 13px;">Belum ada kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Add --}}
<div id="modal-add" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 999; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div style="background: #1A1A1A; width: 400px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1); padding: 24px;">
        <h3 style="font-size: 16px; font-weight: 700; color: #fff; margin: 0 0 20px;">Tambah Kategori</h3>
        <form action="{{ route('admin.blog.categories.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 12px; color: #888; margin-bottom: 8px;">Nama Kategori</label>
                <input type="text" name="name" required style="width: 100%; box-sizing: border-box; background: #111; border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 14px; outline: none;">
            </div>
            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" onclick="document.getElementById('modal-add').style.display='none'" style="padding: 10px 16px; background: transparent; border: 1px solid rgba(255,255,255,0.1); color: #aaa; border-radius: 8px; cursor: pointer;">Batal</button>
                <button type="submit" style="padding: 10px 16px; background: #fff; border: none; color: #111; font-weight: 600; border-radius: 8px; cursor: pointer;">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit --}}
<div id="modal-edit" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 999; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div style="background: #1A1A1A; width: 400px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1); padding: 24px;">
        <h3 style="font-size: 16px; font-weight: 700; color: #fff; margin: 0 0 20px;">Edit Kategori</h3>
        <form id="form-edit" method="POST">
            @csrf @method('PUT')
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 12px; color: #888; margin-bottom: 8px;">Nama Kategori</label>
                <input type="text" name="name" id="edit-name" required style="width: 100%; box-sizing: border-box; background: #111; border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 10px 14px; border-radius: 8px; font-size: 14px; outline: none;">
            </div>
            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" onclick="document.getElementById('modal-edit').style.display='none'" style="padding: 10px 16px; background: transparent; border: 1px solid rgba(255,255,255,0.1); color: #aaa; border-radius: 8px; cursor: pointer;">Batal</button>
                <button type="submit" style="padding: 10px 16px; background: #fff; border: none; color: #111; font-weight: 600; border-radius: 8px; cursor: pointer;">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
function editCat(id, name) {
    document.getElementById('edit-name').value = name;
    document.getElementById('form-edit').action = '/admin/blog/categories/' + id;
    document.getElementById('modal-edit').style.display = 'flex';
}
</script>
@endsection
