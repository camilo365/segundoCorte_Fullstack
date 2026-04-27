@extends('posts.layout')
@section('title', 'Usuarios')
@section('content')

<h1>Lista de Usuarios</h1>

<a href="{{ route('users.create') }}">Crear Usuario</a>

@if($users->count())
    <table style="margin-top: 1rem;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Fecha de creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No hay usuarios registrados.</p>
@endif

@endsection
