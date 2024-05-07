<?php

namespace App\Http\Controllers;

use App\Http\exports\UserRequestExport;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class UserRequestController extends Controller
{
    public function index()
    {
        $requests = UserRequest::select('user_requests.*', 'users.name as user_name')
            ->join('users', 'user_requests.user_id', '=', 'users.id')
            ->get();

        return view('requests.index', compact('requests'));
    }

    public function create()
    {
        return view('requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // Validación de campos aquí según tus necesidades
        ]);

        $userRequest = new UserRequest($request->all());
        $userRequest->user_id = Auth::id(); // Asignar el ID del usuario

        $userRequest->save();

        Session::flash('message', 'Solicitud creada correctamente');
        Session::flash('type', 'success');

        if (Auth::user()->is_admin) {
            return redirect()->route('requests.index')
                ->with('success', 'Solicitud creada exitosamente.');
        }

        return redirect()->route('home')
            ->with('success', 'Solicitud creada exitosamente.');
    }

    public function show($id)
    {
        $userRequest = UserRequest::findOrFail($id);
        return view('requests.show', compact('userRequest'));
    }

    public function edit($id)
    {
        $request = UserRequest::findOrFail($id);
        return view('requests.edit', compact('request'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // Validación de campos aquí según tus necesidades
        ]);

        $userRequest = UserRequest::findOrFail($id);
        $userRequest->update($request->all());

        return redirect()->route('requests.index')
            ->with('success', 'Solicitud actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $userRequest = UserRequest::findOrFail($id);
        $userRequest->delete();

        return redirect()->route('requests.index')
            ->with('success', 'Solicitud eliminada exitosamente.');
    }

    public function accept($id)
    {
        $userRequest = UserRequest::findOrFail($id);
        $userRequest->accepted = 1;
        $userRequest->save();

        return redirect()->route('requests.index')
            ->with('success', 'Solicitud actualizada exitosamente.');
    }

    public function report()
    {
        return view('requests.report');
    }

    public function export()
    {
        return Excel::download(new UserRequestExport(), 'Solicitudes.xlsx');
    }
}

