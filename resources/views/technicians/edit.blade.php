@extends('posts.layout')
@section('title', 'Editar Técnico')
@section('content')

<h1>Editar Técnico</h1>

<form action="{{ route('technicians.update', $technician) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nombres</label>
    <input type="text" name="names" value="{{ old('names', $technician->names) }}">

    <label>Apellidos</label>
    <input type="text" name="surnames" value="{{ old('surnames', $technician->surnames) }}">

    <label>Edad</label>
    <input type="number" name="age" value="{{ old('age', $technician->age) }}">

    <label>Área</label>
    <input type="text" name="area" value="{{ old('area', $technician->area) }}">

    <button type="submit">Actualizar</button>
</form>

@endsection