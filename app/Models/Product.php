<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table        = 'ref_product';
    protected $fillable = [
        'category_id', 'name', 'price'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}