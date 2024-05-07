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
                        <form method="POST" action="{{ route('requests.update', $request->request_id) }}" class="row g-3">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <label for="concept" class="form-label">Concepto</label>
                                <textarea type="text" class="form-control" name="concept"
                                          required> {{ $request['concept'] }} </textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="cost_center" class="form-label">Centro de Costos</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="cost_center" required
                                           value="{{ $request['cost_center'] }}">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="payee" class="form-label">Titular</label>
                                <input type="text" class="form-control" name="payee" required
                                       value="{{ $request['payee'] }}">
                            </div>
                            <div class="col-md-6">
                                <label for="amount" class="form-label">Importe</label>
                                <input type="number" class="form-control" name="amount" required
                                       value="{{ $request['amount'] }}">
                            </div>
                            <div class="col-md-6">
                                <label for="type_of_movement" class="form-label">Tipo de movimiento</label>
                                <input type="text" class="form-control" name="type" value="{{ $request['type'] }}">
                            </div>
                            <div class="col-md-3">
                                <label for="bench" class="form-label">Banco</label>
                                <input type="text" class="form-control" name="bank" value="{{ $request['bank'] }}">
                            </div>
                            <div class="col-md-5">
                                <label for="card" class="form-label">Clave/tarjeta</label>
                                <input type="text" class="form-control" name="card" value="{{ $request['card'] }}">
                            </div>
                            <div class="col-md-4">
                                <label for="account" class="form-label">Cuenta</label>
                                <input type="text" class="form-control" name="account"
                                       value="{{ $request['account'] }}">
                            </div>
                            <div class="col-md-5">
                                <label for="branch" class="form-label">Sucursal</label>
                                <input type="text" class="form-control" name="branch"
                                       value="{{ $request['branch'] }}">
                            </div>
                            <div class="col-md-7">
                                <label for="reference" class="form-label">Referencia</label>
                                <input type="text" class="form-control" name="reference"
                                       value="{{ $request['reference'] }}">
                            </div>
                            <div class="col-md-4">
                                <label for="covenant" class="form-label">Convenio</label>
                                <input type="text" class="form-control" name="covenant"
                                       value="{{ $request['covenant'] }}">
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Enviar formulario</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
