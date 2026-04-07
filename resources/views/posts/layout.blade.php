<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'CRUD Posts')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background:
                #f8f9fa;
        }

        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #0d6efd;
            font-weight: bold;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .08);
        }

        .success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .error {
            background: #f8d7da;
            color: #842029;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        button {
            padding: 10px 16px;
            border: none;
            background: #0d6efd;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav>
        <a href="{{ route('posts.index') }}">Inicio</a>
        <a href="{{ route('posts.create') }}">Crear Post</a>
    </nav>
    <div class="container">
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </div>
</body>

</html>