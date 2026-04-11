@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('content')

<h2 class="mb-4">
    <i class="fas fa-user-plus"></i> Crear Usuario
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
<form method="POST" action="/users" class="card p-4 shadow">
    @csrf

    <div class="mb-3">
        <label>Nombre</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input type="text" name="name" class="form-control" required>
        </div>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="email" name="email" class="form-control" required>
        </div>
    </div>

    <div class="mb-3">
        <label>Contraseña</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" name="password" class="form-control" required>
        </div>
    </div>

    <div class="mb-3">
        <label>Rol</label>
        <select name="role" class="form-control">
            <option value="user">Usuario</option>
            <option value="admin">Administrador</option>
        </select>
    </div>

    <button class="btn btn-success">
        <i class="fas fa-save"></i> Guardar
    </button>

    <a href="/users" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>

</form>

@endsection