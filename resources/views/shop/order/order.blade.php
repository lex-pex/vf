@extends('shop.home')
@section('content')
<div class="row justify-content-center pad-top-50">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="row p-3">
            <div class="col-md-6 col-sm-12">
                <a class="btn btn-outline-dark" href="{{ route('orders') }}"><i class="fa fa-backward"></i> Назад в Заказы</a>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                Статусы:
                <span class="order-status-0">Новый</span>
                <span class="order-status-1">Принят</span>
                <span class="order-status-2">Сдан</span>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <tr><td style="width: 30%">Статус</td><td><span class="order-status-{{$order->status}}">{{ $order->getStatus() }}</span></td></tr>
                    <tr><td>Номер</td><td style="color:white;text-shadow:1px 1px 1px black">27{{ $order->id }}</td></tr>
                    <tr><td>Контакт</td><td>{{ $order->name }}</td></tr>
                    <tr><td>Телефон</td><td>{{ $order->phone }}</td></tr>
                    <tr><td>Коментарий</td><td>{{ $order->comment }}</td></tr>
                    <tr><td>Дата/Время</td><td><small>{{ $order->created_at->format('H:i | d/m/y') }}</small></td></tr>
                </table>
                <div class="row">
                    <div class="fake-header">
                        Детали заказа
                    </div>
                </div>
                <table class="table table-striped text-center">
                    <tr>
                        <th style="width:10%">№</th>
                        <th style="width:35%">Name</th>
                        <th style="width:5%">Amount</th>
                        <th style="width:50%">Price</th>
                    </tr>
                    @foreach($products as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td><a target="_blank" href="/shop/prod/{{ $p->alias }}">{{ $p->name }}</a></td>
                        <td>{{ $amounts[$p->id] }}</td>
                        <td><span class="cart-price">{{ $p->price }}</span></td>
                    </tr>
                    @endforeach
                    <tr><td colspan="4" class="text-left bold-text">Всего: {{ $total }}</td></tr>
                </table>
                <div class="col-12 text-right">
                    <a class="btn btn-outline-dark" href="{{ route('orderEdit', ['order' => $order]) }}"><i class="fa fa-edit"></i> Редактировать</a>
                </div>

            </div>
        </div>
        <div class="row p-3 pad-bot-50">
            <div class="col-12">
                <a href="{{ route('orders') }}"> <i class="fa fa-backward"></i> Назад Заказы</a>
            </div>
        </div>
    </div>
</div>
@endsection
