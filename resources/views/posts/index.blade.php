@extends('posts.layout')
@section('title', 'Listado de Posts')
@section('content')
    <h1>Listado de Posts</h1>
    @if($posts->count())
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Slug</th>
                    <th>Categoría</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->slug }}</td>
                                <td>{{ $post->category }}</td>
                                <td>

                                    <a href="{{ route('posts.show', $post)
                    }}">Ver</a> |
                                    <a href="{{ route('posts.edit', $post)
                    }}">Editar</a>

                    <a href="{{ route('posts.index', $post)}}">Eliminar</a>
                                </td>
                            </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay posts registrados.</p>
    @endif
@endsection