@extends('index')
@section('content')
<div class="row justify-content-center pad-top-50">
    <div class="col-12">
        <div class="row">
            <div class="col-6 text-center">
                <strong>{{ Category::getName($blogPost->category_id) }}</strong>
            </div>
            <div class="col-6 text-muted text-center">
                <i class="fa fa-eye"></i> &nbsp; Предпросмотр
            </div>
        </div>
        <div class="row pad-25">
            <div class="col-12 text-center">
                {!! $blogPost->status ?
                ' <i style="color:limegreen" class="fa fa-check"></i> &nbsp; Публикация Отображается' :
                ' <i style="color:tomato" class="fa fa-times"></i> &nbsp; Публикация Модерируется
                    <p style="color:red">Ваша публикация появится после модерации</p>'  !!}
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <h2>{!! $blogPost->title !!}</h2>
            </div>
        </div>
        <img src="{{ $blogPost->image ? $blogPost->image : '/img/details/nopic.jpg' }}" style="width:100%">
        <div class="row">
            <div class="col-12 vf-txt">{!! $blogPost->text  !!}</div>
        </div>
        <div class="row pad-50">
            <div class="col-6 text-center">
                <a href="{{ asset(Category::getAliasById($currentCategory)) }}"><i class="fa fa-backward"></i> В рубрику {{ Category::getName($currentCategory) }}</a>
            </div>
            <div class="col-6 text-center">
                <a href="{{route('postEdit', $blogPost->id)}}">Редактировать</a>
            </div>
        </div>
    </div>
</div>
@endsection
