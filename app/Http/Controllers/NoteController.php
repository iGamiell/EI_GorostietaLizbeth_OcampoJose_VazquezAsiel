<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    // LISTAR
    public function index()
    {
        if(auth()->user()->role == 'admin'){
            $notes = Note::all();
        } else {
            $notes = Note::where('user_id', auth()->id())->get();
        }

        return view('notes.index', compact('notes'));
    }

    // FORM CREAR
    public function create()
    {
        return view('notes.create');
    }

    // GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ], [
            'title.required' => 'El título es obligatorio',
            'content.required' => 'El contenido es obligatorio'
        ]);

        Note::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id()
        ]);

        return redirect('/notes')->with('success', 'Nota creada correctamente');
    }

    // FORM EDITAR
    public function edit($id)
    {
        $note = Note::findOrFail($id);
        return view('notes.edit', compact('note'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ], [
            'title.required' => 'El título es obligatorio',
            'content.required' => 'El contenido es obligatorio'
        ]);

        $note = Note::findOrFail($id);

        $note->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect('/notes')->with('success', 'Nota actualizada correctamente');
    }

    // ELIMINAR
    public function destroy($id)
    {
        Note::destroy($id);
        return redirect('/notes')->with('success', 'Nota eliminada correctamente');
    }
}