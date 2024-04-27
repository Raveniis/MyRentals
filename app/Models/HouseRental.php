<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseRental extends Model
{
    use HasFactory;

    protected $table = "house_rentals";

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'monthly_rent',
        'maximum_occupants',
        'status',
        'image',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function rentalReviews() {
        return $this->hasMany(RentalReview::class, 'rental_id');
    }

    public function tenantApplications() {
        return $this->hasMany(TenantApplication::class);
    }

    public function tenants() {
        return $this->hasMany(Tenant::class);
    }
}
