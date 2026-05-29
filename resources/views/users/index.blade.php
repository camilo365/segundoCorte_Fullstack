@extends('posts.layout')

@section('title', 'Listado de Usuarios')

@section('content')
    <h1>Listado de Usuarios</h1>
    <a href="{{ route('users.create') }}" style="display: inline-block; margin-bottom: 15px; text-decoration: none; background: #1e293b; color: white; padding: 8px 16px; border-radius: 8px;">Crear Usuario</a>
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" width="40" height="40" style="border-radius: 50%; object-fit: cover;">
                        @else
                            <span>Sin foto</span>
                        @endif
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}">Editar</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
