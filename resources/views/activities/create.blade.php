@extends('layouts.app')

@section('content')

<h2>Nueva Actividad</h2>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif

<form method="POST" action="{{ route('activities.store') }}">
    @csrf

    <input type="text" name="title" class="form-control mb-2" placeholder="Título">

    <textarea name="description" class="form-control mb-2" placeholder="Descripción"></textarea>

    <button class="btn btn-primary">Guardar</button>
</form>

@endsection
