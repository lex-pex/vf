@extends('index')
@section('content')
<div class="row justify-content-center pad-50">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="row vf-cabinet">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <img src="/public/avabig/{{ $user->avatar }}" width="100%" style="width:100%">
            </div>
            <div class="col-md-8 col-sm-12">
                <span class="text-danger">Эта страничка видна только вам</span><br/>
                <span><a href="/profile/{{$user->id}}">Посмотреть общедоступный профиль</a></span>
                <p>Имя:<br/> {{ $user->name }}</p>
                <p>E-mail:<br/> {{ $user->email }}</p>
                <p>Пароль:<br/>  * * * * * * * </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <span>О себе:</span> <hr/>
                @if(strlen($user->about) < 3)
                    <span style="color:lightblue;">
                        Добавьте информацию о себе<br/>
                        Например откуда вы<br/>
                        Почему вы тут, ваши увелчения<br/>
                        Отношение к вегетарианству...<br/>
                        И это вам очистит карму</span>
                @else
                    &nbsp; {{ $user->about }}
                @endif
                <hr/>
            </div>
        </div>
        <div class="row p-1">
            <div class="col-6">
            @if($admin)
                <a class="btn btn-outline-info" href="/admin">Админ панель</a>&nbsp;
            @endif
            </div>
            <div class="col-6 text-right">
            @if($edit)<a class="btn btn-outline-danger" href="{{ '/cabinet/edit/' . $user->id }}">Редактировать</a>@endif
            </div>
        </div>
    </div>
</div>
@endsection
