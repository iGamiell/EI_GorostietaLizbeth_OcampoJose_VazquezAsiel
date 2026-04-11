@extends('layouts.app')

@section('content')

<h2><i class="fas fa-tasks"></i> Actividades</h2>

<a href="{{ route('activities.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Nueva
</a>

<table class="table table-striped">
    <tr>
        <th>Título</th>
        <th>Acciones</th>
    </tr>

    @foreach($activities as $a)
    <tr>
        <td>{{ $a->title }}</td>
        <td>
            <a href="{{ route('activities.edit', $a->id) }}" class="btn btn-warning btn-sm">Editar</a>
            <a href="{{ route('activities.destroy', $a->id) }}" class="btn btn-danger btn-sm">Eliminar</a>
        </td>
    </tr>
    @endforeach
</table>

@endsection