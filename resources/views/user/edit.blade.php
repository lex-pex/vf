@extends('index')
@section('content')
@if(count($errors) > 0)
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-12">
        <div class="vf-errors">
            ПОЛЯ ЗАПОЛНЕНЫ НЕ ВЕРНО:
            <ul>
        @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
        @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-12">
        <div class="row pad-top-50 pad-bot-25">
            <div class="col-3">
                <img src="/public/avatars/{{ $user->avatar }}" alt="Avatar" class="vf-avatar">
            </div>
            <div class="col-9 text-right">
                profile | <br/>
                <p>{{ $user->name }} | </p>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center pad-bot-25">
    <div class="col-lg-6 col-md-8 col-sm-12 p-0">
        <form method="post" action="{{ route('profileUpdate', ['user' => $user]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="text-center">
                <img src="/public/avabig/{{ $user->avatar }}" style="width:100%;max-width:400px">
            </div>
            <label for="input_file">Картинка должна быть до 2 Мб...</label>
            <input id="input_file" class="btn btn-primary btn-block" type="file" name="image" style="margin-bottom:10px" />
            <div class="from-group">
                <input type="checkbox" class="form-check-inline" name="image_del" id="del_img"/><label for="del_img">&nbsp; Удалить аватар</label>
            </div>
            <div class="from-group">
                <label for="user_name">Имя:</label>
                <input id="user_name" type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ $user->name }}" />
            </div>
            <div class="from-group">
                <label for="e-mail">E-mail:</label>
                <input id="e-mail" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ $user->email }}"/>
            </div>
            <div class="from-group">
                <label for="about_user">О себе:</label>
                <textarea id="about_user" name="about" class="form-control{{ $errors->has('about') ? ' is-invalid' : '' }}" rows="7" placeholder="До 1.000 символов...">{{ $user->about }}</textarea>
            </div>
            <div class="row">
                <div class="col-6">
                    <p class="text-muted">Удалить Профиль:</p>
                    <a href="JavaScript:void(0)" onclick="document.getElementById('user-del-form').submit()" class="btn btn-outline-danger" title="Удалить Профиль">Удалить</a>
                </div>
                <div class="col-6 text-right">
                    <p class="text-muted">Подтвердить:</p>
                    <button type="submit" class="btn btn-outline-success" title="Подтвердить Изменения">Сохранить</button>
                </div>
            </div>
        </form>
        <form method="post" id="user-del-form" action="{{ route('profileDelete', ['user' => $user]) }}" style="display:none">
            <button type="submit">x_del</button>
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
        </form>
    </div>
</div>
<div class="row justify-content-center pad-bot-25">
    <div class="col-lg-6 col-md-8 col-sm-12">
        <div class="row">
            <div class="col-6">
                <a href="/cabinet"><li class="fa fa-backward"></li> Назад в кабинет</a>
            </div>
            <div class="col-6 text-right">
                Пароль на почту:<br/>
                <a href="{{ route('passwordReset') }}" id="pass" style="margin-bottom: 10px">Новый пароль</a>
            </div>
        </div>
    </div>
</div>
@endsection
