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
                </a>
            </h6>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Categories</h2>
                    <div class="row">
                        @foreach($featured_category as $cat)
                            <div class="col-md-4 mb-3">
                                <a href="{{url('shop/view-category/'.$cat->slug)}}">
                                    <div class="card">
                                        <img src="{{asset('assets/uploads/category/'.$cat->image)}}" alt="">
                                        <div class="card-body">
                                            <h5>{{$cat->name}}</h5>
                                            <p>
                                                {{$cat->description}}
                                            </p>
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
