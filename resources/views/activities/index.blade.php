@extends('layouts.app')

@section('content')

<h2><i class="fas fa-tasks"></i> Actividades</h2>

<a href="{{ route('activities.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Nueva
</a>

<table class="table table-striped">
    <tr>
        <th>Usuario</th>
        <th>Título</th>
        <th>Acciones</th>
    </tr>

    @foreach($activities as $a)
    <tr>
        <td>{{ $a->user->name ?? 'N/A' }}</td>
        <td>{{ $a->title }}</td>
        <td>
            <a href="/activities/edit/{{ $a->id }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i>
            </a>

            <form action="{{ route('activities.destroy', $a->id) }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
    </tr>
    @endforeach
</table>

@endsection