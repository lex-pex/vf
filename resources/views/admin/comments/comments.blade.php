@extends('index')
@section('content')
<div class="row justify-content-center pad-50">
    <div class="col-lg-9 col-md-11 col-sm-12">
        <div class="bg-light">
            <div class="row p-3">
                <div class="col-6 p-0">
                    <a href="{{ route('admin') }}"><i class="fa fa-backward"></i> Назад в ПАНЕЛЬ</a>
                </div>
                <div class="col-6 p-0 text-right">
                    <span class="vf-btn-right"><i class="fa fa-shield"></i> Админ | Коменты</span>
                </div>
            </div>
            <div style="padding: 0 10px">
            @foreach($comments as $comment)
            <div id="{{ $comment->id }}_display">
                <div class="panel panel-default">
                    <div style="color:gray;margin:5px;">
                        <i><a><strong>{{ $comment->author }} : </strong></a>
                            <span id="{{ $comment->id }}_txt">{{ $comment->text }}</span></i>
                    </div>
                    <div class="rounded text-right p-2" style="background:#ffccff">
                        <a onclick="editComment('{{ $comment->id }}', '{{ $comment->author }}')">редактировать</a> |
                        <a onclick="event.preventDefault(); document.getElementById('del_comment').submit();">удалить</a> |
                        <form id="del_comment" method="post" style="display:none" action="{{ route('commentDelete', ['id' => $comment->id]) }}">{{ csrf_field() }}</form>
                        <small> {{ $comment->created_at->format('H:i | d-m-y') }}</small>
                    </div>
                </div>
            </div>
            <div id="{{$comment->id}}_edit_pane" style="display:none;"> <!-- EDIT -->
                <div class="form-group">
                    <form method="post" action="{{ route('commentEdit') }}">
                        <input type="hidden" name="user_id" value="{{ $comment->user_id }}">
                        <input type="hidden" id="comment_id" name="id" value="{{ $comment->id }}"/>
                        {{ csrf_field() }}
                        <input id="author" type="text" name="author" class="form-control" value="{{ Auth::user() ? Auth::user()->name : '' }}"/>
                        <textarea name="text" id="{{ $comment->id }}_textarea" rows="2" class="form-control" style="resize:none">Some text here...</textarea>
                        <div class="rounded text-right" style="background:#ffccff">
                            <a class="btn btn-link" onclick="editComment('{{ $comment->id }}', 0)">отменить</a>
                            <input type="submit" class="btn btn-link" value="сохранить"/>
                            <span class="small" style="padding-right:20px"> {{ $comment->created_at->format('H:i d-m-Y') }}</span>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
            </div>
            <div class="col-12 p-3">
                <a href="/admin"> <i class="fa fa-backward"></i> Назад в ПАНЕЛЬ</a>
            </div>
        </div>
    </div>
</div>
@endsection
