@extends('posts.layout')
@section('title', 'Ver Técnico')
@section('content')

<h1>{{ $technician->names }} {{ $technician->surnames }}</h1>
<p><strong>Edad:</strong> {{ $technician->age }}</p>
<p><strong>Área:</strong> {{ $technician->area }}</p>

<a href="{{ route('technicians.index') }}">Volver</a>

@endsection