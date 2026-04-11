<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\NoteController;
use App\Models\Activity;
use App\Models\Note;


// Inicio
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});

// LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// REGISTER
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware('auth')->group(function () {

    // DASHBOARD SEGÚN ROL
    Route::get('/dashboard', function () {

        if(auth()->user()->role == 'admin'){
            return view('admin.dashboard');
        }

        $activities = Activity::where('user_id', auth()->id())->get();
        $notes = Note::where('user_id', auth()->id())->get();

        return view('users.dashboard', compact('activities', 'notes'));

    })->middleware('auth')->name('dashboard');

    Route::prefix('activities')->name('activities.')->group(function () {

        Route::get('/', [ActivityController::class, 'index'])->name('index');
        Route::get('/create', [ActivityController::class, 'create'])->name('create');
        Route::post('/', [ActivityController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ActivityController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ActivityController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [ActivityController::class, 'destroy'])->name('destroy');

    });

    Route::prefix('notes')->name('notes.')->group(function () {

        Route::get('/', [NoteController::class, 'index'])->name('index');
        Route::get('/create', [NoteController::class, 'create'])->name('create');
        Route::post('/', [NoteController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [NoteController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [NoteController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [NoteController::class, 'destroy'])->name('destroy');

    });

});



Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', function () {
        return redirect('/dashboard');
    });

    // CRUD USUARIOS
    Route::prefix('users')->name('users.')->group(function () {

        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('destroy');

    });

});