@extends('posts.layout')
@section('title', 'Editar Tarea')
@section('content')
    <h1>Editar Tarea</h1>
    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')
        
        @if(auth()->user()->role == 'tecnico')
            <label>Título</label>
            <input type="text" value="{{ $post->title }}" disabled style="background: #f1f5f9; cursor: not-allowed;">
            
            <label>Categoría</label>
            <input type="text" value="{{ $post->category }}" disabled style="background: #f1f5f9; cursor: not-allowed;">

            <label>Contenido</label>
            <textarea disabled rows="6" style="background: #f1f5f9; cursor: not-allowed;">{{ $post->content }}</textarea>
        @else
            <label>Título</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}">
            
            <label>Categoría</label>
            <input type="text" name="category" value="{{ old('category', $post->category) }}">

            <label>Contenido</label>
            <textarea name="content" rows="6">{{ old('content', $post->content) }}</textarea>
        @endif

        <label>Estado</label>
        <select name="status">
            <option value="pendiente" {{ old('status', $post->status) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="en_proceso" {{ old('status', $post->status) == 'en_proceso' ? 'selected' : '' }}>En proceso</option>
            <option value="finalizada" {{ old('status', $post->status) == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
        </select>

        @if(auth()->user()->role != 'tecnico')
            <label>Fecha límite</label>
            <input type="date" name="due_date" value="{{ old('due_date', $post->due_date) }}">
            
            <label>Técnico asignado</label>
            <select name="technician_id">
                <option value="">-- Seleccionar técnico --</option>
                @foreach($technicians as $technician)
                    <option value="{{ $technician->id }}" {{ old('technician_id', $post->technician_id) == $technician->id ? 'selected' : '' }}>
                        {{ $technician->names }} {{ $technician->surnames }}
                    </option>
                @endforeach
            </select>
        @endif

        <button type="submit">Actualizar Estado</button>
    </form>
@endsection
