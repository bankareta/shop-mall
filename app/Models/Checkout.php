<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $table        = 'trans_checkout';
    protected $fillable = [
        'user_id', 'total_amount','status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function detail(){
        return $this->hasMany(CheckoutDetail::class, 'checkout_id');
    }

    public function statusLabel(){
        $existingDate = Carbon::parse($this->created_at);
        $now = Carbon::now();
        if($existingDate->diffInHours($now) >= 3){
            return '<b style="color:black">Closed</b>';
        }
        return '<b style="color:red">Open</b>';
    }
}