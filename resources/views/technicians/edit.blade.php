@extends('posts.layout')
@section('title', 'Editar Técnico')
@section('content')

<h1>Editar Técnico</h1>

<form action="{{ route('technicians.update', $technician) }}" method="POST" enctype="multipart/form-data">
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

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $technician->email) }}">

    <label>Foto</label>
    <input type="file" name="photo" accept="image/*">
    @if($technician->photo)
        <div style="margin-bottom: 15px;">
            <img src="{{ asset('storage/' . $technician->photo) }}" width="100" style="border-radius: 50%;">
        </div>
    @endif

    <button type="submit">Actualizar</button>
</form>

@endsection