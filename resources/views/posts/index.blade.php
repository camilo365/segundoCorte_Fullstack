@extends('posts.layout')
@section('title', 'Listado de Tareas')
@section('content')

<h1>LISTADO DE TAREAS DE DESARROLLO</h1>

@if(in_array(auth()->user()->role, ['administrador', 'editor']))
    <div style="margin-bottom: 20px;">
        <a href="{{ route('posts.create') }}" 
           style="padding:10px 20px; background:#1e293b; color:#fff; border-radius:8px; text-decoration:none;">
            Crear Nueva Tarea
        </a>
    </div>
@endif

@if($posts->count())
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Categoría</th>
                <th>Contenido</th>
                <th>Estado</th>
                <th>Fecha límite</th>
                <th>Técnico asignado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category }}</td>
                    <td>{{ $post->content }}</td>
                    <td>{{ $post->status }}</td>
                    <td>{{ $post->due_date }}</td>
                    <td>
                        {{ $post->technician ? $post->technician->names . ' ' . $post->technician->surnames : 'Sin asignar' }}
                    </td>
                    <td style="display:flex; gap:6px; align-items:center; flex-wrap:wrap;">
                        <a href="{{ route('posts.show', $post) }}"
                           style="padding:5px 12px; background:#3b82f6; color:#fff; border-radius:6px; text-decoration:none; font-size:13px;">
                            Ver
                        </a>
                        @if(in_array(auth()->user()->role, ['administrador', 'editor', 'tecnico']))
                            <a href="{{ route('posts.edit', $post) }}"
                               style="padding:5px 12px; background:#f59e0b; color:#fff; border-radius:6px; text-decoration:none; font-size:13px;">
                                Actualizar Estado
                            </a>
                        @endif
                        @if(auth()->user()->role == 'administrador')
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="padding:5px 12px; background:#ef4444; color:#fff; border:none; border-radius:6px; font-size:13px; cursor:pointer;">
                                    Eliminar
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No hay tareas registradas.</p>
@endif

@endsection
