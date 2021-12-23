<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_name',
        'login_id',
        'tag_id',
        'product_id',
        'created_at',
        'updated_at',
    ];
}
