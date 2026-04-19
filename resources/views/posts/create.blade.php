@extends('posts.layout')
@section('title', 'Crear Tarea')
@section('content')

    <h1>Crear Tareas</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <label>Título</label>
        <input type="text" name="title" value="{{ old('title') }}">
        <label>Categoría</label>
        <input type="text" name="category" value="{{ old('category') }}">
        <label>Contenido</label>
        <textarea name="content" rows="6">{{ old('content') }}</textarea>
        <label>Estado</label>
        <select name="status">
            <option value="pendiente" {{ old('status') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="en_proceso" {{ old('status') == 'en_proceso' ? 'selected' : '' }}>En proceso</option>
            <option value="finalizada" {{ old('status') == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
        </select>
        <label>Fecha límite</label>
        <input type="date" name="due_date" value="{{ old('due_date') }}">
        <label>Técnico asignado</label>
        <select name="technician_id">
            <option value="">-- Seleccionar técnico --</option>
            @foreach($technicians as $technician)
                <option value="{{ $technician->id }}" {{ old('technician_id') == $technician->id ? 'selected' : '' }}>
                    {{ $technician->names }} {{ $technician->surnames }}
                </option>
            @endforeach
        </select>
        <button type="submit">Guardar</button>
    </form>
@endsection
