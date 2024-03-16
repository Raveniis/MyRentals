<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseRental extends Model
{
    use HasFactory;

    protected $table = "house_rentals";

    protected $fillable = [
        'landowner_id',
        'name',
        'description',
        'address',
        'price',
        'maximum_occupants',
        'status'
    ];
}
