@extends('index')
@section('content')
<div class="row justify-content-center pad-top-50">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="row">
            <div class="col-6">
                Vegans Freedom
            </div>
            <div class="col-6 text-muted text-right">
                <i class="fa fa-shield"></i> Админ-панель
            </div>
        </div>
        <div class="row">
            <div class="col-12 bg-light">
                <hr/>
                <p style="font-size: 17px; color:royalblue">Всего просмотров &nbsp; | <b style="color:tomato"> &nbsp; {{ $totalVisits }} </b>
                    <br/><small>от 24.07.18 / 00:50</small>
                </p>
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-6 p-2">
                <p><a href="/admin/messages">Сообщения</a>: ( {{ $totalMessages }} )
                    {!! $newMessages ?  '<span class="cyphers-alert">('.$newMessages.')</span>' : ''!!}</p>
                <hr/>
                <p><a href="/admin/posts">Публикации</a></p>
                <hr/>
                <p><a href="/admin/comments">Комментарии</a></p>
                <hr/>
                <p><a href="/admin/rubrics">Рубрики</a></p>
                <hr/>
                <p><a href="/admin/ads">Объявления</a></p>
                <hr/>
                <p><a href="/admin/users">Пользователи</a></p>
                <hr/>
            </div>
            <div class="col-6 p-2 bg-light">
                <h5>Магазин:</h5>
                <hr/>
                <p><a href="{{ route('orders') }}">Заказы</a>:
                    <?php $newOrders = Cart::newOrders(); ?>
                    <span class="{{ $newOrders ? 'cyphers-alert' : '' }}">( {{ $newOrders }} )</span></p>
                <hr/>
                <p><a href="/admin/shop">Товары</a></p>
                <hr/>
                <p><a href="/admin/shop/categories">Категории</a></p>
                <hr/>
            </div>
        </div>
        <div class="row pad-bot-100">
            <div class="col-12 p-1">
            <div id="markers" class="carousel slide vf-calendar" data-ride="carousel">
                <div class="carousel-inner">
                @php $numItems = count($weeksMap);$numOfMonth = 0; @endphp
                @foreach($weeksMap as $month => $weeks)
                <div class="carousel-item {{ ++$numOfMonth == $numItems ? 'active' : 'past-month' }}">
                    <div class="month">{{ $month }}</div>
                    <table>
                        <tr class="week"><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>
                    @foreach($weeks as $week => $days)
                        <tr>
                        @for($i = 0; $i < 7; $i ++)
                            @if(isset($days[$i])) {!! '<td>' . date('j', strtotime($days[$i]->date)) . '<br/><b class="visits">' . $days[$i]->amount . '</b></td>' !!}
                            @else {!! '<td class="off"> &nbsp; </td>' !!}
                            @endif
                        @endfor
                        </tr>
                    @endforeach
                        <tr><td colspan="7" class="off">&nbsp;</td></tr>
                    </table>
                </div>
                @endforeach
                </div>
                <a class="carousel-control-prev" href="#markers" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#markers" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection


