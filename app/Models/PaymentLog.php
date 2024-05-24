<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'amount',
        'date'
    ];

    public function tenant() {
        return $this->hasOne(Tenant::class, 'tenant_id');
    }
}
