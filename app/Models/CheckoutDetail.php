<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CheckoutDetail extends Model
{
    protected $table        = 'trans_checkout_detail';
    protected $fillable = [
        'checkout_id', 'product_id','qty','price'
    ];

    public function checkout(){
        return $this->belongsTo(Checkout::class, 'checkout_id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}