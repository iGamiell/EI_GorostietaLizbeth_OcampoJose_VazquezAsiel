<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar vista login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'Debe ser un correo válido',
            'password.required' => 'La contraseña es obligatoria'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();

            return redirect('/dashboard')
                ->with('success', 'Bienvenido ' . auth()->user()->name);
        }

        return back()->with('error', 'Credenciales incorrectas');
    }

    // Mostrar registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ], [
            'name.required' => 'El nombre es obligatorio',
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'Correo inválido',
            'email.unique' => 'Este correo ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'Mínimo 6 caracteres'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        Auth::login($user);

        return redirect('/dashboard')
            ->with('success', 'Cuenta creada correctamente, bienvenido ' . $user->name);
    }

    // Logout
    public function logout(Request $request)
    {
        session()->forget('google_token');

        Auth::logout();

        $request->session()->invalidate(); 
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Sesión cerrada correctamente');
    }
}