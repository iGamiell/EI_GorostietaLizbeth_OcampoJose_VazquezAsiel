@extends('layouts.app')

@section('content')

<h2>Editar Actividad</h2>

<form method="POST" action="{{ route('activities.update', $activity->id) }}">
    @csrf

    <input type="text" name="title" value="{{ $activity->title }}" class="form-control mb-2">

    <textarea name="description" class="form-control mb-2">{{ $activity->description }}</textarea>

    <input type="date" name="date" value="{{ $activity->date }}" class="form-control mb-2">

    <input type="time" name="time" value="{{ $activity->time }}" class="form-control mb-2">

    @if(auth()->user()->role == 'admin')
    <select name="user_id" class="form-control mb-2">
        <option value="all" {{ $activity->user_id == 'all' ? 'selected' : '' }}>Todos</option>
        @foreach(\App\Models\User::all() as $user)
            <option value="{{ $user->id }}" {{ $activity->user_id == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
    @endif

    <button class="btn btn-primary">Actualizar</button>
</form>

@endsection