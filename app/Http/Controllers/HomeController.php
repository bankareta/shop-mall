<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Checkout;
use App\Models\CheckoutDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome',[
            'category' => Category::get(),
            'product' => Product::get(),
        ]);
    }

    public function product()
    {
        return view('product',[
            'category' => Category::get(),
            'product' => Product::get(),
        ]);
    }
    
    public function listCart()
    {
        return view('list-cart',[
            'record' => Cart::where('user_id',Auth::user()->id)->get(),
        ]);
    }
    
    public function history()
    {
        return view('history',[
            'record' => Checkout::where('user_id',Auth::user()->id)->get(),
            'recordDetail' => CheckoutDetail::whereHas('checkout',function($q){
                $q->where('user_id',Auth::user()->id);
            })->get(),
        ]);
    }
    
    public function addCart($id)
    {
        $recordCheck = Cart::where('user_id',Auth::user()->id)->where('product_id',$id)->first();
        if($recordCheck){
            $record = Cart::find($recordCheck->id);
            $record->qty = $recordCheck->qty + 1;
            $record->save();
        }else{
            $record = new Cart;
            $record->fill([
                'user_id' => Auth::user()->id,
                'product_id' => $id,
                'qty' =>1
            ]);
            $record->save();
        }
        return response([
            'status' => true,
            'data' => Cart::where('user_id',Auth::user()->id)->sum('qty'),
        ]);
    }

    public function getCountCart()
    {
        if(Auth::user()){
            $total = Cart::where('user_id',Auth::user()->id)->sum('qty');
        }else{
            $total = 0;
        }
        return response([
            'status' => true,
            'data' => $total,
        ]);
    }
    
    public function customQty($id,$type)
    {
        $remove = false;
        $price = 0;
        $record = Cart::find($id);
        if($type == 'min'){
            if($record->qty == 1){
                $record->delete();
                $remove = true;
            }else{
                $record->qty = $record->qty - 1;
                $record->save();
            $price = number_format($record->product->price * $record->qty, 0, ',', '.');
            }
        }else{
            $record->qty = $record->qty + 1;
            $record->save();
            $price = number_format($record->product->price * $record->qty, 0, ',', '.');
        }
        return response([
            'status' => true,
            'price' => 'Rp '.$price,
            'remove' => $remove,
            'total' => Cart::where('user_id',Auth::user()->id)->sum('qty')
        ]);
    }
    
    public function removeCart($id)
    {
        $record = Cart::find($id);
        $record->delete();

        return response([
            'status' => true,
            'total' => Cart::where('user_id',Auth::user()->id)->sum('qty')
        ]);
    }
    
    public function calculateCart(Request $request)
    {
        $total_price = 0;
        $total_product = 0;
        $total_qty = 0;
        $coupon_product = 0;
        $coupon_checkout = 0;
        $total = 0;
        if (isset($request->cart_id)) {
            $record = Cart::whereIn('id',$request->cart_id)->get();
            if ($record->count() > 0) {
                foreach ($record as $key => $value) {
                    $total_price += $value->product->price * $value->qty;
                    if($value->product->price * $value->qty > 50000){
                        $coupon_product += 1;
                    }
                }
                if($total_price > 100000){
                    $coupon_checkout = 1;
                }
                $total = $total_price;
                $total_price = number_format($total_price, 0, ',', '.');
                $total_product = $record->count();
                $total_qty = $record->sum('qty');
            }
        }
        return response([
            'status' => true,
            'total_product' => $total_product,
            'total_qty' => $total_qty,
            'total_price' => 'Rp '.$total_price,
            'coupon_product' => $coupon_product,
            'coupon_checkout' => $coupon_checkout,
            'coupon_total' => $coupon_product + $coupon_checkout,
            'total' => $total
        ]);
    }
    
    public function checkoutCart(Request $request)
    {
        $record = new Checkout;
        $record->fill([
            'user_id' => Auth::user()->id,
            'total_amount' => $request->total,
        ]);
        $record->save();

        $cart = Cart::whereIn('id',$request->cart_id)->get();
        foreach ($cart as $key => $value) {
            $recordDetail = new CheckoutDetail;
            $recordDetail->fill([
                'checkout_id' => $record->id,
                'product_id' => $value->product_id,
                'qty' => $value->qty,
                'price' => $value->product->price,
            ]);
            $recordDetail->save();
            $value->delete();
        }
        return response([
            'status' => true,
        ]);
    }
}
