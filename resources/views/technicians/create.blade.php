@extends('posts.layout')
@section('title', 'Crear Técnico')
@section('content')

<h1>Crear Técnico</h1>
<form action="{{ route('technicians.store') }}" method="POST">
    @csrf
    <label>Nombres</label>
    <input type="text" name="names" value="{{ old('names') }}">

    <label>Apellidos</label>
    <input type="text" name="surnames" value="{{ old('surnames') }}">

    <label>Edad</label>
    <input type="number" name="age" value="{{ old('age') }}">

    <label>Área a la que pertenece</label>
    <input type="text" name="area" value="{{ old('area') }}">

    <button type="submit">Guardar</button>
</form>
@endsection