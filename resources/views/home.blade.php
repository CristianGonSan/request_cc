@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4 justify-content-center">

            @include('layouts.cards.text-card', [
                'route' => route('requests.create'),
                'header' => 'Solicitud',
                'title' => 'Nueva Solicitud',
                'text' => 'Llene el formulario realizar una nueva solicitud de Centros de Costos'
            ])

            @if( Auth::user()->is_admin)
                @include('layouts.cards.text-card', [
                'route' => route('users.index'),
                'header' => 'Usuarios',
                'title' => 'Gestión de Usuarios',
                'text' => 'Gestione a los usuarios para que puedan acceder.'
                ])

                @include('layouts.cards.text-card', [
                'route' => route('requests.index'),
                'header' => 'Solicitudes',
                'title' => 'Gestión de Solicitudes',
                'text' => 'Gestione las solicitudes.'
                ])
            @endif

        </div>
    </div>
@endsection

