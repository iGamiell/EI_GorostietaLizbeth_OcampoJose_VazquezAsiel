<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function index() {

        if(auth()->user()->role == 'admin'){
            $activities = Activity::all();
        } else {
            $activities = Activity::where('user_id', auth()->id())->get();
        }

        return view('activities.index', compact('activities'));
    }

    public function create() {
        return view('activities.create');
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required'
        ], [
            'title.required' => 'El título es obligatorio'
        ]);

        Activity::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id()
        ]);

        return redirect('/activities')->with('success', 'Actividad creada');
    }

    public function edit($id) {
        $activity = Activity::findOrFail($id);
        return view('activities.edit', compact('activity'));
    }

    public function update(Request $request, $id) {

        $request->validate([
            'title' => 'required'
        ]);

        $activity = Activity::findOrFail($id);
        $activity->update($request->all());

        return redirect('/activities')->with('success', 'Actividad actualizada');
    }

    public function destroy($id) {
        Activity::destroy($id);
        return redirect('/activities')->with('success', 'Actividad eliminada');
    }
}
