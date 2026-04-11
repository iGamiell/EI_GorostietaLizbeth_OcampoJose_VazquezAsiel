<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // LISTAR
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // FORM CREAR
    public function create()
    {
        return view('users.create');
    }

    // GUARDAR
    public function store(Request $request)
    {
        try {

            // VALIDACIÓN
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'role' => 'required'
            ], [
                'name.required' => 'El nombre es obligatorio',
                'email.required' => 'El correo es obligatorio',
                'email.email' => 'El correo no es válido',
                'email.unique' => 'Este correo ya está registrado',
                'password.required' => 'La contraseña es obligatoria',
                'password.min' => 'La contraseña debe tener al menos 6 caracteres',
                'role.required' => 'El rol es obligatorio'
            ]);

            $mensaje = 'Usuario creado correctamente';

            if($request->role == 'admin') {
                $mensaje = 'Usuario creado como ADMIN (cuidado)';
            }

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);

            return redirect('/users')->with('success', $mensaje);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);

            return redirect('/users')->with('success', 'Usuario creado correctamente');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // FORM EDITAR
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        try {

            $user = User::findOrFail($id);

            // VALIDACIÓN
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'role' => 'required'
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role
            ]);

            return redirect('/users')->with('success', 'Usuario actualizado correctamente');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar usuario');
        }
    }

    // ELIMINAR
    public function destroy($id)
    {
        try {

            User::destroy($id);

            return redirect('/users')->with('success', 'Usuario eliminado correctamente');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar usuario');
        }
    }
}
