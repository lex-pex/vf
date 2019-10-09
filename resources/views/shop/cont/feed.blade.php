<div class="row pad-25"><!-- Feed Row Starts -->
    <div class="col-md-6 col-sm-12">
        <div class="col-6 vf-pop-rubric pad-25">
            <span>ТОВАРЫ</span>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 text-left cart-link">
        <a href="/shop/cart/"><i class="fa fa-shopping-cart"></i> Корзина
            ( <span id="cart_count">{{ Cart::countItems() }}</span> )</a>
    </div>
</div>
<div class="row">
    @foreach($products as $product)
    <div class="col-md-4 col-sm-12">
        <div class="vf-shop-card"> @php $cat = ShopCategory::getNameAlias($product->category); @endphp
            <span class="shop-card-label"><a href="/shop/{{ $cat->alias }}">{{ $cat->name }}</a></span>
            <a href="/shop/prod/{{ $product->alias }}">
                <img src="{{ $product->image ? $product->image : '/img/shop/nophoto.jpg' }}" alt="{{ $product->name }}" title="{{ $product->name }}" />
                <span class="shop-title">{{ $product->name }}</span>
                <div class="row">
                    <div class="col-12 text-right">
                        <span class="unit">{{ $product->unit }}</span> <span class="price">{{ $product->price }}<sup>00</sup><sub>грн</sub></span>
                    </div>
                </div>
                <div class="text-center">
                    <a href="#" onclick="event.preventDefault();" token="{{ csrf_token() }}" data_id="{{ $product->id }}" class="btn btn-outline-primary rounded-0 add-to-cart"><i class="fa fa-shopping-cart"></i> &nbsp; В коризну </a>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div> <!-- Feed Row Ends -->
@include('nav.pager')


