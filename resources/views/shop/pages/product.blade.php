@extends('shop.home')
@section('content')
    @include('shop.cont.finder')
    <div class="row pad-25"><!-- Feed Row Starts -->
        <div class="col-md-6 col-sm-12">{{--<div class="col-6 vf-pop-rubric pad-25"><span>ТОВАР</span></div>--}}</div>
        <div class="col-md-6 col-sm-12 text-center">
            {{--<a href="/shop/cart/"><i class="fa fa-shopping-cart"></i> Корзина ( <span id="cart_count">{{ Cart::countItems() }}</span> )</a>--}}
            <a class="btn btn-outline-dark" href="/shop/cart/">
                <span style="padding:20px 25px;font-size:17px">
                    <i class="fa fa-shopping-cart" style="font-size: 20px; padding-right: 7px"></i> Корзина
                        ( <span id="cart_count">{{ Cart::countItems() }}</span> )
                </span>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-sm-12 p-3">
            <img src="{{ $headers['image'] ? $headers['image'] : '/img/details/nopic.jpg' }}" style="width: 100%"/>
        </div>
        <div class="col-lg-6 col-sm-6 col-sm-12 p-2 product-txt-block">
            <p class="name">{{ $product->name }}</p>
            <p>{!! isset($product->description) ? $product->description : 'этот товар без описания' !!}</p>
            <p class="shop-price-block">Единица: <span>{{ $product->unit }}</span></p>
            <p class="shop-price">{{ $product->price }},<sup>00</sup><sub>грн</sub></p>
            <div class="text-center">
                <a href="#" onclick="event.preventDefault();" token="{{ csrf_token() }}" data_id="{{ $product->id }}"
                   class="btn btn-block btn-outline-dark add-to-cart"><i class="fa fa-shopping-cart" style="font-size: 1.2em"></i> &nbsp; В коризну </a>
            </div>
        </div>
    </div>
    <div class="row pad-50">
        <div class="col-12" title="Смотреть рубрику данной статьи">
            <a href="/{{ $categoryUrn }}"><i class="fa fa-backward"></i> Назад в рубрику "{{ $categoryName }}"</a>
        </div>
        @if($edit)
            <div class="col-12 text-right">
                <a  href="{{ route('productEdit', $product->id) }}" class="btn btn-outline-danger">Редактировать</a>
            </div>
        @endif
    </div>
    @include('cont.share')
@endsection