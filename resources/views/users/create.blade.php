@extends('posts.layout')

@section('title', 'Crear Usuario')

@section('content')
    <h1>Crear Nuevo Usuario</h1>

    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Nombre</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Contraseña</label>
        <input type="password" name="password" required>

        <label>Confirmar Contraseña</label>
        <input type="password" name="password_confirmation" required>

        <label>Rol</label>
        <select name="role">
            <option value="invitado" {{ old('role') == 'invitado' ? 'selected' : '' }}>Invitado</option>
            <option value="editor" {{ old('role') == 'editor' ? 'selected' : '' }}>Editor</option>
            <option value="tecnico" {{ old('role') == 'tecnico' ? 'selected' : '' }}>Técnico</option>
            <option value="administrador" {{ old('role') == 'administrador' ? 'selected' : '' }}>Administrador</option>
        </select>

        <label>Foto de perfil</label>
        <input type="file" name="photo" accept="image/*">

        <button type="submit">Crear Usuario</button>
    </form>
@endsection
