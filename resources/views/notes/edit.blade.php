@extends('layouts.app')

@section('content')

<h2>Editar Nota</h2>

<form method="POST" action="{{ route('notes.update', $note->id) }}">
    @csrf

    <input type="text" name="title" value="{{ $note->title }}" class="form-control mb-2">

    <textarea name="content" class="form-control mb-2">{{ $note->content }}</textarea>

    <button class="btn btn-primary">Actualizar</button>
</form>

@endsection