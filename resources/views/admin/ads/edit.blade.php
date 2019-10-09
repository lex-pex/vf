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
                <i class="fa fa-edit"></i> Редактировать Объявление
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="post" action="{{ route('adUpdate', ['ad' => $ad]) }}" enctype="multipart/form-data">

                    <div class="from-group">
                        <label for="label">Лейбл Группы</label> &nbsp; <small style="color:firebrick">если объява начинает группу</small>
                        <input id="label" type="text" name="label" class="form-control" value="{{ $ad->label }}" placeholder="Заголовок группы... (до 100 символов)" />
                    </div>

                    <div class="from-group">
                        <label for="sell">Реклама Статьи № {{ $ad->inner_id }}</label>
                        <select id="sell" class="form-control custom-select" name="inner_id">
                            <option value="0">- НЕ СТАТЬЯ -</option>
                            @foreach (BlogPost::getAll() as $post)
                            <option value="{{ $post->id }}" {{ $ad->inner_id == $post->id ? 'selected="selected"' : ''}}>{{ $post->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="from-group">
                        <label for="url">URL-путь</label>
                        <input id="url" type="text" name="url" class="form-control" value="{{ $ad->url }}" placeholder="URL для ссылки... (до 255 симв)" />
                    </div>

                    <img class="pad-25" src="{{ $ad->image ? $ad->image : '/img/details/nopic.jpg' }}" style="width:100%">

                    <div class="from-group">
                        <label for="input_file">Картинка должна быть до 2 Мб...</label>
                        <input id="input_file" class="btn btn-primary btn-block" type="file" name="image" />
                    </div>
                    <div class="from-group">
                        <label for="img_del">Удалить картинку</label>
                        <input id="img_del" type="checkbox" class="form-check" name="image_del"/>
                    </div>

                    <hr/>

                    <div class="from-group">
                        <label for="alias">Alias для картинки</label>
                        <input id="alias" type="text" name="alias" class="form-control" value="{{ $ad->alias }}" placeholder="Псевдоним для картинки... (до 255 симв)" />
                    </div>

                    <div class="from-group">
                        <label for="title">Заголовок</label>
                        <input id="title" type="text" name="title" class="form-control" value="{{ $ad->title }}" placeholder="Заголовок... (до 255 симв)" />
                    </div>

                    <div class="from-group">
                        <label for="txt">Описание</label>
                    <textarea id="txt" name="text" class="form-control" rows="4" placeholder="Описание... (до 250 симв)" style="resize:none;">{{ $ad->text }}</textarea>
                    </div>

                    <div class="from-group">
                        <label for="order">Порядок сортировки</label>
                        <input id="order" type="text" name="order" class="form-control" value="{{ $ad->order }}" placeholder="Порядок Сортировки 0-99" />
                    </div>

                    <div class="from-group">
                        <label for="stat">Статус отображения:</label>
                        <select id="stat" class="form-control custom-select" name="status" >
                            <option value="1" {{ $ad->status ? 'selected="selected"' : '' }}>Отображен</option>
                            <option value="0" {{ $ad->status ? '' : 'selected="selected"' }}>Скрыт</option>
                        </select>
                    </div>

                    <div class="row pad-25">
                        <div class="col-6">
                            <span class="btn btn-outline-danger" onclick="event.preventDefault(); document.getElementById('delete-ad-form').submit();"><i class="fa fa-times"></i> &nbsp; Удалить &nbsp;</span>
                        </div>
                        <div class="col-6 text-right">
                            <button type="submit" class="btn btn-outline-success"><i class="fa fa-paper-plane"></i> &nbsp; Опубликовать</button>
                        </div>
                    </div>
                    {{ csrf_field() }}
                </form>
                <form method="post" id="delete-ad-form" action="{{ route('adDel', ['ad' => $ad]) }}" style="display: none">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
        <div class="row pad-50">
            <div class="col-6">
                <a href="/admin/ads"><i class="fa fa-backward"></i> Назад в Объявления</a>
            </div>
            <div class="col-6 text-right">
                <i class="fa fa-edit"></i> Редактировать Объявление
            </div>
        </div>
    </div>
</div>
@endsection
