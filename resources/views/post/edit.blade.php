@extends('index')
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
                {{ Category::getName($blogPost->category_id) }}
            </div>
            <div class="col-6 text-right">
                <i class="fa fa-edit"></i> Редактировать
            </div>
        </div>
        <form method="post" action="{{ route('update', ['blogPost' => $blogPost]) }}" enctype="multipart/form-data">
            <div class="from-group">
                <label for="public_title">Заголовок:</label>
                <input id="public_title" type="text" name="title" class="form-control" placeholder="Заголовок... (до 100 символов)"
                       style="margin-bottom: 10px" value="{{ $blogPost->title }}" />
            </div>
            <div class="from-group">
                <textarea name="text" class="form-control" rows="12" placeholder="Текст Вашей статьи... (до 10.000 символов)"
                          style="resize:none;margin-bottom: 10px">{{ $blogPost->text }}</textarea>
            </div>
            <img src="{{ $blogPost->image ? $blogPost->image : '/img/details/nopic.jpg' }}" style="width:100%" />
            <label for="input_file">Картинка должна быть до 2 Мб...</label>
            <input id="input_file" class="btn btn-primary btn-block" type="file" name="image" style="margin-bottom:10px" />
            <div class="from-group" style="margin-bottom: 10px">
                <input type="checkbox" class="w3-check" name="image_del" id="del_img"/><label for="del_img">&nbsp; Удалить картинку</label>
            </div>
            <div class="from-group" style="margin-bottom: 10px;">
                <label for="sell">Выбрать рубрику:</label>
                <select id="sell" class="form-control custom-select" name="category_id">
                    @foreach ($categories as $category)
                        <option @if ($category->id == $currentCategory) {!! 'selected="selected"' !!} @endif value="{{ $category['id'] }}">{{ $category->status ? '' : ' # ' }}{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            @if ($hiddenOption)
            <div style="background:#efefef; padding: 0 0 10px 0;border-radius: 5px">
            <div style="color:tomato;text-align:center"><b>Опции администратора</b></div>
            <div class="from-group">
                <label for="displayStatus"> Статус показа:</label>
                <select id="displayStatus" class="form-control custom-select" name="status">
                    <option @if ($blogPost->status)) {!! 'selected="selected"' !!} @endif value="1">Отображен</option>
                    <option @if (!$blogPost->status)) {!! 'selected="selected"' !!} @endif value="0">Скрыт</option>
                </select>
            </div>
            <div class="from-group">
                <label for="aliasCeo">Псевдоним для СЕО:</label>
                <input id="aliasCeo" type="text" name="alias" class="form-control" value="{{ $blogPost->alias }}" placeholder="Английские буквы... (до 100 символов)" />
            </div>
            </div>
            @endif
            <hr/>
            {{ csrf_field() }}
            <div class="row">
                <div class="col-6">
                    <span class="btn btn-outline-danger" onclick="event.preventDefault(); document.getElementById('delete-post-form').submit();"><i class="fa fa-times"></i> Удалить &nbsp;</span>
                </div>
                <div class="col-6 text-right">
                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-check"></i> Сохранить &nbsp</button>
                </div>
            </div>
        </form>
        <form method="post" id="delete-post-form" action="{{ route('confirmDelete', ['blogPost' => $blogPost]) }}" style="display: none">
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection