@extends('index')
@section('content')
<div class="row justify-content-center pad-top-50">
    <div class="col-12">
        <div class="row text-danger pad-25">
            <div class="col-6 text-center">
                <strong>{{ Category::getName($blogPost->category_id) }}</strong>
            </div>
            <div class="col-6 text-center">
                <i class="fa fa-trash-o"></i> &nbsp; УДАЛЕНИЕ
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <h2>{!! $blogPost->title !!}</h2>
            </div>
        </div>
        <img src="{{ $blogPost->image ? $blogPost->image : '/img/details/nopic.jpg' }}" style="width:100%">
        <div class="row">
            <div class="col-12 vf-txt">{!! str_limit($blogPost->text, 99) !!}</div>
        </div>
        <div class="row pad-50">
            <div class="col-6 text-center">
                <a href="{{ asset(Category::getAliasById($currentCategory)) }}"><i class="fa fa-backward"></i> В рубрику {{ Category::getName($currentCategory) }}</a>
            </div>
            <div class="col-6 text-center">
                <span class="btn btn-outline-danger" onclick="event.preventDefault(); document.getElementById('delete-post-form').submit();"><i class="fa fa-times"></i> Удалить &nbsp;</span>
            </div>
            <form method="post" id="delete-post-form" action="{{ route('postDelete', ['blogPost' => $blogPost]) }}" style="display: none">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
@endsection
