<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    protected $table = 'user_requests';
    protected $primaryKey = 'request_id';
    protected $fillable = [
        'user_id',
        'concept',
        'cost_center',
        'payee',
        'amount',
        'type',
        'bench',
        'card',
        'account',
        'branch',
        'reference',
        'covenant'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
