<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;


class Category extends Model
{
    use HasFactory, NodeTrait;

    protected $fillable = ['name', 'parent_id', '_lft', '_rgt','category_icon'];


    public function childs()
    {
    	return $this->hasMany(Category::class, 'parent_id', 'id')->withDefault();
    }

    public function parent()
    {
    	return $this->belongsTo(Category::class, 'parent_id','id')->withDefault();
    }
}
