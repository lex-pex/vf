@extends('shop.home')
@section('content')
    <div class="row">
        <div class="col-6 text-center">
            <strong>{{ $cat->name }}</strong>
        </div>
        <div class="col-6 text-muted text-center">
            <i class="fa fa-eye"></i> &nbsp; Предпросмотр
        </div>
    </div>
    <div class="row pad-25">
        <div class="col-12 text-center">
            {!! $product->status ?
            ' <i style="color:limegreen" class="fa fa-check fa-2x"></i> &nbsp; Публикация Отображается' :
            ' <i style="color:tomato" class="fa fa-times fa-2x"></i> &nbsp; Публикация Модерируется
                <p style="color:red">Ваша публикация появится после модерации</p>'  !!}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-sm-12 p-3">
            <img src="{{ $product->image ? $product->image : '/img/shop/nophoto.jpg' }}" style="width: 100%"/>
        </div>
        <div class="col-lg-6 col-sm-6 col-sm-12 p-2 product-txt-block">
            <p class="name">{{ $product->name }}</p>
            <p>{!! isset($product->description) ? $product->description : 'этот товар без описания' !!}</p>
            <p class="shop-price-block">Единица: <span>{{ $product->unit }}</span></p>
            <p class="shop-price">{{ $product->price }},<sup>00</sup><sub>грн</sub></p>
            <div class="text-center">
                <a href="#" class="btn btn-outline-info rounded-0"><i class="fa fa-shopping-cart"></i> &nbsp; В коризну </a>
            </div>
        </div>
    </div>
    <div class="row pad-50">
        <div class="col-12" title="Смотреть рубрику данной статьи">
            <a href="/{{ 'shop/' . $cat->alias }}"><i class="fa fa-backward"></i> Назад в рубрику "{{ $cat->name }}"</a>
        </div>
        <div class="col-12 text-right">
            <a  href="/shop/add" class="btn btn-outline-primary">Добавить товар</a>
            <a  href="{{ route('productEdit', $product->id) }}" class="btn btn-outline-danger">Редактировать</a>
        </div>
    </div>
    @include('cont.share')
@endsection