<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Gestión de Tareas')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            background: #e8f4f8;
            min-height: 100vh;
        }

        .topbar {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
            position: sticky;
            top: 0;
            z-index: 10;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .brand {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        nav { display: flex; gap: 8px; align-items: center; }

        nav a {
            text-decoration: none;
            color: #475569;
            font-size: 14px;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        nav a:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        nav a.active {
            background: #1e293b;
            color: white;
        }

        .logout-btn {
            background: #fee2e2;
            color: #991b1b;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .logout-btn:hover {
            background: #fecaca;
        }

        .page {
            padding: 2rem;
            max-width: 960px;
            margin: 0 auto;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 14px;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 14px;
        }

        .alert-error ul { padding-left: 1.2rem; }

        input, textarea, select {
            width: 100%;
            padding: 8px 12px;
            margin-top: 4px;
            margin-bottom: 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border 0.15s;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #94a3b8;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            color: #475569;
        }

        button {
            padding: 8px 18px;
            border: none;
            background: #1e293b;
            color: white;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.15s;
        }

        button:hover { background: #334155; }

        h1 {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th {
            text-align: left;
            padding: 10px 12px;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
        }

        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f8fafc; }

        td a {
            color: #3b82f6;
            text-decoration: none;
            font-size: 13px;
            margin-right: 8px;
        }

        td a:hover { text-decoration: underline; }

        td form { display: inline; }

        td button {
            background: #fef2f2;
            color: #dc2626;
            padding: 4px 10px;
            font-size: 12px;
            border-radius: 6px;
        }

        .logout{
            background-color: red;
            padding: ;
        }

        td button:hover { background: #fecaca; }
    </style>
</head>
<body>
    <div class="topbar">
        <a href="{{ route('dashboard') }}" class="brand">
            <span style="background: #1e293b; color: white; padding: 4px 8px; border-radius: 6px;">MD</span>
            Mesa de Ayuda
        </a>
        <nav>
            @if(auth()->check())
                <div style="display: flex; align-items: center; padding-right: 12px; border-right: 1px solid #e2e8f0; margin-right: 12px;">
                    @if(auth()->user()->photo)
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" width="32" height="32" style="border-radius: 50%; object-fit: cover; margin-right: 10px; border: 2px solid #e2e8f0;">
                    @endif
                    <div style="display: flex; flex-direction: column;">
                        <span style="font-size: 13px; font-weight: 700; color: #1e293b; line-height: 1;">{{ auth()->user()->name }}</span>
                        <span style="font-size: 11px; font-weight: 500; color: #64748b; text-transform: capitalize;">{{ auth()->user()->role }}</span>
                    </div>
                </div>
            @endif
            
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.*') ? 'active' : '' }}">Tareas</a>
            
            @if(auth()->user()->role != 'tecnico')
                <a href="{{ route('technicians.index') }}" class="{{ request()->routeIs('technicians.*') ? 'active' : '' }}">Técnicos</a>
            @endif
            
            @if(auth()->check() && auth()->user()->role == 'administrador')
                <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">Usuarios</a>
            @endif

            <form method="POST" action="{{ route('logout') }}" style="margin-left: 8px;">
                 @csrf
                <button type="submit" class="logout-btn">Salir</button>
            </form>
        </nav>
    </div>

    <div class="page">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            @yield('content')
        </div>
    </div>
</body>
</html>