@extends('index')
@section('content')
<div class="row justify-content-center pad-top-50">
    <div class="col-lg-5 col-md-7 col-sm-9">
        <div class="row pad-50">
            <div class="col-12 pad-bot-25 text-center">
                <i class="fa fa-shield"></i> Объявления
            </div>
            <div class="col-6">
                <a href="/admin"><i class="fa fa-backward"></i> Назад в ПАНЕЛЬ</a>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('adAdd') }}"><i class="fa fa-plus"></i> &nbsp; Добавить объявление</a>
            </div>
        </div>
        @foreach(Ads::getAll() as $ad)
        <div class="row vf-pop-card {{ $ad->status ? '' : ' vf-disabled' }}">
            @if($ad->label && $ad->label != ' ')
            <div class="row p-0 m-0">
                <div class="col-12 vf-pop-rubric"><span>{{ $ad->label }}</span></div>
            </div>
            @endif
            <div class="row-12">
                <div class="text-center">
                    <img src="{{ $ad->image ? $ad->image : '/img/details/nopic.jpg' }}" alt="{{ $ad->title }}" title="{{ $ad->title }}" style="width:100%;">
                </div>
                <h5 class="text-center">{{ $ad->title }}</h5>
                <div class="text-center">{!! str_limit($ad->text, 115) !!}</div>
                <div class="row">
                    <div class="col-6">
                        <a href="{{ $ad->url }}" title="{{ $ad->url }}">URL - ссылка</a>
                    </div>
                    <div class="col-6 text-muted text-right">
                        ID-номер: {{ $ad->id }}
                    </div>
                </div>
                <div class="row pad-bot-50">
                    <div class="col-6">Порядок:<span class="cyphers">{{ $ad->order }}</span></div>
                    <div class="col-6 text-right"><a href="{{ route('adEdit', ['ad' => $ad]) }}">Редактировать</a></div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="row pad-25">
            <div class="col-6">
                <a href="/admin"><i class="fa fa-backward"></i> Назад в ПАНЕЛЬ</a>
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('adAdd') }}"><i class="fa fa-plus"></i> &nbsp; Добавить объявление</a>
            </div>
        </div>
    </div>
</div>
@endsection