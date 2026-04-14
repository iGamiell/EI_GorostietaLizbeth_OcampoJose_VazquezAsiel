@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')

<h2 class="mb-4">
    <i class="fas fa-users"></i> Lista de Usuarios
</h2>

<a href="/users/create" class="btn btn-success mb-3">
    <i class="fas fa-user-plus"></i> Nuevo Usuario
</a>

<table class="table table-striped table-bordered shadow">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'secondary' }}">
                    {{ $user->role }}
                </span>
            </td>
            <td>
                <a href="/users/edit/{{ $user->id }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i>
                </a>

                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection