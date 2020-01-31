<div class="sidebar-container col-lg-2 col-md-4 col-sm-6 col-xs-8">

    <div class="sb-btn pad-bot-15">
        <div class="vf-rubric-label">
            <span onclick="event.preventDefault();sbSwap()">
                <i id="sb_btn" class="fa fa-bars"> </i></span>&nbsp; КАТЕГОРИИ
        </div>
    </div>


    <nav id="sidebar">

        <div class="row">
            <a href="/shop" class="col-12 category-link {{ $currentCategory == 0 ? 'shop-selected' : '' }}">
                <p>МАГАЗИН</p>
                <span>Главная страница</span>
            </a>
            @foreach(ShopCategory::getCategories() as $category)
                <a href="/shop/{{$category->alias}}"  class="col-12 category-link {{ $category->id == $currentCategory ? 'shop-selected' : '' }}">
                    <p style="text-transform: uppercase">{{ $category->name }}</p>
                </a>
            @endforeach
            <div class="vf-rubric-bottom" onclick="event.preventDefault();sbSwap()">
                <i class="fa fa-times sb_btn"></i></span> ЗАКРЫТЬ МЕНЮ
            </div>
        </div>
    </nav>
</div>
