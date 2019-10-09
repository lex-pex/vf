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
                <div class="col-12 text-right">
                    <i class="fa fa-plus-square-o"></i> Новая публикация
                </div>
            </div>
        <div class="form-group">
            <form method="post" action="{{ route('store') }}" enctype="multipart/form-data" class="form-horizontal">
                <div class="from-group" style="margin-bottom: 10px" >
                    <label for="public_title">Заголовок</label>
                    <input id="public_title" type="text" name="title" class="form-control" placeholder="Заголовок... (до 100 символов)" />
                </div>
                <div class="from-group">
                    <label for="txt">Текст публикации</label>
                <textarea id="txt" name="text" class="form-control" rows="10" placeholder="Текст Вашей статьи... (до 10.000 символов)"
                          style="resize: none;"></textarea>
                </div>
                <div class="from-group">
                    <label for="sell">Выбрать рубрику:</label>
                    <select id="sell" class="form-control custom-select" name="category_id" >
                        @foreach ($categories as $category)
                            <option @if ($category->id == $currentCategory) {!! 'selected="selected"' !!} @endif value="{{ $category['id'] }}">{{ $category->status ? '' : ' # ' }}{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="from-group">
                    <label for="input_file">Картинка должна быть до 2 Мб...</label>
                    <input id="input_file" class="btn btn-primary btn-block" type="file" name="image" style="margin-bottom:10px" />
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
