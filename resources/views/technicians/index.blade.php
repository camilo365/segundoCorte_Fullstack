@extends('posts.layout')
@section('title', 'Técnicos')
@section('content')

<h1>Lista de Técnicos</h1>

@if(in_array(auth()->user()->role, ['administrador', 'editor']))
    <div style="margin-bottom: 20px;">
        <a href="{{ route('technicians.create') }}"
           style="padding:10px 20px; background:#1e293b; color:#fff; border-radius:8px; text-decoration:none;">
            Crear Técnico
        </a>
    </div>
@endif

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>Foto</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Edad</th>
            <th>Área</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($technicians as $technician)
        <tr>
            <td>
                @if($technician->photo)
                    <img src="{{ asset('storage/' . $technician->photo) }}" width="40" height="40" style="border-radius: 50%; object-fit: cover;">
                @else
                    <span>Sin foto</span>
                @endif
            </td>
            <td>{{ $technician->names }}</td>
            <td>{{ $technician->surnames }}</td>
            <td>{{ $technician->age }}</td>
            <td>{{ $technician->area }}</td>
            <td>{{ $technician->email }}</td>
            <td>
                @if(in_array(auth()->user()->role, ['administrador', 'editor']))
                    <a href="{{ route('technicians.edit', $technician) }}">Editar</a>
                @endif
                @if(auth()->user()->role == 'administrador')
                    <form action="{{ route('technicians.destroy', $technician) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection