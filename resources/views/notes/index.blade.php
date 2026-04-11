@extends('layouts.app')

@section('content')

<h2><i class="fas fa-sticky-note"></i> Notas</h2>

<a href="{{ route('notes.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Nueva Nota
</a>

<table class="table table-striped">
    <tr>
        <th>Título</th>
        <th>Acciones</th>
    </tr>

    @foreach($notes as $n)
    <tr>
        <td>{{ $n->title }}</td>
        <td>
            <a href="{{ route('notes.edit', $n->id) }}" class="btn btn-warning btn-sm">Editar</a>
            <a href="{{ route('notes.destroy', $n->id) }}" class="btn btn-danger btn-sm">Eliminar</a>
        </td>
    </tr>
    @endforeach
</table>

@endsection