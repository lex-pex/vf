@extends('shop.home')
@section('content')
    @include('shop.cont.finder')
    @include('shop.cart.table')
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-6 col-sm-10">
            @if(count($errors) > 0)
                <div class="vf-errors">
                    ПОЛЯ ЗАПОЛНЕНЫ НЕ ВЕРНО:
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <form method="post" action="/shop/cart/order" class="form-horizontal">
                    <div class="from-group">
                        <label for="public_name">Имя</label>
                        <input id="public_name" type="text" name="name" class="form-control red-placeholder" value="{{ old('name') }}" placeholder="Ваше Имя..." required />
                    </div>
                    <div class="from-group">
                        <label for="phone">Ваш номер телефона для связи:</label><br/>
                        <span style="float:left;font-size: 22px">+38</span><input id="phone" type="text" name="phone" style="width:85%;float: right" class="form-control red-placeholder" value="{{ old('phone') }}" placeholder="( xxx ) xxx - xx - xx" required />
                    </div>
                    <div class="from-group">
                        <label for="comment">Коментарий к заказу</label>
                        <textarea id="comment" name="comment" class="form-control red-placeholder" style="resize: none" rows="3" placeholder="Кмментарий к заказу (необязательно)">{{ old('comment') }}</textarea>
                    </div>
                    <div class="from-group text-right pad-25">
                        <button type="submit" class="btn btn-outline-dark"><i class="fa fa-paper-plane"></i> &nbsp; Оформить</button>
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>

        </div>
    </div>
    @include('shop.cart.how')
@endsection