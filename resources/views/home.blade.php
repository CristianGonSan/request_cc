@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">

            <div class="card-header">
                <a href="{{ route('requests.create') }}" class="btn btn-primary">
                    Nueva Solicitud
                </a>
            </div>

            <div class="card-body">

                @foreach($requests as $request)
                    @include('requests.card', $request)
                @endforeach
            </div>

            <div class="card-footer d-flex justify-content-center">
                {{ $requests->links() }}
            </div>
        </div>
    </div>
@endsection

