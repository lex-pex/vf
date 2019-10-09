
<div class="row pad-h-25">
    <div class="col-12 vf-pop-label">ПОПУЛЯРНОЕ</div>
</div>
<div class="row p-3">
    @php $i = 0; @endphp
    @foreach(Ads::getAll() as $ad)
    @if($ad->status)
    @if($ad->label && $ad->label != ' ')
    <div class="row p-0 m-0">
        <div class="col-12 vf-pop-rubric"><span>{{ $ad->label }}</span></div>
    </div>
    @endif
    @php ++$i; @endphp
    {!! $i % 2 == 0 ? '' : '<div class="row p-0 m-0">' !!}
        <div class="col-lg-12 col-md-12 col-sm-6 pop-link">
            <a target="_blank" href="{{ $ad->url }}">
                <img src="{{ $ad->image ? $ad->image : '/img/details/nopic.jpg' }}" alt="{{ $ad->title }}" title="{{ $ad->title }}" style="width:100%;">
                <h5>{{ $ad->title }}</h5>
                <p>{!! str_limit($ad->text, 99) !!}</p>
            </a>
        </div>
    {!! $i % 2 == 0 ? '</div>' : '' !!}
    @endif
    @endforeach
</div>