<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $request_id
 * @property int|null $user_id
 * @property string|null $concept
 * @property string|null $cost_center
 * @property string|null $payee
 * @property string|null $amount
 * @property string|null $type
 * @property string|null $bank
 * @property string|null $card
 * @property string|null $account
 * @property string|null $branch
 * @property string|null $reference
 * @property string|null $covenant
 * @property int $accepted
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User|null $user
 * @method static Builder|UserRequest newModelQuery()
 * @method static Builder|UserRequest newQuery()
 * @method static Builder|UserRequest query()
 * @method static Builder|UserRequest whereAccepted($value)
 * @method static Builder|UserRequest whereAccount($value)
 * @method static Builder|UserRequest whereAmount($value)
 * @method static Builder|UserRequest whereBank($value)
 * @method static Builder|UserRequest whereBranch($value)
 * @method static Builder|UserRequest whereCard($value)
 * @method static Builder|UserRequest whereConcept($value)
 * @method static Builder|UserRequest whereCostCenter($value)
 * @method static Builder|UserRequest whereCovenant($value)
 * @method static Builder|UserRequest whereCreatedAt($value)
 * @method static Builder|UserRequest wherePayee($value)
 * @method static Builder|UserRequest whereReference($value)
 * @method static Builder|UserRequest whereRequestId($value)
 * @method static Builder|UserRequest whereType($value)
 * @method static Builder|UserRequest whereUpdatedAt($value)
 * @method static Builder|UserRequest whereUserId($value)
 * @mixin \Eloquent
 */
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
