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

    <div class="mb-3">
        <label>Título</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Fecha</label>
        <input type="date" name="date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Hora</label>
        <input type="time" name="time" class="form-control" required>
    </div>

    @if(auth()->user()->role == 'admin')
    <div class="mb-3">
        <label>Asignar a</label>
        <select name="user_id" class="form-control">
            <option value="all">Todos</option>
            @foreach(\App\Models\User::all() as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    @endif

    <button class="btn btn-primary">
        <i class="fas fa-save"></i> Guardar
    </button>

</form>

@endsection