<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'ads_image',
        'status'
    ];


    public function category()
    {
        return $this->hasMany(Category::class, 'category_id');
    }
}
