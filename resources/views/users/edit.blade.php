@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')

<h2 class="mb-4">
    <i class="fas fa-edit"></i> Editar Usuario
</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <strong>Errores:</strong>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/users/update/{{ $user->id }}" class="card p-4 shadow">
    @csrf

    <div class="mb-3">
        <label>Nombre</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
        </div>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control">
        </div>
    </div>

    <div class="mb-3">
        <label>Rol</label>
        <select name="role" class="form-control">
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Usuario</option>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrador</option>
        </select>
    </div>

    <button class="btn btn-primary">
        <i class="fas fa-save"></i> Actualizar
    </button>

    <a href="/users" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>

</form>

@endsection