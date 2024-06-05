<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

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
        $user->is_admin = $request->has('is_admin'); // Verifica si el checkbox está marcado

        // Actualizar la contraseña si se proporciona y no está vacía
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Guardar los cambios en la base de datos
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Show the application registration form.
     *
     * @return View
     */
    public function showRegistrationForm()
    {
        // Aquí puedes redirigir o mostrar un error si un usuario intenta acceder al formulario de registro sin permiso
        //abort_unless(auth()->user()->is_admin, 403); // Por ejemplo, verifica si el usuario actual es un administrador

        return view('users.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        // Validación personalizada aquí si es necesario

        // Crear un nuevo usuario
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->is_admin = $request->has('is_admin'); // Verifica si el checkbox está marcado
        $user->save();

        // Puedes añadir lógica adicional, como enviar notificaciones o activar eventos, según tus necesidades

        return redirect()->route('users.index'); // Redirige a donde desees después del registro
    }

}
