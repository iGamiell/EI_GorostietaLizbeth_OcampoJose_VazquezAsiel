@extends('layouts.app')

@section('title', 'Dashboard Usuario')

@section('content')

<h2 class="mb-4">
    <i class="fas fa-user"></i> Mi Panel
</h2>

<div class="row">

    <div class="col-md-6 mb-3">
        <div class="card shadow text-center p-4">
            <i class="fas fa-tasks fa-2x mb-2 text-primary"></i>
            <h5>Tareas Pendientes</h5>
            <h3>{{ $pendingTasks ?? 0 }}</h3>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card shadow text-center p-4">
            <i class="fas fa-calendar fa-2x mb-2 text-warning"></i>
            <h5>Exámenes</h5>
            <h3>{{ $upcomingExams ?? 0 }}</h3>
        </div>
    </div>

</div>

<div class="d-flex justify-content-between align-items-center mb-2">
    <h4><i class="fas fa-tasks"></i> Mis Actividades</h4>
    
    <a href="/activities/create" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Nueva
    </a>
</div>

<div class="d-flex justify-content-between align-items-center mb-2 mt-4">
    <h4><i class="fas fa-sticky-note"></i> Mis Notas</h4>

    <a href="/notes/create" class="btn btn-success btn-sm">
        <i class="fas fa-plus"></i> Nueva
    </a>
</div>

<hr>

<h4><i class="fas fa-tasks"></i> Mis Actividades</h4>

@if($activities->isEmpty())
    <p class="text-muted">No tienes actividades</p>
@else
    <ul class="list-group mb-4">
        @foreach($activities as $a)
            <li class="list-group-item">
                {{ $a->title }}
            </li>
        @endforeach
    </ul>
@endif

<h4><i class="fas fa-sticky-note"></i> Mis Notas</h4>

@if($notes->isEmpty())
    <p class="text-muted">No tienes notas</p>
@else
    <ul class="list-group">
        @foreach($notes as $n)
            <li class="list-group-item">
                <strong>{{ $n->title }}</strong><br>
                <small>{{ $n->content }}</small>
            </li>
        @endforeach
    </ul>
@endif

@endsection