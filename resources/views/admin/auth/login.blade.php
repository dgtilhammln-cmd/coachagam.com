<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Login — Coach Agam</title>
    @php
        $__logo    = \App\Models\SiteSetting::where('key','general.logo')->value('value');
        $__favicon = \App\Models\SiteSetting::where('key','general.favicon')->value('value');
    @endphp
    @if($__favicon)
    <link rel="icon" href="{{ asset('storage/'.$__favicon) }}">
    @else
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect x='15' y='15' width='70' height='70' fill='%231A1A1A'/><rect x='35' y='35' width='30' height='30' fill='%23FFFFFF'/></svg>">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            min-height: 100vh;
            background: #FFFFFF;
            color: #1A1A1A;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            align-items: stretch;
        }

        /* ── Left panel (decoration) ── */
        .login-left {
            width: 45%;
            background: #0D0D0D;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
            flex-shrink: 0;
        }
        @media(max-width: 900px) { .login-left { display: none; } }

        .login-left::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }

        /* ── Right panel (form) ── */
        .login-right {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            background: #FFFFFF;
        }

        .login-form-wrap {
            width: 100%;
            max-width: 400px;
        }

        /* ── Form inputs ── */
        .form-input {
            width: 100%;
            background: #FFFFFF;
            border: 1px solid #D1D5DB;
            border-radius: 0;
            color: #1A1A1A;
            font-size: 14px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 400;
            padding: 12px 16px;
            outline: none;
            transition: border-color 150ms, box-shadow 150ms;
        }
        .form-input:focus {
            border-color: #1A1A1A;
            box-shadow: 0 0 0 2px rgba(26,26,26,0.08);
        }
        .form-input::placeholder { color: #9CA3AF; }

        .form-input-icon {
            position: relative;
        }
        .form-input-icon input { padding-left: 44px; }
        .form-input-icon .icon {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            pointer-events: none;
        }
        .form-input-icon .icon-right {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            cursor: pointer; color: #9CA3AF;
            padding: 0; display: flex; transition: color 150ms;
        }
        .form-input-icon .icon-right:hover { color: #1A1A1A; }

        .btn-login {
            width: 100%;
            background: #1A1A1A;
            color: #FFFFFF;
            font-size: 13px;
            font-weight: 700;
            font-family: 'Montserrat', sans-serif;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 14px;
            border: none;
            border-radius: 0;
            cursor: pointer;
            transition: all 150ms;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-login:hover { background: #333333; }
        .btn-login:active { transform: scale(0.99); }

        .error-alert {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            border-left: 3px solid #EF4444;
            color: #991B1B;
            font-size: 13px;
            font-weight: 400;
            padding: 12px 16px;
            margin-bottom: 24px;
            display: flex; align-items: flex-start; gap: 10px;
        }
        .success-alert {
            background: #F0FDF4;
            border: 1px solid #BBF7D0;
            border-left: 3px solid #22C55E;
            color: #15803D;
            font-size: 13px;
            padding: 12px 16px;
            margin-bottom: 24px;
            display: flex; align-items: center; gap: 10px;
        }

        label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #374151;
            margin-bottom: 8px;
        }

        .divider-line {
            border: none;
            border-top: 1px solid #E5E7EB;
            margin: 28px 0;
        }
    </style>
</head>
<body>

    {{-- LEFT PANEL --}}
    <div class="login-left">
        {{-- Top: Brand --}}
        <div style="position:relative;z-index:1;">
            <a href="{{ route('home') }}" style="display:inline-flex; align-items:center; gap:12px; text-decoration:none;">
                @if($__logo)
                    <img src="{{ asset('storage/'.$__logo) }}" alt="Logo" style="max-height:40px; object-fit:contain; filter:brightness(10);">
                @else
                    <div style="width:36px;height:36px;background:rgba(255,255,255,0.12);display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.2);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="square"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                @endif
            </a>
        </div>

        {{-- Center: Text --}}
        <div style="position:relative;z-index:1;">
            <p style="font-size:10px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:#4B5563;margin-bottom:16px;">Admin Panel</p>
            <h2 style="font-size:2.5rem;font-weight:300;color:#FFFFFF;line-height:1.2;margin-bottom:20px;">
                Kelola Website<br><strong style="font-weight:800;">Coach Agam</strong>
            </h2>
            <p style="font-size:14px;font-weight:300;color:#6B7280;line-height:1.6;">
                Atur tampilan, konten, dan pengaturan website Anda dari satu dashboard terpusat.
            </p>
        </div>

        {{-- Bottom: Version --}}
        <div style="position:relative;z-index:1;">
            <p style="font-size:11px;color:#374151;letter-spacing:1px;">COACH AGAM © {{ date('Y') }}</p>
        </div>
    </div>

    {{-- RIGHT PANEL --}}
    <div class="login-right">
        <div class="login-form-wrap">

            {{-- Header --}}
            <div style="margin-bottom:40px;">
                <p style="font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#9CA3AF;margin-bottom:12px;">ADMINISTRATOR</p>
                <h1 style="font-size:2rem;font-weight:300;color:#1A1A1A;line-height:1.2;">
                    Selamat<br><strong style="font-weight:800;">Datang Kembali</strong>
                </h1>
            </div>

            {{-- Flash --}}
            @if(session('success'))
            <div class="success-alert" role="alert">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" flex-shrink="0"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
            @endif
            @if($errors->any())
            <div class="error-alert" role="alert">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
            </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('admin.login.post') }}" method="POST" novalidate>
                @csrf

                {{-- Email --}}
                <div style="margin-bottom:20px;">
                    <label for="email">Email</label>
                    <div class="form-input-icon">
                        <span class="icon" aria-hidden="true">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </span>
                        <input type="email" id="email" name="email" class="form-input"
                               placeholder="admin@coachagam.com"
                               value="{{ old('email') }}" autocomplete="email" required>
                    </div>
                </div>

                {{-- Password --}}
                <div style="margin-bottom:28px;" x-data="{ showPass: false }">
                    <label for="password">Password</label>
                    <div class="form-input-icon">
                        <span class="icon" aria-hidden="true">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="0" ry="0"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </span>
                        <input :type="showPass ? 'text' : 'password'" id="password" name="password" class="form-input"
                               style="padding-right:44px;"
                               placeholder="••••••••" autocomplete="current-password" required>
                        <button type="button" class="icon-right" @click="showPass = !showPass" :aria-label="showPass ? 'Sembunyikan' : 'Tampilkan'">
                            <svg x-show="!showPass" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="showPass"  width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                        </button>
                    </div>
                </div>

                {{-- Remember + Forgot --}}
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;text-transform:none;font-size:13px;font-weight:400;letter-spacing:0;color:#4B5563;">
                        <input type="checkbox" name="remember" id="remember"
                               style="width:15px;height:15px;accent-color:#1A1A1A;cursor:pointer;border-radius:0;">
                        Ingat saya
                    </label>
                    <a href="#" style="font-size:12px;color:#9CA3AF;text-decoration:none;" onmouseover="this.style.color='#1A1A1A'" onmouseout="this.style.color='#9CA3AF'">Lupa password?</a>
                </div>

                <button type="submit" class="btn-login">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                    Masuk ke Admin Panel
                </button>
            </form>

            <hr class="divider-line">


            {{-- Back link --}}
            <div style="margin-top:32px;text-align:center;">
                <a href="{{ route('home') }}" style="font-size:12px;color:#9CA3AF;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:color 150ms;"
                   onmouseover="this.style.color='#1A1A1A'" onmouseout="this.style.color='#9CA3AF'">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                    Kembali ke website
                </a>
            </div>
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>
</body>
</html>
