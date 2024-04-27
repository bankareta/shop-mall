@extends('layouts.base')
@section('banner')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>
@endsection
@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Cart List</h1>
        <form action="#">
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-8">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Products</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($record as $item)
                                    <tr class="list-cart-{{$item->id}}">
                                        <td style="width: 10%">
                                            <div class="form-check mb-0 mt-4">
                                                <input class="form-check-input choiceCart" name="cart[]" type="checkbox" value="{{ $item->id }}" id="flexCheckDefault">
                                            </div>
                                        </td>
                                        <th scope="row">
                                            <div class="d-flex align-items-center">
                                                <img src="img/vegetable-item-3.png" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                            </div>
                                        </th>
                                        <td>
                                            <p class="mb-0 mt-4">{{ $item->product->name }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 mt-4">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                        </td>
                                        <td>
                                            <div class="input-group quantity mt-4" style="width: 100px;">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border custom-qty" data-type="min" data-id="{{ $item->id }}">
                                                    <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" class="form-control form-control-sm text-center border-0" value="{{ $item->qty }}">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border custom-qty" data-type="plus" data-id="{{ $item->id }}">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="mb-0 mt-4 sum-product-{{ $item->id }}">Rp {{ number_format($item->product->price * $item->qty, 0, ',', '.') }}</p>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-md rounded-circle bg-light border mt-4 remove-cart" data-id="{{ $item->id }}">
                                                <i class="fa fa-times text-danger"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="row g-4 justify-content-end">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Coupon <span class="fw-normal">Gift</span></h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Product ^50k:</h5>
                                    <div class="coupon-product">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0 me-4">Checkout ^100K:</h5>
                                    <div class="coupon-checkout">
                                    </div>
                                </div>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total Coupon</h5>
                                <p class="mb-0 pe-4 total-coupon">0 Coupon</p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row g-4 justify-content-end">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Total Product:</h5>
                                    <p class="mb-0 total-product">0</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0 me-4">Total QTY</h5>
                                    <p class="mb-0 total-qty">0</p>
                                </div>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total Payment</h5>
                                <p class="mb-0 pe-4 total-price">0</p>
                            </div>
                            <input type="hidden" class="total">
                            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button" id="submit-checkout">Proceed Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection