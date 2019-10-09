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
            <div class="row">
                <div class="col-6">
                    <a href="/admin/rubrics"><i class="fa fa-backward"></i> Назад Рубрики</a>
                </div>
                <div class="col-6 text-right">
                    <strong>Изменение Рубрики</strong><br/>
                    <i class="fa fa-shield"></i> Админ-панель
                </div>
            </div>
        <div class="row">
            <div class="col-12">
                <hr/>
                <form action="{{ route('rubricUpdate', ['category' => $category]) }}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Название категории id: {{ $category->id }}</label>
                        <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" value="{{ $category->name }}">
                    </div>
                    <div class="form-group">
                        <label for="alias">URL-путь категрии</label>
                        <input id="alias" class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}" type="text" name="alias" value="{{ $category->alias }}" />
                    </div>
                    <img src="{{ $category->image ? $category->image : '/img/vegans.jpg' }}" style="width:100%" />
                    <div class="form-group">
                        <label for="input_file">Картинка должна быть до 2 Мб...</label>
                        <input id="input_file" class="btn btn-primary btn-block" type="file" name="image" />
                    </div>
                    <div class="from-group">
                        <input type="checkbox" class="form-check-inline" name="image_del" id="del_img"/><label for="del_img">&nbsp; Удалить Картинку</label>
                    </div>
                    <div class="form-group">
                        <label for="sort_order">Порядок сортировки</label>
                        <input id="sort_order" class="form-control" type="text" name="sort_order" value="{{ $category->sort_order }}">
                    </div>
                    <div class="form-group">
                        <label for="status">Статус</label>
                        <select id="status" class="custom-select" name="status">
                            <option value="1" {{ $category->status ? 'selected="selected"' : '' }}>
                                Отображен
                            </option>
                            <option value="0" {{ $category->status ? '' : 'selected="selected"' }}>
                                Скрыт</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descr">Описание рубрики:</label>
                        <textarea id="descr" name="descr" class="form-control{{ $errors->has('descr') ? ' is-invalid' : '' }}" rows="3" placeholder="Описание рубрики... (до 255 символов)" style="resize:none;">{!! $category->descr !!}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-outline-danger" onclick="event.preventDefault(); document.getElementById('rub_del_form').submit();" type="submit">Удалить</button>
                        </div>
                        <div class="col-6 text-right">
                            <button type="submit" class="btn btn-outline-info">Сохранить</button>
                        </div>
                    </div>
                    {{ csrf_field() }}
                </form>
                <form id="rub_del_form" action="{{ route('rubricDelete', ['category' => $category->id]) }}" method="post">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                </form>
                <div class="col-12 p-4">
                    <a href="/admin/rubrics"><i class="fa fa-backward"></i> Назад в Рубрики</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
