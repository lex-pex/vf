@extends('shop.home')
@section('content')
    @include('shop.cont.finder')
    <div class="row justify-content-center pad-bot-25">
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
            <div class="row pad-top-50 text-right">
                <div class="fake-header">
                    Редакция Заказа №{{ $order->id }}
                </div>
                <div class="col-6 text-muted text-left">
                    <small>Заказ: {{ $order->id }}</small>
                </div>
                <div class="col-6 text-muted text-right">
                    <small>{{ $order->created_at->format('d/m/y | H:i') }}</small>
                </div>
            </div>
            <div class="form-group">
                <form method="post" action="{{ route('orderStore', ['order' => $order]) }}" class="form-horizontal">
                    <div class="from-group">
                        <label for="public_name">Имя</label>
                        <input id="public_name" type="text" name="name" class="form-control red-placeholder" value="{{ $order->name }}" placeholder="Ваше Имя..." required />
                    </div>
                    <div class="from-group">
                        <label for="phone">Ваш номер телефона для связи:</label><br/>
                        <span style="float:left;font-size: 22px">+38</span><input id="phone" type="text" name="phone" style="width:85%;float: right" class="form-control red-placeholder" value="{{ $order->phone }}" placeholder="( xxx ) xxx - xx - xx" required />
                    </div>
                    <div class="from-group">
                        <label for="comment">Коментарий к заказу</label>
                        <textarea id="comment" name="comment" class="form-control red-placeholder" style="resize:none" rows="2" placeholder="Кмментарий к заказу (необязательно)">{{ $order->comment }}</textarea>
                    </div>
                    <div class="from-group">
                        <label for="status"><span class="order-status-{{ $order->status }}">Статус</span></label>
                        <select class="custom-select" id="status" name="status">
                            @foreach($order->getStatuses() as $k => $v)
                            <option {{ $order->status == $k ? 'selected' : '' }} value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row p-3">
                        <div class="col-12 text-center"><span class="bold-text">Список Заказа</span></div>
                    </div>
                    <div class="row pad-bot-15 text-muted">
                        <div class="col-7">Название</div>
                        <div class="col-3">Amount</div>
                        <div class="col-2">Del</div>
                    </div>
                    @foreach($products as $p)
                    <div class="row p-2" style="border-bottom: solid 1px #ddd;">
                        <div class="col-7"><a class="pad-15" target="_blank" href="/shop/prod/{{ $p->alias }}">{{ $p->name }}</a></div>
                        <div class="col-3 form-group"><input class="form-control" type="text" name="amounts[{{ $p->id }}]" value="{{ $amounts[$p->id] }}" /></div>
                        <div class="col-2 form-group"><input class="form-control checkbox" type="checkbox" name="deletes[{{ $p->id }}]" value="" /></div>
                    </div>
                    @endforeach
                    <div class="row pad-25">
                        <div class="col-6 text-left">
                            <a href="" onclick="event.preventDefault();document.getElementById('delete-order-form').submit();" class="btn btn-outline-danger">Удалить</a>
                        </div>
                        <div class="col-6 text-right">
                            <button type="submit" class="btn btn-outline-primary">Сохранить</button>
                        </div>
                        <div class="col-12 text-left pad-50">
                            <a href="{{ route('orders') }}"><i class="fa fa-backward"></i> Назад в Заказы</a>
                        </div>
                    </div>
                    {{ csrf_field() }}
                </form>
                <form method="post" id="delete-order-form" action="{{ route('orderDelete', ['order' => $order]) }}" style="display: none">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
@endsection


