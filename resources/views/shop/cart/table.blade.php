<div class="row pad-25">
    <div class="col-md-6 col-sm-12">
        <div class="row">
            <div class="col-6 vf-pop-rubric pad-25">
                <span>Корзина</span>
            </div>
            <div class="col-6 cart-link">
                <a href="/shop/"><i class="fa fa-backward"></i> В магазин</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 text-left cart-link">
        <a href="/shop/cart/"><i class="fa fa-shopping-cart"></i> Корзина
            ( <span id="cart_count">{{ Cart::countItems() }}</span> )</a>
    </div>
</div>
<div class="row justify-content-center pad-25">
    <div class="col-lg-7 col-md-9 col-sm-12">
        <ul>
            <li>Минимальный заказ должен составлять от 200 гривен</li>
            <li>Время выполнения заказа до двух рабочих дней с момента принятия заказа, не считая выходные дни</li>
            <li>Как только Ваш заказ будет собран Ваша заявка появится на Новой Почте, или доставкой по Киеву на выбранную Вами станцию метро (+30 гривен)</li>
            <li>Оплата нужных Вам товаров производится предоплатой на карту Приват</li>
        </ul>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-9 col-sm-12 p-0">
        <table class="table table-responsive table-striped">
            <tr><th>Название</th><th>Цена</th><th >Единица</th><th>Кол-во</th><th>Отказ</th></tr>
            @if(!count($products)) <tr><td colspan="5" class="text-center"> корзина пуста </td></tr> @else
                @foreach ($products as $product)
                    <tr id="{{ $product->id }}">
                        <td style="width:40%"><a href="/shop/prod/{{ $product->alias }}" target="_blank">{{ $product->name }}</a></td>
                        <td style="width:15%"><span class="cart-price">{{ $product->price }}</span></td>
                        <td style="width:15%">{{ $product->unit }}</td>
                        <td style="width:15%" class="text-center">
                            <select id="amount_{{ $product->id }}" token="{{ csrf_token() }}" oninput="amount({{ $product->id }})">
                                <option{{ $cart[$product->id] == 1 ? ' selected' : ''}}>1</option>
                                <option{{ $cart[$product->id] == 2 ? ' selected' : ''}}>2</option>
                                <option{{ $cart[$product->id] == 3 ? ' selected' : ''}}>3</option>
                                <option{{ $cart[$product->id] == 4 ? ' selected' : ''}}>4</option>
                                <option{{ $cart[$product->id] == 5 ? ' selected' : ''}}>5</option>
                                <option{{ $cart[$product->id] == 6 ? ' selected' : ''}}>6</option>
                                <option{{ $cart[$product->id] == 7 ? ' selected' : ''}}>7</option>
                                <option{{ $cart[$product->id] == 8 ? ' selected' : ''}}>8</option>
                                <option{{ $cart[$product->id] == 9 ? ' selected' : ''}}>9</option>
                                <option{{ $cart[$product->id] == 10 ? ' selected' : ''}}>10</option>
                            </select>
                        </td>
                        <td style="width:15%" class="text-center">
                            <a href="" onclick="event.preventDefault();" token="{{ csrf_token() }}" data_id="{{ $product->id }}" class="del-from-cart"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach @endif
            <tr>
                <td style="color:firebrick">Итого:</td>
                <td><span class="cyphers"><span id="total">{{ $total }}</span> <!--sup>00</sup--></span></td>
                <td colspan="3" class="text-center">
                    @if(Cart::countItems() > 0 && !$commit)
                        <a class="btn btn-outline-primary" href="/shop/cart/order/">Оформить Заказ</a>
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>