<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'remarks',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tenantApplication() {
        return $this->belongsTo(TenantApplication::class, 'application_id');
    }

    // public function houseRental() {
    //     return $this->belongsTo(HouseRental::class);
    // }
}
