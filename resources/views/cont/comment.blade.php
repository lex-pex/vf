<div class="row justify-content-center pad-25"><!-- COMMENTS AREA -->
    <div class="col-lg-7 col-md-9 col-sm-11">
        @if(count($errors) > 0)
            <div class="vf-errors">
                КОММЕНТ НЕ ДОБАВЛЕН<br/>
                ЕСТЬ ОШИБКИ ВВОДА
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-group">
            <form method="post" action="{{ route('commentAdd') }}">
                {{ csrf_field() }}
                <textarea required name="text" class="form-control red-placeholder" id="input" placeholder="Оставьте свой комментарий . . ."
                          onclick="open_comment()" rows="1" style="resize:none"></textarea>
                <span id="txt" style="display:none">
                            @auth
                            <input name="author" type="hidden" value="{{ Auth::user() ? Auth::user()->name : '' }}" />
                            @else
                            <input required class="form-control red-placeholder" name="author" type="text" placeholder="Введите своё имя, или зарегистрируйтесь . . ." style="margin-top:5px;"/>
                            <input required class="form-control red-placeholder" name="capcha" type="text" placeholder="Введите проверочный код : 1 2 3 " style="margin-top:5px;"/>
                            @endauth
                            <input type="hidden" name="post_id" value="{{ $blogPost->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user() ? Auth::user()->id : 0 }}">
                            <div class="btn-group">
                    <input class="btn btn-link" type="submit" value="сохранить"/>
                    <input class="btn btn-link" onclick="close_comment()" value="отменить" />
                </div>
            </span>
            </form>
        </div>
        @foreach(Comment::getPostComments($blogPost->id) as $comment) <!-- DISPLAY -->
        <div id="{{ $comment->id }}_display">
            <div class="panel panel-default">
                <div style="color:gray;margin:5px;">
                    <i><a><b>{{ $comment->author }} : </b></a>
                        <span id="{{ $comment->id }}_txt">{{ $comment->text }}</span></i>
                </div>
                <div class="rounded text-right p-2" style="background:#ffccff">
                @auth
                    @if($user_id == $comment->user_id || $is_admin)
                    <a onclick="editComment('{{ $comment->id }}', '{{ $comment->author }}')">редактировать</a> |
                    <a onclick="event.preventDefault(); document.getElementById('del_comment').submit();">удалить</a> |
                    <form id="del_comment" method="post" style="display:none" action="{{ route('commentDelete', ['id' => $comment->id]) }}">{{ csrf_field() }}</form>
                    @endif
                @endauth
                    <small>{{ $comment->created_at->format('H:i | d-m-y') }}</small>
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
                    <div  class="rounded text-right" style="background:#ffccff">

                        <a class="btn btn-link" onclick="editComment('{{ $comment->id }}', 0)">отменить</a>
                        <input type="submit" class="btn btn-link" value="сохранить"/>
                        <span class="small" style="padding-right:20px"> {{ $comment->created_at->format('H:i d-m-Y') }}</span>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div><!-- END COMMENTS -->