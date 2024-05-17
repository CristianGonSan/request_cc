<div class="mb-3 border-bottom pb-3">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <span
                class="fw-bold">{{ $request->created_at->format('Y-m-d') }} | {{ $request->user_name }} | ${{ $request->amount }}</span>
        </div>
        <div>
            <button class="btn btn-primary" data-bs-toggle="offcanvas"
                    data-bs-target="#p{{ $request->request_id }}">
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </div>
    <div class="mb-2">{{ Str::limit($request->concept, 200) }}</div>
    @if($request->status == 0)
        <div class="text-warning">Pendiente</div>
    @elseif($request->status == 1)
        <div class="text-success">Aceptada</div>
    @elseif($request->status == 2)
        <div class="text-danger">Rechazada</div>
    @endif
</div>

@if(Auth::user()->is_admin)
    <div class="modal fade" id="note{{$request->request_id}}" aria-labelledby="addNoteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="an{{ $request->request_id }}">Agregar Nota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('requests.note', $request->request_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <textarea class="form-control" name="note" rows="4">{{ $request->note }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Nota</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="offcanvas offcanvas-end" id="p{{ $request->request_id }}">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title d-inline-block">Solicitud #{{ $request->request_id }}</h5>
        <div class="d-inline-block ms-auto">
            @if($request->status == 1)
                <p class="text-success m-2">Aceptada</p>
            @elseif($request->status == 2)
                <div class="text-danger m-2">Rechazada</div>
            @else
                <div class="dropdown d-inline-block">
                    <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <i class="fas fa-bars"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        @if(Auth::user()->is_admin)
                            <li>
                                <form action="{{ route('requests.accept', $request->request_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="dropdown-item" type="submit"
                                            onclick="return confirm('¿Estás seguro de aceptar esta solicitud?')">
                                        <i class="fa-solid fa-check"></i> Aceptar
                                    </button>
                                </form>
                            </li>
                            <li>
                                <form action="{{ route('requests.decline', $request->request_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="dropdown-item" type="submit"
                                            onclick="return confirm('¿Estás seguro de rechazar esta solicitud?')">
                                        <i class="fa-solid fa-xmark"></i> Rechazar
                                    </button>
                                </form>
                            </li>
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{ route('requests.edit', $request->request_id) }}">
                                <i class="fas fa-edit me-1"></i> Editar
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('requests.destroy', $request->request_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item" type="submit"
                                        onclick="return confirm('¿Estás seguro de eliminar esta solicitud?')">
                                    <i class="fas fa-trash-alt me-1"></i> Eliminar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
        <button type="button" class="btn btn-primary" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="fa fa-arrow-left"></i></button>
    </div>

    <div class="offcanvas-body">
        <div class="group-info">
            <h6 class="mb-3">Datos del Solicitante:</h6>
            <div class="info-item"><strong>Fecha de
                    Solicitud:</strong> {{ $request->created_at }}</div>
            <div class="info-item"><strong>Nombre del
                    Solicitante:</strong> {{ $request->user_name }}</div>
        </div>
        <hr>
        <div class="group-info">
            <h6 class="mb-3">Detalles Financieros:</h6>
            <div class="info-item"><strong>Concepto:</strong> {{ $request->concept }}</div>
            <div class="info-item"><strong>Centro de Costo:</strong> {{ $request->cost_center }}
            </div>
            <div class="info-item"><strong>Titular:</strong> {{ $request->payee }}</div>
            <div class="info-item"><strong>Importe:</strong> ${{ $request->amount }}</div>
            <div class="info-item"><strong>Tipo:</strong> {{ $request->type }}</div>
        </div>
        <hr>
        <div class="group-info">
            <h6 class="mb-3">Detalles Bancarios:</h6>
            <div class="info-item"><strong>Banco:</strong> {{ $request->bank }}</div>
            <div class="info-item"><strong>Clave de Tarjeta:</strong> {{ $request->card }}</div>
            <div class="info-item"><strong>Cuenta:</strong> {{ $request->account }}</div>
            <div class="info-item"><strong>Sucursal:</strong> {{ $request->branch }}</div>
            <div class="info-item"><strong>Referencia:</strong> {{ $request->reference }}</div>
            <div class="info-item"><strong>Convenio:</strong> {{ $request->covenant }}</div>
        </div>
        <hr>
        <div class="group-info">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6>Notas:</h6>
                @if(Auth::user()->is_admin)
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#note{{$request->request_id}}" title="Editar notas">
                        <i class="fas fa-edit"></i>
                    </button>
                @endif
            </div>
            <div class="info-item">{{ $request->note ?: 'No hay notas disponibles' }}</div>
        </div>

    </div>
</div>
