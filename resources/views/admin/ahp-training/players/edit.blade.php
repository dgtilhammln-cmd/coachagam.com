@extends('admin.layouts.admin')
@section('title', 'Edit Pemain — ' . $player->name)

@section('breadcrumb')
    <span class="breadcrumb-sep">/</span>
    <a href="{{ route('admin.ahp.players.index') }}" style="color:#9E9E9E;text-decoration:none;font-size:12px;">Pemain</a>
    <span class="breadcrumb-sep">/</span>
    <span class="breadcrumb-current">Edit {{ $player->no_reg }}</span>
@endsection

@section('content')
<div style="margin-bottom:24px;">
    <h1 class="page-title">Edit: {{ $player->name }}</h1>
</div>

<form action="{{ route('admin.ahp.players.update', $player) }}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')
<div style="display:grid;grid-template-columns:220px 1fr;gap:20px;align-items:start;">

    {{-- Left Column: Photos --}}
    <div style="display:flex;flex-direction:column;gap:16px;">
        <div class="admin-card" style="border-radius:0;">
            <div class="admin-card-header"><h2>Foto Pemain</h2></div>
            <div class="admin-card-body" style="text-align:center;">
                <div id="photo-preview" style="width:120px;height:140px;margin:0 auto 16px;border:1px solid #E0E0E0;display:flex;align-items:center;justify-content:center;overflow:hidden;background:#F9F9F9;">
                    <img src="{{ $player->photo_url }}" style="width:100%;height:100%;object-fit:cover;">
                </div>
                <label for="photo" class="btn-outline" style="font-size:12px;cursor:pointer;display:inline-block;">Ganti Foto</label>
                <input type="file" id="photo" name="photo" accept="image/*" style="display:none;"
                       onchange="const f=this.files[0];if(f){const r=new FileReader();r.onload=e=>{const p=document.getElementById('photo-preview');p.innerHTML='<img src=\''+e.target.result+'\' style=\'width:100%;height:100%;object-fit:cover;\'>'};r.readAsDataURL(f)}">
                <p style="font-size:10px;color:#9E9E9E;margin-top:8px;">JPG/PNG, maks. 2MB</p>
                @error('photo')<p style="color:#EF4444;font-size:11px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="admin-card" style="border-radius:0;">
            <div class="admin-card-header"><h2>OG Image</h2></div>
            <div class="admin-card-body" style="text-align:center;">
                <div id="og-preview" style="width:100%;height:80px;margin:0 auto 12px;border:1px solid #E0E0E0;display:flex;align-items:center;justify-content:center;overflow:hidden;background:#F9F9F9;">
                    @if($player->og_image_url)
                        <img src="{{ $player->og_image_url }}" style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#BDBDBD" stroke-width="1.5"><rect x="3" y="3" width="18" height="18"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    @endif
                </div>
                <label for="og_image" class="btn-outline" style="font-size:12px;cursor:pointer;display:inline-block;">Ganti OG</label>
                <input type="file" id="og_image" name="og_image" accept="image/*" style="display:none;"
                       onchange="const f=this.files[0];if(f){const r=new FileReader();r.onload=e=>{const p=document.getElementById('og-preview');p.innerHTML='<img src=\''+e.target.result+'\' style=\'width:100%;height:100%;object-fit:cover;\'>'};r.readAsDataURL(f)}">
                <p style="font-size:10px;color:#9E9E9E;margin-top:6px;">1200x630px</p>
                @error('og_image')<p style="color:#EF4444;font-size:11px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    <div class="admin-card" style="border-radius:0;">
        <div class="admin-card-header"><h2>Data Pemain</h2></div>
        <div class="admin-card-body" style="display:flex;flex-direction:column;gap:18px;">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="no_reg">NO REG <span style="color:#EF4444;">*</span></label>
                    <input type="text" id="no_reg" name="no_reg" class="form-input" value="{{ old('no_reg', $player->no_reg) }}" required style="font-family:monospace;">
                    @error('no_reg')<p style="color:#EF4444;font-size:11px;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="position">Posisi</label>
                    <select id="position" name="position" class="form-input">
                        <option value="">— Pilih Posisi —</option>
                        @foreach(['Goalkeeper','Defender','Midfielder','Forward'] as $pos)
                        <option value="{{ $pos }}" {{ old('position', $player->position) == $pos ? 'selected' : '' }}>{{ $pos }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group" style="margin:0;">
                <label class="form-label" for="name">Nama Lengkap <span style="color:#EF4444;">*</span></label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $player->name) }}" required style="text-transform:uppercase;">
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="date_of_birth">Tanggal Lahir</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-input" value="{{ old('date_of_birth', $player->date_of_birth?->format('Y-m-d')) }}">
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label">Status</label>
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;padding:9px 12px;border:1px solid #E0E0E0;font-size:12px;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $player->is_active) ? 'checked' : '' }}>
                        Pemain Aktif
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="display:flex;gap:10px;margin-top:20px;">
    <button type="submit" class="btn-silver">Simpan Perubahan</button>
    <a href="{{ route('admin.ahp.players.index') }}" class="btn-outline">Batal</a>
</div>
</form>
@endsection
