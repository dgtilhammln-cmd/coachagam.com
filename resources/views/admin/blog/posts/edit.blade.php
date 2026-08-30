@extends('admin.layouts.admin')

@section('title', 'Edit Artikel Blog')

@push('head')
<!-- Quill.js Rich Text Editor -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<style>
    .form-group { margin-bottom: 24px; }
    .form-label { display: block; font-size: 12px; font-weight: 700; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
    .form-input { width: 100%; box-sizing: border-box; background: #111; border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 12px 16px; border-radius: 8px; font-size: 14px; outline: none; transition: border-color 200ms; }
    .form-input:focus { border-color: rgba(255,255,255,0.3); }
    .form-select { width: 100%; box-sizing: border-box; background: #111; border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 12px 16px; border-radius: 8px; font-size: 14px; outline: none; appearance: none; }
    /* Quill light theme overrides */
    .ql-toolbar.ql-snow { background: #fff; border: 1px solid rgba(255,255,255,0.15) !important; border-bottom: none !important; border-radius: 8px 8px 0 0; padding: 12px; }
    .ql-container.ql-snow { background: #fff; border: 1px solid rgba(255,255,255,0.15) !important; border-radius: 0 0 8px 8px; min-height: 480px; font-size: 15px; }
    .ql-editor { color: #111; min-height: 480px; line-height: 1.8; }
    .ql-editor.ql-blank::before { color: #888; font-style: normal; }
    .ql-snow .ql-stroke { stroke: #666 !important; }
    .ql-snow .ql-fill { fill: #666 !important; }
    .ql-snow .ql-picker { color: #444 !important; }
    .ql-snow .ql-picker-options { background: #fff; border-color: #ddd; color: #111; }
    .ql-snow .ql-picker-item { color: #444; }
    .ql-snow .ql-picker-item:hover { color: #000; }
    .ql-snow .ql-active .ql-stroke { stroke: #000 !important; }
    .ql-snow .ql-active .ql-fill { fill: #000 !important; }
    .ql-snow button:hover .ql-stroke { stroke: #000 !important; }
    .ql-snow button:hover .ql-fill { fill: #000 !important; }
    #html-modal { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.8); z-index:9999; align-items:center; justify-content:center; }
    #html-modal.open { display:flex; }
    #html-modal-inner { background:#1A1A1A; border:1px solid rgba(255,255,255,0.15); border-radius:12px; width:80%; max-width:900px; padding:24px; }
    #html-source-editor { width:100%; box-sizing:border-box; background:#111; border:1px solid rgba(255,255,255,0.1); color:#6EE7B7; font-family:monospace; font-size:13px; padding:16px; border-radius:8px; min-height:300px; outline:none; resize:vertical; }
</style>
@endpush

@section('content')
<div style="max-width: 1000px; margin: 0 auto; padding: 40px 32px;">
    {{-- Header --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <a href="{{ route('admin.blog.posts.index') }}" style="width: 36px; height: 36px; background: rgba(255,255,255,0.05); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #aaa; text-decoration: none; transition: background 150ms;" onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </a>
            <div>
                <h1 style="font-size: 20px; font-weight: 700; color: #111; margin: 0; letter-spacing: -0.3px;">Edit Artikel</h1>
                <p style="font-size: 13px; color: #555; margin: 0;">{{ $post->title }}</p>
            </div>
        </div>
        <a href="{{ route('blog.show', $post->slug) }}" target="_blank" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff; text-decoration: none; padding: 8px 16px; border-radius: 8px; font-size: 12px; display: flex; align-items: center; gap: 8px;">
            Lihat Artikel
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="square"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
        </a>
    </div>

    @if($errors->any())
        <div style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #F87171; padding: 14px 18px; border-radius: 10px; font-size: 13px; font-weight: 600; margin-bottom: 24px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.blog.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 32px;">
            
            {{-- MAIN COLUMN --}}
            <div>
                <div style="background: #161616; border: 1px solid rgba(255,255,255,0.07); border-radius: 12px; padding: 32px; margin-bottom: 24px;">
                    <div class="form-group">
                        <label class="form-label">Judul Artikel *</label>
                        <input type="text" name="title" value="{{ old('title', $post->title) }}" required class="form-input" style="font-size: 18px; font-weight: 600;">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Slug (Opsional)</label>
                        <input type="text" name="slug" value="{{ old('slug', $post->slug) }}" class="form-input" placeholder="taktik-pressing-modern (Biarkan kosong untuk auto-generate)">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="quill-editor">Isi Artikel *</label>
                        <div style="display:flex; gap:8px; margin-bottom:8px;">
                            <button type="button" onclick="document.getElementById('html-modal').classList.add('open')" style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); color:#aaa; padding:6px 12px; border-radius:6px; font-size:12px; cursor:pointer; display:flex; align-items:center; gap:6px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                                HTML Source
                            </button>
                        </div>
                        <div id="quill-editor"></div>
                        <textarea name="body" id="body-hidden" style="display:none;">{{ old('body', $post->body) }}</textarea>
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Excerpt / Kutipan Pendek</label>
                        <textarea name="excerpt" class="form-input" rows="3">{{ old('excerpt', $post->excerpt) }}</textarea>
                        <p style="font-size: 11px; color: #666; margin: 6px 0 0;">Muncul di halaman indeks blog. Jika kosong, akan diambil dari isi artikel.</p>
                    </div>
                </div>

                {{-- SEO SECTION --}}
                <div style="background: #161616; border: 1px solid rgba(255,255,255,0.07); border-radius: 12px; padding: 32px;">
                    <h3 style="font-size: 15px; font-weight: 700; color: #fff; margin: 0 0 20px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 12px;">Pengaturan SEO</h3>
                    
                    <div class="form-group">
                        <label class="form-label">Meta Title (Opsional)</label>
                        <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}" class="form-input" placeholder="Title untuk SEO, maks 60 karakter">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Meta Description (Opsional)</label>
                        <textarea id="meta_description" name="meta_description" class="form-input" rows="4" placeholder="Deskripsi untuk SEO, maks 160 karakter">{{ old('meta_description', $post->meta_description) }}</textarea>
                    </div>

                    {{-- SEO Meta Fallback Logic --}}
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const titleInput = document.querySelector('input[name="title"]');
                            const excerptInput = document.querySelector('textarea[name="excerpt"]');
                            const metaTitleInput = document.getElementById('meta_title');
                            const metaDescInput = document.getElementById('meta_description');

                            function updateSeoFallbacks() {
                                if (metaTitleInput.value.trim() === '') {
                                    metaTitleInput.placeholder = titleInput.value ? titleInput.value.substring(0, 60) : 'Title untuk SEO, maks 60 karakter';
                                }
                                if (metaDescInput.value.trim() === '') {
                                    metaDescInput.placeholder = excerptInput.value ? excerptInput.value.substring(0, 160) : 'Deskripsi untuk SEO, maks 160 karakter';
                                }
                            }

                            titleInput.addEventListener('input', updateSeoFallbacks);
                            excerptInput.addEventListener('input', updateSeoFallbacks);
                            
                            // Initialize on load
                            updateSeoFallbacks();
                        });
                    </script>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $post->meta_keywords) }}" class="form-input" placeholder="Misal: sepakbola, latihan, coach agam">
                    </div>
                </div>

                {{-- FAQ SECTION --}}
                <div style="background: #161616; border: 1px solid rgba(255,255,255,0.07); border-radius: 12px; padding: 32px; margin-top: 24px;" id="faq-builder">
                    <h3 style="font-size: 15px; font-weight: 700; color: #fff; margin: 0 0 20px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 12px;">FAQ Artikel</h3>
                    <p style="font-size: 12px; color: #888; margin-bottom: 16px;">Tambahkan pertanyaan yang sering diajukan terkait artikel ini. Akan muncul di bawah artikel.</p>
                    
                    <div id="faq-list">
                        {{-- Items will be injected here via JS --}}
                    </div>
                    
                    <button type="button" onclick="addFaqItem()" style="background: rgba(255,255,255,0.05); border: 1px dashed rgba(255,255,255,0.2); color: #ccc; width: 100%; padding: 12px; border-radius: 8px; cursor: pointer; font-size: 13px; font-weight: 600;">
                        + Tambah FAQ
                    </button>
                </div>
            </div>

            {{-- SIDEBAR COLUMN --}}
            <div>
                <div style="background: #161616; border: 1px solid rgba(255,255,255,0.07); border-radius: 12px; padding: 24px; position: sticky; top: 24px;">
                    
                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $post->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>

                    @php
                        $selectedHead = '';
                        $selectedSub = old('category', $post->category);
                        foreach($categories as $head) {
                            foreach($head['subs'] as $sub) {
                                if($sub['slug'] == $selectedSub) {
                                    $selectedHead = $head['id'];
                                    break 2;
                                }
                            }
                        }
                    @endphp

                    <div class="form-group">
                        <label class="form-label">Head Kategori</label>
                        <select id="head_category" class="form-select" onchange="updateSubCategory()">
                            <option value="">-- Pilih Head Kategori --</option>
                            @foreach($categories as $head)
                                <option value="{{ $head['id'] }}" {{ $selectedHead == $head['id'] ? 'selected' : '' }}>{{ $head['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Sub Kategori (Pilih Head Kategori Terlebih Dahulu)</label>
                        <select id="sub_category" name="category" class="form-select" required>
                            <option value="">-- Pilih Sub Kategori --</option>
                        </select>
                    </div>

                    <script>
                        const catData = @json($categories);
                        
                        function updateSubCategory(isInit = false) {
                            const headId = document.getElementById('head_category').value;
                            const subSelect = document.getElementById('sub_category');
                            const initialSub = '{{ $selectedSub }}';
                            
                            subSelect.innerHTML = '<option value="">-- Pilih Sub Kategori --</option>';
                            
                            if(headId) {
                                const head = catData.find(c => c.id === headId);
                                if(head && head.subs) {
                                    head.subs.forEach(sub => {
                                        const isSelected = (isInit && sub.slug === initialSub) ? 'selected' : '';
                                        subSelect.innerHTML += `<option value="${sub.slug}" ${isSelected}>${sub.name}</option>`;
                                    });
                                }
                            }
                        }
                        
                        // Auto trigger on page load to restore selected sub-category
                        window.addEventListener('DOMContentLoaded', () => {
                            updateSubCategory(true);
                        });
                    </script>

                    <div class="form-group">
                        <label class="form-label">Featured Image</label>
                        @if($post->featured_image)
                            <div style="margin-bottom: 12px; border-radius: 8px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1);">
                                <img src="{{ asset('storage/' . $post->featured_image) }}" style="width: 100%; display: block; object-fit: cover;">
                            </div>
                        @endif
                        <div style="border: 2px dashed rgba(255,255,255,0.1); border-radius: 8px; padding: 16px; text-align: center; position: relative;">
                            <input type="file" name="featured_image" accept="image/*" style="position: absolute; inset: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                            <div style="font-size: 13px; color: #888;">Ganti Gambar...</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Author Name</label>
                        <input type="text" name="author_name" value="{{ old('author_name', $post->author_name) }}" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Read Time (Estimasi)</label>
                        <input type="text" name="read_time" value="{{ old('read_time', str_replace(' min baca', '', $post->read_time)) }}" class="form-input">
                        <p style="font-size: 11px; color: #666; margin: 4px 0 0;">Angka saja (otomatis "+ min baca"). Kosongkan untuk auto-hitung.</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tanggal Publish</label>
                        <input type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}" class="form-input">
                    </div>

                    <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.1); margin: 24px 0;">

                    <button type="submit" style="width: 100%; padding: 14px; background: #fff; color: #111; font-weight: 700; font-size: 14px; border: none; border-radius: 8px; cursor: pointer; transition: transform 150ms;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                        Update Artikel
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- HTML Source Modal --}}
<div id="html-modal">
    <div id="html-modal-inner">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
            <h3 style="color:#fff; font-size:16px; font-weight:700; margin:0;">HTML Source Editor</h3>
        </div>
        <textarea id="html-source-editor" placeholder="Edit HTML di sini..."></textarea>
        <div style="display:flex; gap:12px; justify-content:flex-end; margin-top:16px;">
            <button onclick="document.getElementById('html-modal').classList.remove('open')" style="background:transparent; border:1px solid rgba(255,255,255,0.2); color:#aaa; padding:8px 16px; border-radius:6px; cursor:pointer;">Batal</button>
            <button onclick="applyHtmlSource()" style="background:#fff; color:#111; border:none; padding:8px 16px; border-radius:6px; font-weight:600; cursor:pointer;">Simpan & Tutup</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var quill = new Quill('#quill-editor', {
        theme: 'snow',
        placeholder: 'Tulis isi artikel di sini...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'align': [] }],
                ['link', 'image', 'blockquote', 'code-block'],
                ['clean']
            ]
        }
    });

    var existingContent = document.getElementById('body-hidden').value;
    if (existingContent) {
        quill.clipboard.dangerouslyPasteHTML(existingContent);
    }

    var form = document.querySelector('form');
    form.addEventListener('submit', function() {
        document.getElementById('body-hidden').value = quill.getSemanticHTML();
    });

    window.applyHtmlSource = function() {
        var html = document.getElementById('html-source-editor').value;
        quill.clipboard.dangerouslyPasteHTML(html);
        document.getElementById('html-modal').classList.remove('open');
    };

    var faqData = {!! json_encode(old('faq', $post->faq ?: [])) !!};
    var faqList = document.getElementById('faq-list');

    window.addFaqItem = function(q = '', a = '') {
        var index = faqList.children.length;
        var html = `
            <div class="faq-item" style="background: #111; border: 1px solid rgba(255,255,255,0.1); padding: 16px; border-radius: 8px; margin-bottom: 12px; position: relative;">
                <button type="button" onclick="this.parentElement.remove()" style="position: absolute; top: 12px; right: 12px; background: transparent; border: none; color: #ef4444; cursor: pointer;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
                </button>
                <div class="form-group" style="margin-bottom: 12px;">
                    <label class="form-label">Pertanyaan</label>
                    <input type="text" name="faq[${index}][q]" value="${q}" class="form-input" placeholder="Tulis pertanyaan..." required>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Jawaban</label>
                    <textarea name="faq[${index}][a]" class="form-input" rows="2" placeholder="Tulis jawaban..." required>${a}</textarea>
                </div>
            </div>
        `;
        faqList.insertAdjacentHTML('beforeend', html);
    };

    if (faqData && faqData.length > 0) {
        faqData.forEach(item => addFaqItem(item.q, item.a));
    }

    document.getElementById('html-modal').addEventListener('click', function(e) {
        if (e.target === this) this.classList.remove('open');
    });

    window._quill = quill;
});
</script>
@endsection
