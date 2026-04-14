<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <title>Login Laravel 12</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #111827;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .success {
            color: green;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class='card'>
        <h2>Iniciar sesión</h2>
        @if(session('success'))
            <p class='success'>{{ session('success') }}</p>
        @endif
        <form action='{{ route('login') }}' method='POST'>
            @csrf
            <label>Correo electrónico</label>
            <input type='email' name='email' value='{{ old('email') }}' required>

            @error('email')
                <p class='error'>{{ $message }}</p>
            @enderror
            <label>Contraseña</label>
            <input type='password' name='password' required>
            @error('password')
                <p class='error'>{{ $message }}</p>
            @enderror
            <button type='submit'>Ingresar</button>
        </form>
    </div>
</body>

</html>