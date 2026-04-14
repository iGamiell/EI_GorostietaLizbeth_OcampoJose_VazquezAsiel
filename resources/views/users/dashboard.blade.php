@extends('layouts.app')

@section('title', 'Dashboard Usuario')

@section('content')

<h2 class="mb-4">
    <i class="fas fa-user"></i> Mi Panel
</h2>

<!-- CONTADORES -->
<div class="row">

    <div class="col-md-6 mb-3">
        <div class="card shadow text-center p-4">
            <i class="fas fa-tasks fa-2x mb-2 text-primary"></i>
            <h5>Actividades</h5>
            <h3>{{ $totalActivities }}</h3>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card shadow text-center p-4">
            <i class="fas fa-sticky-note fa-2x mb-2 text-warning"></i>
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

<!-- ACTIVIDADES -->
<div class="d-flex justify-content-between align-items-center mt-4 mb-2">
    <h4><i class="fas fa-calendar"></i> Mis Actividades</h4>

    <a href="/activities/create" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Nueva
    </a>
</div>

<div class="row">
@forelse($activities as $a)
    <div class="col-md-4 mb-3">
        <div class="card shadow">
            <div class="card-body">

                <h5>{{ $a->title }}</h5>

                <p class="text-muted">
                    <i class="fas fa-calendar"></i> {{ $a->date }}
                    <br>
                    <i class="fas fa-clock"></i> {{ $a->time }}
                </p>

                <small>{{ $a->description }}</small>

                <!-- BOTONES -->
                <div class="mt-3 d-flex justify-content-between">

                    <a href="/activities/edit/{{ $a->id }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form action="{{ route('activities.destroy', $a->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>
@empty
    <p class="text-muted">No tienes actividades</p>
@endforelse
</div>

<!-- NOTAS -->
<div class="d-flex justify-content-between align-items-center mt-4 mb-2">
    <h4><i class="fas fa-sticky-note"></i> Mis Notas</h4>

    <a href="/notes/create" class="btn btn-success btn-sm">
        <i class="fas fa-plus"></i> Nueva
    </a>
</div>

<ul class="list-group">
@forelse($notes as $n)
    <li class="list-group-item d-flex justify-content-between align-items-center">

        <div>
            <strong>{{ $n->title }}</strong><br>
            <small>{{ $n->content }}</small>
        </div>

        <div class="d-flex gap-2">

            <a href="/notes/edit/{{ $n->id }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i>
            </a>

            <form action="{{ route('notes.destroy', $n->id) }}" method="POST">
                @csrf
                <button class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                </button>
            </form>

        </div>

    </li>
@empty
    <li class="list-group-item text-muted">No tienes notas</li>
@endforelse
</ul>

@endsection