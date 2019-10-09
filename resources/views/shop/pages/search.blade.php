@extends('shop.home')
@section('content')
    @include('shop.cont.finder')
    @if(count($products))
    @include('shop.cont.feed')
    @else
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
            <div class="text-right pad-bot-25"><i class="fa fa-search"></i> Поиск по Магазину</div>
            <div class="text-center">
                <h4>поиск по <span class="cyphers">{{ $query }}</span> не дал результатов</h4>
            </div>
            <form method="get" action="{{ route('shopSearch') }}" class="">
                <div class="from-group pad-25">
                    <label for="query">Введите слово, или фразу:</label>
                    <input id="query" type="text" name="query" class="red-placeholder form-control{{ $errors->has('query') ? ' vf-form-error' : '' }}"
                           placeholder=" слово / фраза / название " value="{{ old('name') }}" required/>
                    @if ($errors->has('query'))
                        <span class="help-block" style="color:tomato">
                    <strong>{{ $errors->first('query') }}</strong>
                </span>
                    @endif
                </div>
                <div class="form-group pad-bot-25">
                    <button type="submit" class="btn btn-block btn-outline-success"><i class="fa fa-search"></i> Искать</button>
                </div>
            </form>
        </div>
    </div>
    @endif
@endsection