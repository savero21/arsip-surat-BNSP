<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arsip Surat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --line:#cfd8e3; --txt:#1f2937; --muted:#64748b; 
            --bg:#f8fafc; --accent:#0ea5e9;
        }
        * { box-sizing:border-box }
        body {
            margin:0;
            font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif;
            color:var(--txt);
            background:var(--bg);
        }
        .layout { display:grid; grid-template-columns:260px 1fr; min-height:100vh }
        .aside { border-right:2px solid var(--line); padding:20px; background:#fff; }
        .brand { font-weight:700; font-size:20px; margin-bottom:18px }
        .menu { list-style:none; margin:0; padding:0 }
        .menu li { margin:8px 0 }
        .menu a {
            display:flex; gap:8px; align-items:center;
            text-decoration:none; color:var(--txt);
            padding:8px 10px; border-radius:10px
        }
        .menu a:hover { background:#f1f5f9 }
        .main { padding:28px }
        .card {
            background:#fff; border:2px solid var(--line); border-radius:14px;
        }
        .table { width:100%; border-collapse:collapse }
        .table th,.table td {
            border:2px solid var(--line); padding:10px
        }
        .table th {
            background:#f1f5f9; text-align:left; font-weight:700
        }
        .hstack { display:flex; gap:8px; align-items:center }
        .search { display:flex; gap:8px; margin:14px 0 }
        .search input[type="text"] {
            flex:1; padding:10px 12px; border:2px solid var(--line);
            border-radius:20px; outline:none
        }
        .btn {
            display:inline-block; border:none; border-radius:10px;
            padding:8px 12px; text-decoration:none; cursor:pointer
        }
        .btn:focus { outline:2px dashed #94a3b8; outline-offset:2px }
        .btn-primary { background:var(--accent); color:#fff }
        .btn-muted { background:#e2e8f0; color:#0f172a }
        .btn-danger { background:#ef4444; color:#fff }
        .btn-warning { background:#f59e0b; color:#000 }
        .btn-navy { background:#1d4ed8; color:#fff }
        .header { margin-bottom:12px }
        .header h1 { margin:0 0 6px 0 }
        .small { color:var(--muted); font-size:14px }
        .alert {
            padding:10px 12px; border:2px solid #c7f9cc;
            background:#eafff1; border-radius:10px; margin-bottom:12px
        }
        .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:12px }
        input[type="text"], input[type="datetime-local"], select, input[type="file"] {
            width:100%; padding:10px; border:2px solid var(--line); border-radius:10px
        }
        .actions .btn { padding:6px 10px }
        .footer-action { margin-top:12px }
        iframe {
            width:100%; height:80vh; border:2px solid var(--line); border-radius:12px
        }
        @media (max-width:1000px){
            .layout{ grid-template-columns:1fr }
            .aside{ border-right:none; border-bottom:2px solid var(--line) }
            .form-grid{ grid-template-columns:1fr }
        }
    </style>
</head>
<body>
<div class="layout">
    <aside class="aside">
        <div class="brand">Menu</div>
        <ul class="menu">
            <li><a href="{{ route('letters.index') }}">📄 Arsip</a></li>
            <li><a href="{{ route('categories.index') }}">🏷️ Kategori Surat</a></li>
            <li><a href="{{ route('about') }}">ℹ️ About</a></li>
        </ul>
    </aside>
    <main class="main">
        @if(session('ok'))
            <div class="alert">{{ session('ok') }}</div>
        @endif

        @yield('content')
    </main>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Script download Blob --}}
<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.btn-download').forEach(btn => {
        btn.addEventListener('click', function() {
            const url = this.dataset.url;
            const filename = this.dataset.filename;

            fetch(url)
                .then(res => res.blob())
                .then(blob => {
                    const fileUrl = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = fileUrl;
                    a.download = filename;
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(fileUrl);
                })
                .catch(err => alert('Gagal mengunduh file: ' + err));
        });
    });
});
</script>

@stack('scripts')
</body>
</html>
