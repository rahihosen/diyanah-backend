<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_name',
        'offer_type',
        'offer_amount',
        'offer_start_date',
        'offer_end_date',
        'status',
    ];
}
