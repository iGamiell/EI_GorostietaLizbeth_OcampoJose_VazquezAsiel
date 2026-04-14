<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\GoogleController;
use App\Models\User;
use App\Models\Activity;
use App\Models\Note;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/google/redirect', [GoogleController::class, 'redirect']);
    Route::get('/google/callback', [GoogleController::class, 'callback']);

    Route::get('/dashboard', function () {

        if(auth()->user()->role == 'admin'){

            $totalUsers = User::count();
            $totalActivities = Activity::count();
            $totalNotes = Note::count();

            $recentUsers = User::latest()->take(5)->get();

            return view('admin.dashboard', compact(
                'totalUsers',
                'totalActivities',
                'totalNotes',
                'recentUsers'
            ));
        }

        $activities = Activity::where('user_id', auth()->id())
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        $notes = Note::where('user_id', auth()->id())->get();

        $totalActivities = $activities->count();
        $totalNotes = $notes->count();

        return view('users.dashboard', compact(
            'activities',
            'notes',
            'totalActivities',
            'totalNotes'
        ));

    })->name('dashboard');

    Route::prefix('activities')->name('activities.')->group(function () {

        Route::get('/', [ActivityController::class, 'index'])->name('index');
        Route::get('/create', [ActivityController::class, 'create'])->name('create');
        Route::post('/', [ActivityController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ActivityController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ActivityController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [ActivityController::class, 'destroy'])->name('destroy');

    });

    Route::prefix('notes')->name('notes.')->group(function () {

        Route::get('/', [NoteController::class, 'index'])->name('index');
        Route::get('/create', [NoteController::class, 'create'])->name('create');
        Route::post('/', [NoteController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [NoteController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [NoteController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [NoteController::class, 'destroy'])->name('destroy');

    });

});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', function () {
        return redirect('/dashboard');
    });

    Route::prefix('users')->name('users.')->group(function () {

        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::post('/delete/{id}', [UserController::class, 'destroy'])->name('destroy');

    });

});

