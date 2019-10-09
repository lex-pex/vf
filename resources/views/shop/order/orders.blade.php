@extends('shop.home')
@section('content')
<div class="row justify-content-center pad-top-50">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="row">
            <div class="col-md-6 col-sm-12 p-3">
                <a href="{{ route('admin') }}"><i class="fa fa-backward"></i> Назад в ПАНЕЛЬ</a>
            </div>
            <div class="col-md-6 col-sm-12 text-right p-3">
                Статусы:
                <span class="order-status-0">Новый</span>
                <span class="order-status-1">Принят</span>
                <span class="order-status-2">Сдан</span>
            </div>
        </div>
        <div class="row pad-bot-25">
            <div class="col-12">
                <table class="table table-striped text-center">
                    <tr><th>№</th><th>Date</th><th>Status</th><th><i class="fa fa-edit"></i></th></tr>
                    @foreach ($orders as $order)
                        <tr>
                            <td><a href="{{ route('order', ['order' => $order]) }}">27{{ $order->id }}</a></td>
                            <td style="text-align: center">
                                <small>{{ $order->created_at->format('d-m-y') }} <br/>
                                {{ $order->created_at->format('H:i') }}</small>
                            </td>
                            <td><span class="order-status-{{$order->status}}">{{ $order->getStatus() }}</span></td>
                            <td><a href="{{ route('orderEdit', ['order' => $order]) }}"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-12 p-3">
                <a href="/admin"> <i class="fa fa-backward"></i> Назад в ПАНЕЛЬ</a>
            </div>
        </div>
    </div>
</div>
@endsection
