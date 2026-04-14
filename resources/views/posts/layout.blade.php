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
            background: #dbeafe;
            border-bottom: 1px solid #bfdbfe;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 56px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .brand {
            font-size: 15px;
            font-weight: 600;
            color: #1e293b;
        }

        nav { display: flex; gap: 4px; }

        nav a {
            text-decoration: none;
            color: #64748b;
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 6px;
            transition: background 0.15s, color 0.15s;
        }

        nav a:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        .page {
            padding: 2rem;
            max-width: 960px;
            margin: 0 auto;
        }

        .card {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 12px;
            padding: 1.5rem 2rem;
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

        td button:hover { background: #fecaca; }
    </style>
</head>
<body>
    <div class="topbar">
        <span class="brand">Gestión de Tareas</span>
        <nav>
            <a href="{{ route('posts.index') }}">Inicio</a>
            <a href="{{ route('posts.create') }}">Crear Tarea</a>
            <a href="{{ route('technicians.create') }}">Crear Técnico</a>
            <a href="{{ route('technicians.index') }}">Ver Técnicos</a>
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