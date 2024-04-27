@extends('layouts.base')
@section('banner')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">History Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active text-white">History</li>
        </ol>
    </div>
@endsection
@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Billing details</h1>
        <div class="row g-5">
            <div class="col-md-12 col-lg-6 col-xl-7">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Date Checkout</th>
                                <th scope="col">Total Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($record as $item)
                                <tr class="list-checkout list-checkout-{{$item->id}} {!! $loop->first ? 'bg-primary':'' !!}">
                                    <td class="py-5">{{ $item->created_at }}</td>
                                    <td class="py-5">{{ $item->detail->count() }} Product</td>
                                    <td class="py-5">Rp {{ number_format($item->total_amount, 0, ',', '.') }}</td>
                                    <td class="py-5">{!! $item->statusLabel() !!}</td>
                                    <td class="py-5"><span type="submit" class="list-data" data-id="{{ $item->id }}"><small class="me-3"><i class="fas fa-eye me-2 text-primary"></i></small></span></td>
                                </tr>
                                @php
                                    $total += $item->total_amount;
                                @endphp
                            @endforeach
                            <tr>
                                <th scope="row">
                                </th>
                                <td class="py-5">
                                    <p class="mb-0 text-dark py-3">Total</p>
                                </td>
                                <td class="py-5">
                                    <div class="py-3 border-bottom border-top">
                                        <p class="mb-0 text-dark">Rp {{ number_format($total, 0, ',', '.') }}</p>
                                    </div>
                                </td>
                                <td class="py-5"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-5">
                @foreach ($recordDetail->groupBy('checkout_id')->all() as $key => $item)
                    <div class="show-detail show-detail-{{$key}}" {!! $loop->first ? '':'style="display:none"' !!}>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($item as $subitem)
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="img/vegetable-item-2.jpg" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                </div>
                                            </th>
                                            <td class="py-5">{{ $subitem->product->name }}</td>
                                            <td class="py-5">Rp {{ number_format($subitem->price, 0, ',', '.') }}</td>
                                            <td class="py-5">{{ $subitem->qty }}</td>
                                            <td class="py-5">Rp {{ number_format($subitem->price*$subitem->qty, 0, ',', '.') }}</td>
                                            @php
                                                $total += $subitem->price*$subitem->qty;
                                            @endphp
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th scope="row">
                                        </th>
                                        <td class="py-5"></td>
                                        <td class="py-5"></td>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark py-3">Total</p>
                                        </td>
                                        <td class="py-5">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark">Rp {{ number_format($total, 0, ',', '.') }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection