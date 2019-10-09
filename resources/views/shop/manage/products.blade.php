@extends('shop.home')
@section('content')
<div class="row justify-content-center pad-top-50">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="row">
            <div class="col-6">
                <a href="{{ route('admin') }}"><i class="fa fa-backward"></i> Назад в ПАНЕЛЬ</a>
            </div>
            <div class="col-6 text-right">
                <a href="/shop/add"><i class="fa fa-plus"></i> Добавить </a>
            </div>
        </div>
        <div class="row pad-bot-25">
            <div class="col-12">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th><i class="fa fa-edit"></i></th>
                    </tr>
                    @foreach ($products as $product)
                        @php $visit = Visit::where('page', 'shop/prod/' . $product->alias)->first();
                             $visits = $visit ? $visit->amount : 0; @endphp
                        <tr class="w3-border" {!! $product->status ? '' : 'style="background-color: silver"' !!}>
                            <td>
                            <p>
                                <a href="{{ URL::asset('shop/prod/' . $product->alias) }}"><b>{{ $product->name }}</b></a>
                                <b style="color:darkred;float:right">{{ ShopCategory::getName($product->category) }}</b>
                            </p>
                                {{ str_limit($product->description, 130) }}
                            </td>
                            <td>
                                <a href="{{ route('productEdit', ['id' => $product->id]) }}"
                                   title="Редактировать">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <br/>
                                <a><i class="fa fa-eye"></i></a>
                                <br/>
                                <b class="visits"> {{ $visits }} </b>
                            </td>
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
