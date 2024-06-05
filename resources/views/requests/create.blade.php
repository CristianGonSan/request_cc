@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Formulario') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('requests.store') }}" class="row g-3">
                            @csrf
                            <div class="col-md-12">
                                <label for="concept" class="form-label">Concepto</label>
                                <textarea type="text" class="form-control" name="concept" required></textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="cost_center" class="form-label">Centro de Costos</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="cost_center" required>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="payee" class="form-label">Titular</label>
                                <input type="text" class="form-control" name="payee" required>
                            </div>
                            <div class="col-md-6">
                                <label for="amount" class="form-label">Importe</label>
                                <input type="number" class="form-control" step="0.01" name="amount" id="amount" required>
                            </div>
                            <div class="col-md-6">
                                <label for="type_of_movement" class="form-label">Tipo de movimiento</label>
                                <select class="form-select" name="type">
                                    <option value="Corporativo">Corporativo</option>
                                    <option value="Personal">Personal</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="bench" class="form-label">Banco</label>
                                <input type="text" class="form-control" name="bank">
                            </div>
                            <div class="col-md-5">
                                <label for="card" class="form-label">Clave/tarjeta</label>
                                <input type="text" class="form-control" name="card">
                            </div>
                            <div class="col-md-4">
                                <label for="account" class="form-label">Cuenta</label>
                                <input type="text" class="form-control" name="account">
                            </div>
                            <div class="col-md-5">
                                <label for="branch" class="form-label">Sucursal</label>
                                <input type="text" class="form-control" name="branch">
                            </div>
                            <div class="col-md-7">
                                <label for="reference" class="form-label">Referencia</label>
                                <input type="text" class="form-control" name="reference">
                            </div>
                            <div class="col-md-4">
                                <label for="covenant" class="form-label">Convenio</label>
                                <input type="text" class="form-control" name="covenant">
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
