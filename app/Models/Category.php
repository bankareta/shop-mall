<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table        = 'ref_category';
    protected $fillable = [
        'name', 'desc'
    ];

    public function product(){
        return $this->hasMany(Product::class, 'category_id');
    }
}