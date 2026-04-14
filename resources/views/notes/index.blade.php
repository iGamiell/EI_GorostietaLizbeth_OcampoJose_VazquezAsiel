@extends('layouts.app')

@section('content')

<h2><i class="fas fa-sticky-note"></i> Notas</h2>

<a href="{{ route('notes.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Nueva Nota
</a>

<table class="table table-striped">
    <tr>
        <th>Usuario</th>
        <th>Título</th>
        <th>Acciones</th>
        
    </tr>

    @foreach($notes as $n)
    <tr>
        <td>{{ $n->user->name ?? 'N/A' }}</td>
        <td>{{ $n->title }}</td>
        <td>
            <a href="/notes/edit/{{ $n->id }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i>
            </a>

            <form action="{{ route('notes.destroy', $n->id) }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
    </tr>
    @endforeach
</table>

@endsection