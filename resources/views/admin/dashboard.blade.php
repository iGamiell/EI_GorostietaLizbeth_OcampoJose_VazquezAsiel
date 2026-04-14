@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<h2 class="mb-4">
    <i class="fas fa-chart-line"></i> Panel de Administrador
</h2>

<div class="row">

    <div class="col-md-4 mb-3">
        <div class="card shadow text-center p-3">
            <i class="fas fa-users fa-2x text-primary mb-2"></i>
            <h5>Usuarios</h5>
            <h3>{{ $totalUsers }}</h3>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow text-center p-3">
            <i class="fas fa-calendar fa-2x text-success mb-2"></i>
            <h5>Actividades</h5>
            <h3>{{ $totalActivities }}</h3>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow text-center p-3">
            <i class="fas fa-sticky-note fa-2x text-warning mb-2"></i>
            <h5>Notas</h5>
            <h3>{{ $totalNotes }}</h3>
        </div>
    </div>

</div>

<div class="d-flex justify-content-between align-items-center mt-4 mb-2">

    <a href="/google/redirect" class="btn btn-danger">
        <i class="fab fa-google"></i> Conectar Google Calendar
    </a>

    <a href="https://calendar.google.com" target="_blank" class="btn btn-outline-danger">
        <i class="fab fa-google"></i> Abrir Google Calendar
    </a>
</div>

<!-- USUARIOS RECIENTES -->
<div class="card shadow mt-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-users"></i> Usuarios recientes
    </div>

    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentUsers as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'secondary' }}">
                            {{ $user->role }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection