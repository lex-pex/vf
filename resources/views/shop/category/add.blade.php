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
            <div class="col-6">
                <a href="/admin/rubrics"><i class="fa fa-backward"></i> Назад Категории</a>
            </div>
            <div class="col-6 text-right">
                <strong>Создание Категории</strong><br/>
                <i class="fa fa-shield"></i> Админ-панель
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr/>
                <form action="{{ route('categoryStore') }}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Название категории</label>
                        <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" value="{{ old('name') }}" placeholder="Название категории" />
                    </div>
                    <div class="form-group">
                        <label for="alias">URL-путь категории</label>
                        <input id="alias" class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}" type="text" name="alias" value="{{ old('alias') }}" placeholder="Псевдоним" />
                    </div>
                    <div class="form-group">
                        <label for="input_file">Картинка должна быть до 2 Мб...</label>
                        <input id="input_file" class="btn btn-primary btn-block" type="file" name="image" value="{{ old('image') }}" />
                    </div>
                    <div class="form-group">
                        <label for="description">Описание категории:</label>
                        <textarea id="description" name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="3" placeholder="Описание категории... (до 255 символов)" style="resize:none;">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="sort">Порядок сортировки</label>
                        <input id="sort" class="form-control" type="text" name="sort" placeholder="-99 - 99" value="{{ old('sort') ? old('sort') : 0 }}" />
                    </div>
                    <div class="form-group">
                        <label for="status">Статус</label>
                        <select id="status" class="custom-select" name="status">
                            <option value="0" selected="selected">Скрыта</option>
                            <option value="1">Отображена</option>
                        </select>
                    </div><br/>
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-6">
                            <a href="/admin/rubrics"><i class="fa fa-backward"></i> Назад Категории</a>
                        </div>
                        <div class="col-6 text-right">
                            <button type="submit" class="btn btn-outline-success">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
