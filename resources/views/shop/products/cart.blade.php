@extends('layouts.app')

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{url('/')}}">
                    Home
                </a> /
                <a href="{{ url('/shop') }}">
                    Shop
                </a> /
                <a href="{{ url('shop/cart') }}">
                    Cart
                </a>
            </h6>
        </div>
    </div>

    <div class="container my-5">
        <div class="card shadow ">
            @if($cartitems->count() > 0)
                <div class="card-body">
                    @php $total = 0; @endphp
                    @foreach ($cartitems as $item)
                        <div class="row product_data">
                            <div class="col-md-2 my-auto">
                                <img src="{{ asset('assets/uploads/products/'.$item->products->image) }}" height="70px" width="70px" alt="Image here">
                            </div>
                            <div class="col-md-3 my-auto">
                                <h6>{{ $item->products->name }}</h6>
                            </div>
                            <div class="col-md-2 my-auto">
                                <h6> {{ $item->products->selling_price }} PLN</h6>
                            </div>
                            <div class="col-md-3 my-auto">
                                <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">
                                @if($item->products->qty != '0')
                                @if( $item->products->qty > $item->prod_qty)
                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3" style="width:130px;">
                                        <button class="input-group-text changeQuantity decrement-btn">-</button>
                                        <input type="text" name="quantity" class="form-control qty-input text-center" value="{{ $item->prod_qty }}" >
                                        <button class="input-group-text changeQuantity increment-btn">+</button>
                                    </div>
                                    @php $total += $item->products->selling_price * $item->prod_qty ; @endphp
                                @else
                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3" style="width:130px;">
                                        <button class="input-group-text changeQuantity decrement-btn">-</button>
                                        <input type="text" name="quantity" class="form-control qty-input text-center" value="{{ $item->prod_qty }}">
                                        <button class="input-group-text" disabled>+</button>
                                        <span style="font-size: 10px;"><strong>Max</strong> no stock</span>
                                    </div>
                                    @php $total += $item->products->selling_price * $item->prod_qty ; @endphp
                                @endif

                                @else
                                    <h6>Out of Stock</h6>
                                @endif

                            </div>
                            <div class="col-md-2 my-auto">
                                <button class="btn btn-danger remove-cart-item"> <i class="fa fa-trash"></i> Remove</button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <h6>Total Price : {{ $total }} PLN

                        <button class="btn btn-outline-success float-end order-cart-item">Proceed to Checkout</button>
                    </h6>
                </div>
            @else
                <div class="card-body text-center">
                    <h2>Your <i class="fa fa-shopping-cart"></i> Cart is empty</h2>
                    <a href="{{ url('shop') }}" class="btn btn-outline-primary float-end">Continue Shopping</a>
                </div>

            @endif
        </div>
    </div>

@endsection

@section('navshop')
    @include('shop.inc.leftnav')
@endsection

@section('scripts')
@endsection
