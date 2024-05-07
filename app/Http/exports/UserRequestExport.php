<?php

namespace App\Http\exports;

use App\Models\UserRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserRequestExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection(): Collection
    {
        $filters = request()->query();

        $query = UserRequest::select(
            DB::raw("DATE_FORMAT(user_requests.created_at, '%d-%m-%Y') as formatted_created_at"),
            'users.name as user_name',
            'user_requests.concept',
            'user_requests.cost_center',
            'user_requests.payee',
            'user_requests.amount',
            'user_requests.type',
            'user_requests.bank',
            'user_requests.card',
            'user_requests.account',
            'user_requests.branch',
            'user_requests.reference',
            'user_requests.covenant',
            'user_requests.accepted',
            DB::raw("CASE WHEN user_requests.accepted = 1 THEN 'Aceptado' ELSE 'Pendiente' END as accepted")
        )->join('users', 'user_requests.user_id', '=', 'users.id');

        if (!empty($filters)) {
            if (isset($filters['start_date'])) {
                $query->whereDate('user_requests.created_at', '>=', $filters['start_date']);
            }

            if (isset($filters['end_date'])) {
                $query->whereDate('user_requests.created_at', '<=', $filters['end_date']);
            }

            if (isset($filters['cost_center'])) {
                $query->where('user_requests.cost_center', 'LIKE', '%' . $filters['cost_center'] . '%');
            }

            if (isset($filters['user'])) {
                $query->where('users.name', 'LIKE', '%' . $filters['user'] . '%');
            }

            if (isset($filters['accepted'])) {
                $query->where('user_requests.accepted', 1);
            }
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Solicita',
            'Concepto',
            'Centro de Costos',
            'Titular',
            'Importe',
            'Tipo de Movimiento',
            'Banco',
            'Clave/Tarjeta',
            'Cuenta',
            'Sucursal',
            'Referencia',
            'Convenio',
            'Estado'
            // Agrega más columnas según sea necesario
        ];
    }

}
