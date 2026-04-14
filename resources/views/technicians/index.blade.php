@extends('posts.layout')
@section('title', 'Técnicos')
@section('content')

<h1>Lista de Técnicos</h1>

<a href="{{ route('technicians.create') }}">Crear Técnico</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Edad</th>
            <th>Área</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($technicians as $technician)
        <tr>
            <td>{{ $technician->names }}</td>
            <td>{{ $technician->surnames }}</td>
            <td>{{ $technician->age }}</td>
            <td>{{ $technician->area }}</td>
            <td>
                <a href="{{ route('technicians.edit', $technician) }}">Editar</a>
                <form action="{{ route('technicians.destroy', $technician) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection