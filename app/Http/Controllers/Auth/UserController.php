<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    function destroy($id)
    {
        $userRequest = User::findOrFail($id);
        $userRequest->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

        ]);

        // Buscar al usuario por su ID
        $user = User::findOrFail($id);

        // Actualizar los campos solo si se proporcionan en la solicitud
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Actualizar la contraseña si se proporciona y no está vacía
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Guardar los cambios en la base de datos
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

}
