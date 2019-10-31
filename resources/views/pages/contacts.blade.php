@extends('index')
@section('content')
<div class="row justify-content-center pad-50">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="text-right"><i class="fa fa-envelope-o"></i> Форма связи</div>
        <div class="text-center">
            <h4>Контакты Vegans Freedom</h4>
        </div>
        <p>Наш познавательный проект о правильном питании и переходе на этичный и здоровый образ жизни открыт для диалогов и общения.
            Напишите нам пару строк и мы Вам ответим</p>
        @if($errors->any())
            <div class="col-md-12">
                <div class="form-error-message">
                    Поля заполнены не верно!
                </div>
            </div>
        @endif
        @if(session('messageSent'))
            <div class="col-md-12">
                <div class="form-sent-info">
                    СООБЩЕНИЕ ОТПРАВЛЕНО!
                </div>
            </div>
        @endif
        <form method="post" action="{{ route('feedback') }}">
            <div class="from-group">
                <label for="text">Текст Вашего сообщения:</label>
                <textarea id="text" name="text" class="red-placeholder form-control{{ $errors->has('text') ? ' vf-form-error' : '' }}" rows="5" placeholder=" Напишите нам пару строк"
                          style="resize:none;margin-bottom: 10px">{{ old('text') }}</textarea>
                @if ($errors->has('text'))
                    <span class="help-block" style="color:tomato">
                        <strong>{{ $errors->first('text') }}</strong>
                    </span>
                @endif
            </div>
            <div class="from-group">
                <label for="name">Ваше Имя:</label>
                <input id="name" type="text" name="name" class="red-placeholder form-control{{ $errors->has('name') ? ' vf-form-error' : '' }}" placeholder=" Ваше имя"
                       style="margin-bottom: 10px" value="{{ old('name') }}" required/>
                @if ($errors->has('name'))
                    <span class="help-block" style="color:tomato">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="from-group">
                <label for="email">Ваша Почта (E-mail):</label>
                <input id="email" type="email" name="email" class="red-placeholder form-control{{ $errors->has('email') ? ' vf-form-error' : '' }}" placeholder=" Ваша почта @ маил"
                       style="margin-bottom: 10px" value="{{ old('email') }}" required/>
                @if ($errors->has('email'))
                    <span class="help-block" style="color:tomato">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <label for="captcha" class="col-sm-4 col-form-label text-md-right">Введите сумму:</label>
                <div class="col-sm-5" style="max-width:35%">
                    <input id="captcha" type="text" class="form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}" name="captcha" placeholder="3 + 2 = ..." required>
                    @if ($errors->has('captcha'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('captcha') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-check"></i> Отправить</button>
                </div>
            </div>
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection
