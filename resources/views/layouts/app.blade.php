<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('topbar-title', 'Sistema de Água')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.0.0/dist/tabler-icons.min.css">
    <style>
        :root {
            --primary: #0A3D62;
            --primary-dark: #082F4E;
            --sidebar-width: 220px;
            --surface: #ffffff;
            --muted: #5f6b7a;
            --border: #e5e7eb;
            --success-bg: #e7f8ef;
            --success-text: #1b7a43;
            --danger-bg: #fde7e7;
            --danger-text: #b42318;
            --warning-bg: #fff7db;
            --warning-text: #b45309;
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Inter, "Segoe UI", sans-serif;
            background: #f4f7fb;
            color: #122033;
        }

        .app-shell { display: flex; min-height: 100vh; }
        .sidebar {
            width: var(--sidebar-width);
            background: var(--primary);
            color: white;
            padding: 18px 12px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .sidebar a {
            color: #dfeeff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            transition: 0.2s;
        }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.1); color: #fff; }
        .content-area { flex: 1; display: flex; flex-direction: column; }
        .topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 26px;
        }
        .topbar h2 { margin: 0; font-size: 1rem; color: var(--primary); }
        .main-content { padding: 26px; }

        .alert {
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 0.95rem;
        }
        .alert-success { background: var(--success-bg); color: var(--success-text); }
        .alert-danger { background: var(--danger-bg); color: var(--danger-text); }

        .card {
            background: var(--surface);
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 8px 24px rgba(10,61,98,0.06);
            margin-bottom: 18px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border: none;
            border-radius: 10px;
            padding: 10px 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: 0.2s;
        }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-success { background: #1f9d58; color: #fff; }
        .btn-success:hover { background: #18834a; }
        .btn-warning { background: #f5a623; color: #fff; }
        .btn-warning:hover { background: #d98f00; }
        .btn-danger { background: #e74c3c; color: #fff; }
        .btn-danger:hover { background: #c0392b; }
        .btn-outline { background: #fff; color: var(--primary); border: 1px solid var(--border); }
        .btn-outline:hover { background: #f7f9fb; }
        .btn-whatsapp { background: #25D366; color: #fff; }
        .btn-whatsapp:hover { background: #1ea756; }

        .stat-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; }
        .stat-box {
            background: var(--surface);
            border-radius: 14px;
            padding: 18px;
            box-shadow: 0 6px 18px rgba(10,61,98,0.06);
        }
        .stat-box h3 { margin: 0; font-size: 0.9rem; color: var(--muted); }
        .stat-box p { margin: 8px 0 0; font-size: 1.8rem; font-weight: 700; }

        table { width: 100%; border-collapse: collapse; font-size: 0.95rem; }
        th, td { padding: 12px 10px; border-bottom: 1px solid var(--border); text-align: left; }
        th { color: var(--primary); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.04em; }

        label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #34495e;
            display: block;
            margin-bottom: 6px;
        }
        input, select, textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 0.95rem;
            outline: none;
        }
        input:focus, select:focus, textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(10,61,98,0.08);
        }
        .is-invalid { border-color: #e74c3c !important; }
        .invalid-feedback { color: #e74c3c; font-size: 0.83rem; margin-top: 5px; }

        .inline-actions { display: flex; gap: 8px; align-items: center; }
        .muted { color: var(--muted); }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 0.82rem;
            font-weight: 700;
        }
        .badge-pendente { background: var(--warning-bg); color: var(--warning-text); }
        .badge-pago { background: var(--success-bg); color: var(--success-text); }
        .row { display: flex; gap: 16px; }
        .col { flex: 1; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        @media (max-width: 900px) {
            .app-shell { flex-direction: column; }
            .sidebar { width: 100%; flex-direction: row; overflow-x: auto; }
            .stat-grid, .grid-2 { grid-template-columns: 1fr; }
            .row { flex-direction: column; }
        }
    </style>
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="ti ti-home"></i> Dashboard
        </a>
        <a href="{{ route('consumidores.index') }}" class="{{ request()->routeIs('consumidores.*') ? 'active' : '' }}">
            <i class="ti ti-users"></i> Consumidores
        </a>
        <a href="{{ route('leituras.create') }}" class="{{ request()->routeIs('leituras.*') ? 'active' : '' }}">
            <i class="ti ti-report-analytics"></i> Registrar Leitura
        </a>
        <a href="{{ route('faturas.index') }}" class="{{ request()->routeIs('faturas.*') ? 'active' : '' }}">
            <i class="ti ti-receipt"></i> Faturas
        </a>
        <a href="{{ route('configuracao.edit') }}" class="{{ request()->routeIs('configuracao.*') ? 'active' : '' }}">
            <i class="ti ti-settings"></i> Configuração
        </a>
    </aside>

    <main class="content-area">
        <header class="topbar">
            <h2>@yield('topbar-title', 'Painel')</h2>
        </header>

        <section class="main-content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @yield('content')
        </section>
    </main>
</div>
</body>
</html>
