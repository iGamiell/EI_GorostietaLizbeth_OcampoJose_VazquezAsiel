@extends('layouts.app')

@section('content')

<h2>Editar Actividad</h2>

<form method="POST" action="{{ route('activities.update', $activity->id) }}">
    @csrf

    <input type="text" name="title" value="{{ $activity->title }}" class="form-control mb-2">

    <textarea name="description" class="form-control mb-2">{{ $activity->description }}</textarea>

    <button class="btn btn-primary">Actualizar</button>
</form>

@endsection