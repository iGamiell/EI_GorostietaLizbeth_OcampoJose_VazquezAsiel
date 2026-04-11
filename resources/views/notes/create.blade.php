@extends('layouts.app')

@section('content')

<h2>Nueva Nota</h2>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif

<form method="POST" action="{{ route('notes.store') }}">
    @csrf

    <input type="text" name="title" class="form-control mb-2" placeholder="Título">

    <textarea name="content" class="form-control mb-2" placeholder="Contenido"></textarea>

    <button class="btn btn-primary">Guardar</button>
</form>

@endsection