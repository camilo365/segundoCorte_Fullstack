@extends('posts.layout')
@section('title', 'Listado de Tareas')
@section('content')

<h1>LISTADO DE TAREAS DE DESARROLLO</h1>

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
                <th>Acciones</th>
                <th>Técnico</th>
                <th>Asignar</th>
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
                    <td style="display:flex; gap:6px; align-items:center; flex-wrap:wrap;">
                        <a href="{{ route('posts.show', $post) }}"
                           style="padding:5px 12px; background:#3b82f6; color:#fff; border-radius:6px; text-decoration:none; font-size:13px;">
                            Ver
                        </a>
                        <a href="{{ route('posts.edit', $post) }}"
                           style="padding:5px 12px; background:#f59e0b; color:#fff; border-radius:6px; text-decoration:none; font-size:13px;">
                            Editar
                        </a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                style="padding:5px 12px; background:#ef4444; color:#fff; border:none; border-radius:6px; font-size:13px; cursor:pointer;">
                                Eliminar
                            </button>
                        </form>
                    </td>
                    <td>
                        <select name="technician_id" style="padding:10px 50px; border-radius:6px; border:1px solid #cbd5e1; font-size:13px;">
                            <option value="">-- Seleccionar --</option>
                            @foreach($technicians as $technician)
                                <option value="{{ $technician->id }}">
                                    {{ $technician->names }} {{ $technician->surnames }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button type="button"
                            style="padding:5px 14px; background:#10b981; color:#fff; border:none; border-radius:6px; font-size:13px; cursor:pointer;">
                            Asignar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No hay tareas registradas.</p>
@endif

@endsection
