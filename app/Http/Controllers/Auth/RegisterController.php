<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Show the application registration form.
     *
     * @return View
     */
    public function showRegistrationForm()
    {
        // Aquí puedes redirigir o mostrar un error si un usuario intenta acceder al formulario de registro sin permiso
        //abort_unless(auth()->user()->is_admin, 403); // Por ejemplo, verifica si el usuario actual es un administrador

        return view('auth.register');
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
