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
                <a href="{{ url('/shop/category') }}">
                    Category
                </a> /
                <a href="{{ url('/shop/view-category/'.$category->slug) }}">
                    {{ $category->name }}
                </a>
            </h6>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{$category->name}}</h2>
                    <div class="row">
                        @foreach($products as $prod)
                            <div class="col-md-3 mb-3">
                                <a href="{{url('shop/category/'.$category->slug.'/'.$prod->slug)}}">
                                    <div class="card">
                                        <img src="{{asset('assets/uploads/products/'.$prod->image)}}" alt="">
                                        <div class="card-body">
                                            <h5>{{$prod->name}}</h5>
                                            <span class="float-start">{{$prod->selling_price}}</span>
                                            <span class="float-end"><s>{{$prod->original_price}}</s></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
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
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
    </script>
@endsection
