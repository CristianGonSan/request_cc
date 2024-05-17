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
        $requests = UserRequest::select(['user_requests.*', 'users.name as user_name'])
            ->join('users', 'user_requests.user_id', '=', 'users.id')
            ->orderBy('user_requests.created_at', 'desc') // Ordenar por fecha de creación en orden descendente
            ->paginate(10);

        return view('requests.index', compact('requests'));
    }

    public function user_home()
    {
        $requests = UserRequest::select(['user_requests.*', 'users.name as user_name'])
            ->join('users', 'user_requests.user_id', '=', 'users.id')
            ->orderBy('user_requests.created_at', 'desc')
            ->where('user_id', Auth::user()->id)
            ->paginate(10);

        return view('home', compact('requests'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $query = UserRequest::select(['user_requests.*', 'users.name as user_name'])
            ->join('users', 'user_requests.user_id', '=', 'users.id')
            ->orderBy('user_requests.created_at', 'desc');

        if (isset($search)) {
            $query->where('user_requests.concept', 'LIKE', '%' . $search . '%');
        }

        $requests = $query->paginate(10);

        return view('requests.index', compact('requests', 'search'));
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

        // Verificar si el usuario autenticado es el creador de la solicitud o es un administrador
        if ($request->user_id !== Auth::id() && !Auth::user()->is_admin) {
            // Si el usuario no es el creador de la solicitud y tampoco es administrador, redirigir o mostrar un mensaje de error
            return redirect()->back()->with('error', 'No tienes permiso para editar esta solicitud.');
        }

        return view('requests.edit', compact('request'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // Validación de campos aquí según tus necesidades
        ]);

        $userRequest = UserRequest::findOrFail($id);
        $userRequest->update($request->all());

        return redirect()->back()
            ->with('success', 'Solicitud actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $userRequest = UserRequest::findOrFail($id);
        $userRequest->delete();

        return redirect()->back()
            ->with('success', 'Solicitud eliminada exitosamente.');
    }

    public function accept($id)
    {
        $userRequest = UserRequest::findOrFail($id);
        $userRequest->status = 1;
        $userRequest->save();

        return redirect()->back()
            ->with('success', 'Solicitud actualizada exitosamente.');
    }

    public function decline($id)
    {
        $userRequest = UserRequest::findOrFail($id);
        $userRequest->status = 2;
        $userRequest->save();

        return redirect()->back()
            ->with('success', 'Solicitud actualizada exitosamente.');
    }

    public function note(Request $request, $id)
    {
        $userRequest = UserRequest::findOrFail($id);
        $userRequest->note = $request->input('note');
        $userRequest->save();

        return redirect()->back()
            ->with('success', 'Nota actualizada exitosamente.');
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

