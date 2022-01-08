<div style="padding-left: 12px;padding-right: 12px;" class="nav-scroller bg-body shadow-sm">

    <nav class="navbar navbar-expand-lg" aria-label="Secondary navigation">
        <span class="nav-link text-dark" aria-current="page" href="#">Popular Category:</span>
        <ul class="nav col-12 col-lg-auto me-lg-auto navbar-nav ms-auto mb-2 mb-lg-0">
        @foreach($featured_category as $cat)
<li class="nav-item">
            <a class="nav-link btn btn-outline-light" href="{{url('shop/view-category/'.$cat->slug)}}">{{$cat->name}}</a>
</li>
        @endforeach
        </ul>
        @guest
        @else
            <a href="{{url('shop/cart')}}" class="btn btn-primary">Cart
                <span class="badge badge-pill bg-primary cart-count">0</span>
            </a>
        @endguest
    </nav>
</div>
