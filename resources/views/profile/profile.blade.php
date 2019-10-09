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
        <div class="row">
            <div class="col-6">
                <img src="/public/avabig/{{ $user->avatar }}" width="100%" style="width:100%">
            </div>
            <div class="col-6">
                <div class="text-right text-muted">profile</div>
                <hr/>
                <p><strong>Имя:</strong><br/>{{ $user->name }}</p>
                <p><strong>Регистрация:</strong><br/><small>{{ $user->created_at->format('d / m / Y') }}</small></p>
                <hr/>@php $urn = 'profile/' . $user->id; $visit = Visit::where('page', $urn)->first(); $visits = $visit ? $visit->amount : 0; @endphp
                Просмотров:<br/>
                <i style="color:#ff66ff;" class="fa fa-eye"></i> &nbsp; <i style="color:#00a594; padding:2px 5px;"> {{ $visits }} </i>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr/>
                <strong>О себе:</strong><br/>
                @if(strlen($user->about) < 2)
                    <span style="color:lightblue">Информация об частнике не указана</span>
                @else
                    <span class="vf-profile-txt">{{$user->about}}</span>
                @endif
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <span>Публикации участника:</span><br/>
                @if(count($posts))
                @foreach($posts as $post)
                @if($post->status)
                <p>
                    <a style="color:#ff66cc;text-decoration:none;"
                       href="/{{Category::getAliasById($post->category_id).'/'.$post->alias}}">
                        <i style="color:limegreen" class="fa fa-check"></i> &nbsp; {{ $post->title }}
                    </a>
                </p>
                @else
                <p>
                    <a style="color:lightblue; text-decoration: none;" href="{{ route('preview', ['id' => $post->id]) }}">
                        <i style="color:tomato; text-shadow:1px 1px gray" class="fa fa-times"></i>  &nbsp;  {{ $post->title }}</a>
                    <sup><span style="padding:3px 5px; border-radius:8px; background:#eee">модерация</span></sup>
                </p>
                @endif
                @endforeach
                @else
                <div style="color:lightblue; margin-bottom:20px">публикаций нет</div>
                @endif
                <hr/>
                @if($edit)
                <div class="row">
                    <div class="col-6">
                        <a href="/cabinet" title="Перейти в Мой Кабинет">Кабинет</a>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('profileEdit', ['user' => $user->id]) }}" title="Редактировать Профиль">Редактировать</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection