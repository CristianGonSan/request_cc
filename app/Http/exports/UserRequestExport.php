<?php

namespace App\Http\exports;

use App\Models\UserRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
            ['user_requests.request_id',
                DB::raw("DATE_FORMAT(user_requests.created_at, '%d-%m-%Y') as formatted_created_at"),
                'users.name as user_name',
                'user_requests.concept',
                'user_requests.cost_center',
                'user_requests.payee',
                'user_requests.amount',
                'user_requests.type',
                'user_requests.bank',
                'user_requests.card',
                DB::raw("CAST(user_requests.account AS CHAR) as account"),
                'user_requests.branch',
                'user_requests.reference',
                'user_requests.covenant',
                'user_requests.status',
                DB::raw("CASE
                        WHEN user_requests.status = 1 THEN 'Aceptado'
                        WHEN user_requests.status = 2 THEN 'Rechazado'
                        ELSE 'Pendiente'
                        END as status"),
                'user_requests.note']
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

            if (isset($filters['payee'])) {
                $query->where('user_requests.payee', 'LIKE', '%' . $filters['payee'] . '%');
            }

            if (isset($filters['accepted'])) {
                $query->where('user_requests.status', 1);
            }

            if (isset($filters['refused'])) {
                $query->where('user_requests.status', 2);
            }

            if (isset($filters['pending'])) {
                $query->where('user_requests.status', 0);
            }
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No.',
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
            'Estado',
            'Nota'
            // Agrega más columnas según sea necesario
        ];
    }

}
