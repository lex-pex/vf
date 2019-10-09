@extends('shop.home')
@section('content')
<div class="row justify-content-center pad-50">
    <div class="col-lg-8 col-md-10 col-sm-12">
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
        <div class="row pad-50">
            <div class="col-6">
                {{ $cat->name }}
            </div>
            <div class="col-6 text-right">
                <i class="fa fa-edit"></i> Редактировать
            </div>
        </div>
        <form method="post" action="{{ route('productUpdate', ['product' => $product]) }}" enctype="multipart/form-data">
            <div class="from-group">
                <label for="public_name">Заголовок:</label>
                <input id="public_name" type="text" name="name" class="form-control" value="{{ $product->name }}" />
            </div>
            <div class="from-group">
                <label for="descr">Описание:</label>
                <textarea id="descr" name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
            </div>
            <div class="from-group">
                <label for="unit">Единица товара:</label>
                <input id="unit" type="text" name="unit" value="{{ $product->unit }}" class="form-control" placeholder="единица..."  />
            </div>
            <div class="from-group">
                <label for="price">Цена</label>
                <input id="price" type="text" name="price" value="{{ $product->getPrice() }}" class="form-control" placeholder="Цена..."  />
            </div>
            <img src="{{ $product->image ? $product->image : '/img/details/nopic.jpg' }}" style="width:100%; padding:10px 0" />
            <label for="input_file">Картинка должна быть до 2 Мб...</label>
            <input id="input_file" class="btn btn-primary btn-block" type="file" name="image" />
            <div class="from-group">
                <input type="checkbox" class="w3-check" name="image_del" id="del_img"/><label for="del_img">&nbsp; Удалить картинку</label>
            </div>
            <div class="from-group">
                <label for="sell">Выбрать рубрику:</label>
                <select id="sell" class="form-control custom-select" name="category">
                    @foreach ($categories as $category)
                        <option @if ($category->id == $currentCategory) {!! 'selected="selected"' !!} @endif value="{{ $category['id'] }}">{{ $category->status ? '' : ' # ' }}{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="from-group">
                <label for="displayStatus"> Статус показа:</label>
                <select id="displayStatus" class="form-control custom-select" name="status">
                    <option @if ($product->status)) {!! 'selected="selected"' !!} @endif value="1">Отображен</option>
                    <option @if (!$product->status)) {!! 'selected="selected"' !!} @endif value="0">Скрыт</option>
                </select>
            </div>
            <div class="from-group">
                <label for="aliasCeo">Псевдоним для СЕО:</label>
                <input id="aliasCeo" type="text" name="alias" class="form-control" value="{{ $product->alias }}" placeholder="Английские буквы... (до 100 символов)" />
            </div>
            <div class="from-group">
                <label for="sort">Сортировка:</label>
                <input id="sort" type="text" name="sort" class="form-control" value="{{ $product->sort }}" placeholder="Сортировка от первого (1)" />
            </div>
            <hr/>
            {{ csrf_field() }}
            <div class="row">
                <div class="col-6">
                    <span class="btn btn-outline-danger" onclick="event.preventDefault();document.getElementById('delete-post-form').submit();"><i class="fa fa-times"></i> Удалить &nbsp;</span>
                </div>
                <div class="col-6 text-right">
                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-check"></i> Сохранить &nbsp</button>
                </div>
            </div>
        </form>
        <form method="post" id="delete-post-form" action="{{ route('confirmProductDelete', ['product' => $product]) }}" style="display: none">
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection