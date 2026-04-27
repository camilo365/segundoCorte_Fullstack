@extends('posts.layout')
@section('title', 'Crear Usuario')
@section('content')

<h1>Crear Usuario</h1>

<form action="{{ route('users.store') }}" method="POST">
    @csrf

    <label>Nombre</label>
    <input type="text" name="name" value="{{ old('name') }}">

    <label>Correo electrónico</label>
    <input type="email" name="email" value="{{ old('email') }}">

    <label>Contraseña</label>
    <input type="password" name="password">

    <label>Confirmar contraseña</label>
    <input type="password" name="password_confirmation">

    <button type="submit">Guardar</button>
</form>

@endsection
