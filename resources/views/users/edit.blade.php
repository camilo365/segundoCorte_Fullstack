@extends('posts.layout')

@section('title', 'Editar Usuario')

@section('content')
    <h1>Editar Usuario</h1>

    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Nombre</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}">

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}">

        <label>Rol</label>
        <select name="role">
            <option value="administrador" {{ $user->role == 'administrador' ? 'selected' : '' }}>Administrador</option>
            <option value="editor" {{ $user->role == 'editor' ? 'selected' : '' }}>Editor</option>
            <option value="tecnico" {{ $user->role == 'tecnico' ? 'selected' : '' }}>Técnico</option>
            <option value="invitado" {{ $user->role == 'invitado' ? 'selected' : '' }}>Invitado</option>
        </select>

        <label>Foto de perfil</label>
        <input type="file" name="photo" accept="image/*">
        @if($user->photo)
            <div style="margin-bottom: 15px;">
                <img src="{{ asset('storage/' . $user->photo) }}" width="100" style="border-radius: 50%;">
            </div>
        @endif

        <button type="submit">Actualizar</button>
    </form>
@endsection
