<div class="row pad-25"><!-- Feed Row Starts -->
    <div class="col-md-6 col-sm-12 text-center">
        <span class="message-to-cart">КАК ЗАКАЗАТЬ? СМОТРИТЕ В КОРЗИНЕ</span>
    </div>
    <div class="col-md-6 col-sm-12 text-center">
        <a class="btn btn-block btn-outline-dark" href="/shop/cart/">
            <span style="padding:20px 25px;font-size:17px">
            <i class="fa fa-shopping-cart" style="font-size:20px; padding-right: 7px"></i> Корзина
                ( <span id="cart_count">{{ Cart::countItems() }}</span> )
            </span>
        </a>
    </div>
</div>
<div class="row">
    @foreach($products as $product)
    <div class="col-md-4 col-sm-12 m-0">
        <div class="vf-shop-card"> @php $cat = ShopCategory::getNameAlias($product->category); @endphp
            <span class="shop-card-label"><a href="/shop/{{ $cat->alias }}">{{ $cat->name }}</a></span>
            <a href="/shop/prod/{{ $product->alias }}">
                <img src="{{ $product->image ? $product->image : '/img/shop/nophoto.jpg' }}" alt="{{ $product->name }}" title="{{ $product->name }}" />
                <p class="shop-title">{{ $product->name }}</p>
                <div class="row">
                    <div class="col-12 text-right">
                        <span class="unit">{{ $product->unit }}</span> <span class="price">{{ $product->price }} <sup>00</sup> <sub>грн</sub></span>
                    </div>
                </div>
                <div class="text-center">
                    <a href="#" onclick="event.preventDefault();" token="{{ csrf_token() }}" data_id="{{ $product->id }}" class="btn btn-outline-dark mt-3 add-to-cart">
                        <i class="fa fa-shopping-cart" style="font-size:1.2em"></i> &nbsp; В коризну
                    </a>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div> <!-- Feed Row Ends -->
@include('nav.pager')


