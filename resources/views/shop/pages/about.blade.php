@extends('shop.home')
@section('content')
    @include('shop.cont.finder')
    <div class="row justify-content-center pad-50">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>Как это работает?</h3>
                    <h3 style="font-weight:800!important;">Еда без вреда, в наличии всегда!</h3>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-4 col-sm-12 text-center p-3">
                    <img src="/img/shop/details/about/cart.png" style="width:75%" />
                </div>
                <div class="col-md-8 col-sm-12" style="padding-top:5%">
                    <p>С полезным органическими продуктами есть сложности во всём мире. То цена высокая, то нет в наличии, то низкое качество. Но чаще, нехватка информации, из-за вездесущей рекламы вредного образа жизни</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12 text-center p-3">
                    <img src="/img/shop/details/about/dollar.png" style="width:75%; max-height: 100px" />
                </div>
                <div class="col-md-8 col-sm-12" style="padding-top:5%">
                    <p>В большинстве случаев сложности с органическими продуктами связаны с личными проблемами и выгодами продавцов, либо производителей с которыми они связаны контрактами о поставках</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12 text-center p-3">
                    <img src="/img/shop/details/about/bulb.png" style="width:75%" />
                </div>
                <div class="col-md-8 col-sm-12" style="padding-top:5%">
                    <p>Наш проект предлагает решение! Чтобы у занятого человека была возможность легко приобрести все полезные веган продукты, легко, и не теряя времени в поисках, чтобы разнообразить и сбалансировать свой рацион</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12 text-center p-3">
                    <img src="/img/shop/details/about/couch.png" style="width:75%" />
                </div>
                <div class="col-md-8 col-sm-12" style="padding-top:5%">
                    <p>Как не бегая по магазинам и рынкам, заказать всё в одном месте и забрать заказ? Чтоб еда была и полезна, и разнообразна, и подобрана качественно, и этична по отношению к животным</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-12 text-center p-3">
                    <img src="/img/shop/details/about/teacher.png" style="width:75%" />
                </div>
                <div class="col-md-8 col-sm-12" style="padding-top:5%">
                    <p>Решение проблемы возможно, если убрать из уравнения постоянных продавцов и поставщиков, и поставить на их место надёжных добросовестных закупщиков, которые не зависят от интересов продавца, либо поставщика</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-12 text-center p-3">
                    <img src="/img/shop/details/about/courier.png" style="width:75%" />
                </div>
                <div class="col-md-8 col-sm-12" style="padding-top:5%">
                    <p>Наши курьеры-закупщики это волонтёры веганы, они подберут для Вас хорошо, как для себя, продукты и товары, ведь они настоящие добросовестные веганы</p>
                </div>
            </div>
            <div class="pad-25">
                <h3 class="text-center">Как работает проект?</h3>
                <hr/>
                <div class="row">
                    <div class="col-md-4 col-sm-12 text-center p-3">
                        <img src="/img/shop/details/about/charity.png" style="width:75%" />
                    </div>
                    <div class="col-md-8 col-sm-12" style="padding-top:5%">
                        <p>Проект благотворительный, и призван помочь в первую очередь занятым украинцам, у которых мало свободного времени на своё здоровье и здоровье своих близких. У кого до этичности очередь в графике жизни доходит с трудом</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 text-center p-3">
                        <img src="/img/shop/details/about/rocket.png" style="width:75%" />
                    </div>
                    <div class="col-md-8 col-sm-12" style="padding-top:5%">
                        <p>Всё самое лучшее в жизни достаётся и делается добровольно. Поэтому мы возлагаем большие надежды на данный благотворительный проект, так как он покоится на добровольных, волонтёрских началах</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('shop.cart.how')
@endsection