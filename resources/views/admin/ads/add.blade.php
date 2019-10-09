@extends('index')
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
        <div class="row pad-50">
            <div class="col-6">
                <a href="/admin/ads"><i class="fa fa-backward"></i> Назад в Объявления</a>
            </div>
            <div class="col-6 text-right">
                <i class="fa fa-plus"></i> Новое Объявление
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                <form method="post" action="{{ route('adStore') }}" enctype="multipart/form-data" class="form-horizontal">

                    <div class="from-group">
                        <label for="label">Лейбл Группы</label> &nbsp; <small style="color:firebrick">если объява начинает группу</small>
                        <input id="label" type="text" name="label" class="form-control" placeholder="Заголовок группы... (до 100 символов)" />
                    </div>

                    <div class="from-group">
                        <label for="sell">Реклама Статьи:</label>
                        <select id="sell" class="form-control custom-select" name="inner_id">
                            <option value="0" selected="selected">- НЕ СТАТЬЯ -</option>
                            @foreach (BlogPost::getAll() as $post)
                            <option value="{{ $post->id }}">{{ $post->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="from-group">
                        <label for="url">URL-путь</label>
                        <input id="url" type="text" name="url" class="form-control" placeholder="URL для ссылки... (до 255 симв)" />
                    </div>

                    <div class="from-group">
                        <label for="input_file">Картинка должна быть до 2 Мб...</label>
                        <input id="input_file" class="btn btn-primary btn-block" type="file" name="image" />
                    </div>

                    <div class="from-group">
                        <label for="alias">Alias для картинки</label>
                        <input id="alias" type="text" name="alias" class="form-control" placeholder="Псевдоним для картинки... (до 255 симв)" />
                    </div>

                    <div class="from-group">
                        <label for="title">Заголовок</label>
                        <input id="title" type="text" name="title" class="form-control" placeholder="Заголовок... (до 255 симв)" />
                    </div>

                    <div class="from-group">
                        <label for="txt">Описание</label>
                    <textarea id="txt" name="text" class="form-control" rows="4" placeholder="Описание... (до 250 симв)" style="resize:none;"></textarea>
                    </div>

                    <div class="from-group">
                        <label for="order">Порядок сортировки</label>
                        <input id="order" type="text" name="order" class="form-control" placeholder="Порядок Сортировки 0-99" />
                    </div>

                    <div class="from-group">
                        <label for="stat">Статус отображения:</label>
                        <select id="stat" class="form-control custom-select" name="status" >
                            <option value="0" selected="selected">Скрыт</option>
                            <option value="1">Отображен</option>
                        </select>
                    </div>

                    <div class="from-group text-right pad-25">
                            <button type="submit" class="btn btn-outline-success"><i class="fa fa-paper-plane"></i> &nbsp; Опубликовать</button>
                    </div>

                    {{ csrf_field() }}
                </form>
            </div>
        </div>
        <div class="row pad-50">
            <div class="col-6">
                <a href="/admin/ads"><i class="fa fa-backward"></i> Назад в Объявления</a>
            </div>
            <div class="col-6 text-right">
                <i class="fa fa-plus"></i> Новое Объявление
            </div>
        </div>
    </div>
</div>
@endsection
