<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantApplication extends Model
{
    use HasFactory;

    protected $table ="tenant_applications";

    protected $fillable = [
        'tenant_id',
        'rental_id',
        'occupants_number',
        'move_in_date',
        'lease_term',
        'monthly_income',
        'employment_status',
        'application_status',
        'remarks'
    ];

    public function tenant() {
        return $this->hasOne(Tenant::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function houseRental() {
        return $this->belongsTo(houseRental::class, 'rental_id');
    }
}
