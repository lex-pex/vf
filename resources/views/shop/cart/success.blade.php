@extends('shop.home')
@section('content')
    @include('shop.cont.finder')
    <div class="row justify-content-center pad-25">
        <div class="col-md-6 col-sm-12 text-center">
            <a class="btn btn-outline-dark" href="/shop/cart/"><i class="fa fa-shopping-cart"></i> Корзина
                ( <span id="cart_count">{{ Cart::countItems() }}</span> )</a>
        </div>
    </div>
    <div class="row justify-content-center pad-bot-50">
        <div class="col-lg-6 col-md-9 col-sm-12 p-0">
            <div class="col-12 text-center pad-25" style="font-size:19px; color:white; text-shadow: 1px 1px 1px black">
                <p>СПАСИБО!</p>
                Ваш заказ номер 27{{ $order_id }} принят
            </div>
            <table class="table table-responsive">
                <tr><th>Название</th><th>Цена</th><th >Единица</th><th>Кол-во</th></tr>
                @if(!count($products)) <tr><td colspan="5" class="text-center"> корзина пуста </td></tr> @else
                    @foreach ($products as $product)
                        <tr id="{{ $product->id }}">
                            <td style="width:40%"><a href="/shop/prod/{{ $product->alias }}" target="_blank">{{ $product->name }}</a></td>
                            <td style="width:20%"><span class="cart-price">{{ $product->price }} <!--sup>00</sup--></span></td>
                            <td style="width:20%">{{ $product->unit }}</td>
                            <td style="width:20%" class="text-center">{{ $cart[$product->id] }}</td>
                        </tr>
                    @endforeach @endif
                <tr>
                    <td style="color:firebrick">Итого:</td>
                    <td colspan="3"><span class="cyphers"><span id="total">{{ $total }}</span></span></td>
                </tr>
            </table>
        </div>
    </div>
@endsection
