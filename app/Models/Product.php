<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_slug',
        'product_code',
        'product_quantity',
        'product_price',
        'product_description',
        'product_image',
        'status',
        'login_id',
        'unit_id',
        'category_id',
        'offer_id',
        'deleted_at',
        'created_at',
        'updated_at',
    ];


}
