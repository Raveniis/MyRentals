<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalReview extends Model
{
    use HasFactory;

    protected $table = "rental_reviews";

    protected $fillable = [
        'reviewed_by',
        'rental_id',
        'ratings',
        'comment'
    ];
}
