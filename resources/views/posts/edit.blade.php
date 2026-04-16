@extends('posts.layout')
@section('title', 'Editar Tarea')
@section('content')
    <h1>Editar Tarea</h1>
    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Título</label>
        <input type="text" name="title" value="{{ old('title', $post->title) }}">
        <label>Categoría</label>
        <input type="text" name="category" value="{{ old('category', $post->category) }}">

        <label>Contenido</label>
        <textarea name="content" rows="6">{{ old('content', $post->content)
    }}</textarea>
        <label>Estado</label>
        <select name="status">
            <option value="pendiente" {{ old('status', $post->status) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="en_proceso" {{ old('status', $post->status) == 'en_proceso' ? 'selected' : '' }}>En proceso</option>
            <option value="finalizada" {{ old('status', $post->status) == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
        </select>
        <label>Fecha límite</label>
        <input type="date" name="due_date" value="{{ old('due_date', $post->due_date) }}">
        <button type="submit">Actualizar</button>
    </form>
@endsection
