@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <form action="{{ route('requests.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" value="{{$search ?? ''}}"
                               placeholder="Buscar...">
                        <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
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
