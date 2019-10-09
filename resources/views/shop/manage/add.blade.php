@extends('shop.home')
@section('content')
<div class="row justify-content-center pad-top-50">
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
        <div class="row">
            <div class="col-12 text-right">
                <i class="fa fa-plus-square-o"></i> Новый товар
            </div>
        </div>
        <div class="form-group">
            <form method="post" action="{{ route('productStore') }}" enctype="multipart/form-data" class="form-horizontal">
                <div class="from-group">
                    <label for="public_name">Название</label>
                    <input id="public_name" type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Название... (до 256 символов)" />
                </div>
                <div class="from-group">
                    <label for="description">Описание</label>
                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Описание... (до 512 символов)">{{ old('description') }}</textarea>
                </div>
                <div class="from-group">
                    <label for="unit">Единица товара:</label>
                    <input id="unit" type="text" name="unit" value="{{ old('unit') }}" class="form-control" placeholder="единица..." />
                </div>
                <div class="from-group">
                    <label for="price">Цена</label>
                    <input id="price" type="text" name="price" value="{{ old('price') }}" class="form-control" placeholder="Цена..." />
                </div>
                <div class="from-group">
                    <label for="sell">Выбрать категрию:</label>
                    <select id="sell" class="form-control custom-select" name="category">
                        @foreach ($categories as $category)
                            <option @if ($category->id == $currentCategory) {!! 'selected="selected"' !!} @endif value="{{ $category['id'] }}">{{ $category->status ? '' : ' # ' }}{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="from-group">
                    <label for="displayStatus"> Статус показа:</label>
                    <select id="displayStatus" class="form-control custom-select" name="status">
                        <option selected="selected" value="0">Скрыт</option>
                        <option value="1">Отображен</option>
                    </select>
                </div>
                <div class="from-group">
                    <label for="input_file">Картинка должна быть до 2 Мб...</label>
                    <input id="input_file" class="btn btn-primary btn-block" type="file" name="image"  value="{{ old('image') }}" />
                </div>
                <div class="from-group text-right pad-25">
                        <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> &nbsp; Опубликовать</button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
@endsection
