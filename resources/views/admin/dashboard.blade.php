@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<h2 class="mb-4">
    <i class="fas fa-chart-line"></i> Panel de Administrador
</h2>

<div class="row">

    <div class="col-md-3 mb-3">
        <div class="card shadow text-center p-3">
            <i class="fas fa-users fa-2x text-primary mb-2"></i>
            <h5>Usuarios</h5>
            <h3>{{ $totalUsers ?? 0 }}</h3>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow text-center p-3">
            <i class="fas fa-tasks fa-2x text-success mb-2"></i>
            <h5>Tareas</h5>
            <h3>{{ $totalTasks ?? 0 }}</h3>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow text-center p-3">
            <i class="fas fa-calendar fa-2x text-warning mb-2"></i>
            <h5>Exámenes</h5>
            <h3>{{ $totalExams ?? 0 }}</h3>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow text-center p-3">
            <i class="fas fa-chart-bar fa-2x text-info mb-2"></i>
            <h5>Activos</h5>
            <h3>{{ $activeToday ?? 0 }}</h3>
        </div>
    </div>

</div>

<!-- TABLA -->
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
                </tr>
            </thead>
            <tbody>
                @foreach($recentUsers ?? [] as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection