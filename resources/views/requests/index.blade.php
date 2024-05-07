@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">

    <div class="container">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('requests.report') }}" class="btn btn-primary">
                    Genérar Reporte
                </a>

                <table id="miTabla">
                    <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Solicita</th>
                        <th>Concepto</th>
                        <th>CC</th>
                        <th>Titular</th>
                        <th>Monto</th>
                        <th>Tipo</th>
                        <th>Banco</th>
                        <th>Tarjeta</th>
                        <th>Cuenta</th>
                        <th>Sucursal</th>
                        <th>Referencia</th>
                        <th>Convenio</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $request)

                        @if($request->accepted)
                            <tr style="background: #198754">
                        @else
                            <tr>
                        @endif
                                <td>{{ $request->created_at->format('y-m-d') }}</td>
                                <td>{{ $request->user_name }}</td>
                                <td>{{ $request->concept }}</td>
                                <td>{{ $request->cost_center }}</td>
                                <td>{{ $request->payee }}</td>
                                <td>{{ $request->amount }}</td>
                                <td>{{ $request->type }}</td>
                                <td>{{ $request->bank }}</td>
                                <td>{{ $request->card }}</td>
                                <td>{{ $request->account }}</td>
                                <td>{{ $request->branch }}</td>
                                <td>{{ $request->reference }}</td>
                                <td>{{ $request->covenant }}</td>
                                <td>
                                    @if(!$request->accepted)
                                        <form action="{{ route('requests.accept', $request->request_id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success"
                                                    onclick="return confirm('¿Estás seguro de aceptar esta solicitud?')">
                                                <i class="fas fas fa-check"></i>
                                            </button>
                                        </form>

                                        <!-- Botón de Edición -->
                                        <a href="{{ route('requests.edit', $request->request_id) }}"
                                           class="btn btn-primary mr-2">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Botón de Eliminación (usando un formulario) -->
                                        <form action="{{ route('requests.destroy', $request->request_id) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('¿Estás seguro de eliminar esta solicitud?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @else
                                        Ya ha sido aceptado.
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>

    <script>
        $('#miTabla').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron registros - lo siento",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "search": 'Buscar',
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            columnDefs: [

            ]
        });
    </script>
@endsection
