<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK Beasiswa — @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *{font-family:'Manrope',system-ui,sans-serif}
        body{margin:0;background:#eef2f7}
        .sidebar{width:240px;min-height:100vh;background:linear-gradient(180deg,#4338ca 0%,#3730a3 100%);display:flex;flex-direction:column;position:fixed;left:0;top:0;bottom:0;z-index:50;border-radius:0 24px 24px 0;overflow:hidden}
        .sidebar .brand{padding:28px 24px 16px;display:flex;align-items:center;gap:12px}
        .sidebar .brand-icon{width:36px;height:36px;background:rgba(255,255,255,.2);border-radius:12px;display:flex;align-items:center;justify-content:center;backdrop-filter:blur(8px)}
        .sidebar .brand-text{color:#fff;font-weight:800;font-size:15px;letter-spacing:-.3px}
        .sidebar .brand-sub{color:rgba(255,255,255,.6);font-size:10px;font-weight:600}
        .sidebar .profile{margin:0 16px 20px;padding:12px;background:rgba(255,255,255,.08);border-radius:16px;display:flex;align-items:center;gap:10px;border:1px solid rgba(255,255,255,.06)}
        .sidebar .profile-avatar{width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#38bdf8,#3b82f6);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:14px;border:2px solid rgba(255,255,255,.2);box-shadow:0 4px 12px rgba(0,0,0,.15)}
        .sidebar .profile-name{color:#fff;font-size:13px;font-weight:600}
        .sidebar .profile-role{color:rgba(255,255,255,.5);font-size:10px;font-weight:500}
        .sidebar .nav-list{flex:1;padding:0 12px;overflow-y:auto}
        .sidebar .nav-item{display:flex;align-items:center;gap:12px;padding:10px 14px;border-radius:14px;color:rgba(255,255,255,.55);font-size:13px;font-weight:600;text-decoration:none;transition:all .2s;margin-bottom:4px;cursor:pointer}
        .sidebar .nav-item:hover{background:rgba(255,255,255,.08);color:#fff}
        .sidebar .nav-item.active{background:rgba(255,255,255,.15);color:#fff;box-shadow:inset 0 1px 0 rgba(255,255,255,.1)}
        .sidebar .nav-item i,.sidebar .nav-item svg{width:18px;height:18px;opacity:.8}
        .sidebar .nav-item.active i,.sidebar .nav-item.active svg{opacity:1}
        .sidebar .nav-item .chevron{margin-left:auto;width:14px;height:14px;opacity:.4}
        .sidebar footer{padding:16px 24px;color:rgba(255,255,255,.3);font-size:10px;font-weight:600}

        .main{margin-left:240px;min-height:100vh;padding:20px 24px}
        .topbar{display:flex;align-items:center;justify-content:space-between;background:#fff;border-radius:16px;padding:14px 20px;margin-bottom:20px;box-shadow:0 1px 4px rgba(0,0,0,.04);border:1px solid #e8ecf2}
        .topbar-left h1{font-size:14px;font-weight:700;color:#1a1a2e;margin:0}
        .topbar-left .crumbs{font-size:11px;color:#94a3b8;margin-top:2px;display:flex;align-items:center;gap:4px}
        .topbar-left .crumbs span.current{color:#475569;font-weight:600}
        .topbar-right{display:flex;align-items:center;gap:8px}
        .topbar-btn{width:36px;height:36px;border-radius:10px;border:1px solid #e8ecf2;background:#f8fafc;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .15s;position:relative;color:#64748b}
        .topbar-btn:hover{background:#eef2f7;color:#334155}
        .topbar-btn .dot{position:absolute;top:6px;right:6px;width:7px;height:7px;background:#ef4444;border-radius:50%;border:2px solid #fff}

        .content-card{background:#fff;border-radius:16px;padding:24px;box-shadow:0 1px 4px rgba(0,0,0,.04);border:1px solid #e8ecf2}

        .alert{display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:12px;font-size:13px;font-weight:500;margin-bottom:16px}
        .alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#166534}
        .alert-error{background:#fef2f2;border:1px solid #fecaca;color:#991b1b}

        /* Table styles */
        table{width:100%;border-collapse:collapse}
        table th{text-align:left;padding:10px 16px;font-size:11px;font-weight:600;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;border-bottom:1px solid #f1f5f9}
        table td{padding:12px 16px;font-size:13px;color:#475569;border-bottom:1px solid #f8fafc}
        table tbody tr:hover{background:#f8fafc}

        /* Form inputs */
        .form-input{width:100%;padding:10px 14px;border:1px solid #e2e8f0;border-radius:12px;font-size:13px;outline:none;transition:all .15s;background:#fff}
        .form-input:focus{border-color:#818cf8;box-shadow:0 0 0 3px rgba(129,140,248,.15)}
        .form-select{appearance:auto}
        .form-label{display:block;font-size:11px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.04em;margin-bottom:6px}

        .btn-primary{display:inline-flex;align-items:center;gap:6px;padding:10px 20px;background:#4f46e5;color:#fff;border:none;border-radius:12px;font-size:13px;font-weight:600;cursor:pointer;transition:all .15s;box-shadow:0 2px 8px rgba(79,70,229,.25)}
        .btn-primary:hover{background:#4338ca;box-shadow:0 4px 12px rgba(79,70,229,.35)}
        .btn-icon{width:32px;height:32px;border-radius:10px;display:inline-flex;align-items:center;justify-content:center;border:none;cursor:pointer;transition:all .15s;font-size:0}
        .btn-icon svg,.btn-icon i{width:14px;height:14px}
        .btn-edit{background:#fffbeb;color:#d97706}.btn-edit:hover{background:#fef3c7}
        .btn-delete{background:#fef2f2;color:#ef4444}.btn-delete:hover{background:#fee2e2}

        .badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:8px;font-size:11px;font-weight:600}
        .badge-green{background:#f0fdf4;color:#16a34a}
        .badge-red{background:#fef2f2;color:#dc2626}
        .badge-blue{background:#eff6ff;color:#2563eb}
        .badge-violet{background:#f5f3ff;color:#7c3aed}
        .badge-amber{background:#fffbeb;color:#d97706}

        .empty-state{padding:48px 16px;text-align:center;color:#94a3b8}
        .empty-state i,.empty-state svg{width:40px;height:40px;margin:0 auto 12px;opacity:.4}
    </style>
</head>
<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon"><i data-lucide="hexagon" style="width:18px;height:18px;color:#fff"></i></div>
            <div>
                <div class="brand-text">SPK Beasiswa</div>
                <div class="brand-sub">Metode SAW · Kelompok DSS</div>
            </div>
        </div>

        <div class="profile">
            <div class="profile-avatar">A</div>
            <div>
                <div class="profile-name">Administrator</div>
                <div class="profile-role">Kepala Seleksi</div>
            </div>
        </div>

        <p style="padding:0 24px;font-size:10px;font-weight:700;color:rgba(255,255,255,.35);text-transform:uppercase;letter-spacing:.1em;margin-bottom:8px">Menu</p>

        <nav class="nav-list">
            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard"></i> Dashboard
                <i data-lucide="chevron-right" class="chevron"></i>
            </a>
            <a href="{{ route('students.index') }}" class="nav-item {{ request()->routeIs('students.*') ? 'active' : '' }}">
                <i data-lucide="graduation-cap"></i> Mahasiswa
                <i data-lucide="chevron-right" class="chevron"></i>
            </a>
            <a href="{{ route('criteria.index') }}" class="nav-item {{ request()->routeIs('criteria.*') ? 'active' : '' }}">
                <i data-lucide="sliders-horizontal"></i> Kriteria
                <i data-lucide="chevron-right" class="chevron"></i>
            </a>
            <a href="{{ route('assessments.index') }}" class="nav-item {{ request()->routeIs('assessments.*') ? 'active' : '' }}">
                <i data-lucide="clipboard-list"></i> Penilaian
                <i data-lucide="chevron-right" class="chevron"></i>
            </a>
            <a href="{{ route('calculation') }}" class="nav-item {{ request()->routeIs('calculation') ? 'active' : '' }}">
                <i data-lucide="trophy"></i> Hasil Rekomendasi
                <i data-lucide="chevron-right" class="chevron"></i>
            </a>
        </nav>

        <footer>&copy; 2026 DSS Kelompok</footer>
    </aside>

    {{-- MAIN --}}
    <div class="main">
        {{-- Top Bar --}}
        <div class="topbar">
            <div class="topbar-left">
                <h1>@yield('title', 'Dashboard')</h1>
                <div class="crumbs">
                    SPK Beasiswa
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16 16"><path fill="currentColor" fill-rule="evenodd" d="m10.207 8l-3.854 3.854l-.707-.707L8.793 8L5.646 4.854l.707-.708z" clip-rule="evenodd"/></svg>
                    <span class="current">@yield('title', 'Dashboard')</span>
                </div>
            </div>
            <div class="topbar-right">
                <button class="topbar-btn" onclick="location.reload()" title="Refresh">
                    <i data-lucide="refresh-cw" style="width:16px;height:16px"></i>
                </button>
                <button class="topbar-btn" title="Notifikasi">
                    <i data-lucide="bell" style="width:16px;height:16px"></i>
                    <span class="dot"></span>
                </button>
            </div>
        </div>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="alert alert-success">
                <i data-lucide="check-circle-2" style="width:16px;height:16px;color:#16a34a;flex-shrink:0"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <i data-lucide="alert-circle" style="width:16px;height:16px;color:#dc2626;flex-shrink:0"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- Content --}}
        @yield('content')
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>
