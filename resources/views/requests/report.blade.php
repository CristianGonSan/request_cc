@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Report') }}</div>

                    <div class="card-body">
                        <form method="GET" action="{{ route('requests.export') }}">
                            @csrf

                            <!-- Fecha de inicio -->
                            <div class="row mb-3">
                                <label for="start_date" class="col-md-4 col-form-label text-md-end">{{ __('Inicio') }}</label>

                                <div class="col-md-6">
                                    <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date', date('Y-m-d', strtotime('-1 month'))) }}" autofocus>

                                    @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Fecha de fin -->
                            <div class="row mb-3">
                                <label for="end_date" class="col-md-4 col-form-label text-md-end">{{ __('Fin') }}</label>

                                <div class="col-md-6">
                                    <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date', date('Y-m-d')) }}">

                                    @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Centro de Costos -->
                            <div class="row mb-3">
                                <label for="cost_center" class="col-md-4 col-form-label text-md-end">{{ __('Centro de Costos') }}</label>

                                <div class="col-md-6">
                                    <input id="cost_center" type="text" class="form-control @error('cost_center') is-invalid @enderror" name="cost_center" value="{{ old('cost_center') }}" autofocus>

                                    @error('cost_center')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Usuario -->
                            <div class="row mb-3">
                                <label for="user" class="col-md-4 col-form-label text-md-end">{{ __('Usuario') }}</label>

                                <div class="col-md-6">
                                    <input id="user" type="text" class="form-control @error('user') is-invalid @enderror" name="user" value="{{ old('user') }}" autofocus>

                                    @error('user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="payee" class="col-md-4 col-form-label text-md-end">{{ __('Titular') }}</label>

                                <div class="col-md-6">
                                    <input id="payee" type="text" class="form-control @error('payee') is-invalid @enderror" name="payee" value="{{ old('payee') }}" autofocus>

                                    @error('payee')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Solo Aceptados -->
                            <div class="row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('') }}</label>

                                <div class="col-md-6">
                                    <input id="status" type="checkbox" class="form-check-input" name="accepted">

                                    <label class="form-check-label" for="accepted">
                                        {{ __('Mostrar solo los aceptados') }}
                                    </label>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('') }}</label>

                                <div class="col-md-6">
                                    <input id="status" type="checkbox" class="form-check-input" name="refused">

                                    <label class="form-check-label" for="refused">
                                        {{ __('Mostrar solo los rechazados') }}
                                    </label>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('') }}</label>

                                <div class="col-md-6">
                                    <input id="status" type="checkbox" class="form-check-input" name="pending">

                                    <label class="form-check-label" for="pending">
                                        {{ __('Mostrar solo los pendientes') }}
                                    </label>
                                </div>
                            </div>

                            <!-- Botón Generar -->
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Generar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
