<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'offer_id',
        'created_at',
    ];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    public function offer(){
        return $this->hasOne(Offer::class, 'id', 'offer_id');
    }
}
