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
                </a>
            </h6>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Featured Products</h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach ($featured_products as $prod)
                    <div class="item">
                        <div class="card">
                            <a href="{{ url('shop/category/'.$prod->category->slug.'/'.$prod->slug) }}">
                            <img src="{{asset('assets/uploads/products/'.$prod->image)}}" alt="">
                            <div class="card-body">
                                <h5>{{$prod->name}}</h5>
                                <span class="float-start">{{$prod->selling_price}}</span>
                                <span class="float-end"><s>{{$prod->original_price}}</s></span>
                            </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('navshop')
    @include('shop.inc.leftnav')
@endsection

@section('scripts')
    <script>
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:6
                }
            }
        })
    </script>
@endsection
