<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class ActivityController extends Controller
{
    public function index()
    {
        if(auth()->user()->role == 'admin'){
            $activities = Activity::with('user')->get();
        } else {
            $activities = Activity::where('user_id', auth()->id())->get();
        }

        return view('activities.index', compact('activities'));
    }

    public function create() {
        return view('activities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required',
            'time' => 'required'
        ]);

        // ADMIN
        if(auth()->user()->role == 'admin') {

            // TODOS LOS USUARIOS
            if($request->user_id == 'all') {

                $users = \App\Models\User::all();

                foreach($users as $user){
                    Activity::create([
                        'title' => $request->title,
                        'description' => $request->description,
                        'date' => $request->date,
                        'time' => $request->time,
                        'user_id' => $user->id
                    ]);
                }

            } else {

                // USUARIO ESPECÍFICO
                Activity::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'date' => $request->date,
                    'time' => $request->time,
                    'user_id' => $request->user_id
                ]);
            }

           
            $this->syncGoogle($request);

            return back()->with('success', 'Actividad asignada');
        }

        // USUARIO NORMAL
        Activity::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'time' => $request->time,
            'user_id' => auth()->id()
        ]);

       
        $this->syncGoogle($request);

        return back()->with('success', 'Actividad creada');
    }

    private function syncGoogle($request)
    {
        if(!session('google_token')) return;

        $client = new \Google_Client();
        $client->setAccessToken(session('google_token'));

        $service = new \Google_Service_Calendar($client);

        $start = date('c', strtotime($request->date . ' ' . $request->time));
        $end = date('c', strtotime($request->date . ' ' . $request->time . ' +1 hour'));

        $event = new \Google_Service_Calendar_Event([
            'summary' => $request->title,
            'description' => $request->description,
            'start' => [
                'dateTime' => $start,
                'timeZone' => 'America/Mexico_City',
            ],
            'end' => [
                'dateTime' => $end,
                'timeZone' => 'America/Mexico_City',
            ],
        ]);

        $service->events->insert('primary', $event);
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
