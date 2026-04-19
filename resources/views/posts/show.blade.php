@extends('posts.layout')
@section('title', 'Detalle de la Tarea')
@section('content')
    <h1>{{ $post->title }}</h1>
    <p><strong>Categoría:</strong> {{ $post->category }}</p>
    <p><strong>Estado:</strong> {{ $post->status }}</p>
    <p><strong>Fecha límite:</strong> {{ $post->due_date }}</p>
    <p><strong>Técnico asignado:</strong> {{ $post->technician ? $post->technician->names . ' ' . $post->technician->surnames : 'Sin asignar' }}</p>
    <p><strong>Contenido:</strong></p>
    <p>{{ $post->content }}</p>
    <a href="{{ route('posts.edit', $post) }}">Editar</a>
@endsection
