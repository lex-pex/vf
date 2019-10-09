<div class="sidebar-container col-lg-2 col-md-4 col-sm-6 col-xs-8">
    <div class="sb-btn">
        <div class="vf-rubric-label">
            <span onclick="event.preventDefault();sbSwap()">
                <i id="sb_btn" class="fa fa-bars"> |</i></span>&nbsp; КАТЕГОРИИ
        </div>
    </div>
    <nav id="sidebar">
        <div class="row">
            <div class="col-12 rub-link {{ $currentCategory == 0 ? 'vf-select' : '' }}">
                <a href="/shop">
                    <h5>Магазин</h5>
                    <img src="/img/shop/details/no_photo.jpg" />
                    <p>Все товары всех категорий. Последние добавленные позиции на первой странице магазина</p>
                    <div class="rubs-un-line"></div>
                </a>
            </div>
            @foreach(ShopCategory::getCategories() as $category)
            <div class="col-12 rub-link {{ $category->id == $currentCategory ? 'vf-select' : '' }}">
                <a href="/shop/{{$category->alias}}">
                    <h5>{{ $category->name }}</h5>
                    <img src="{{$category->image ? $category->image : '/img/shop/details/no_photo.jpg'}}" />
                    <p>{{$category->description}}</p>
                    <div class="rubs-un-line"></div>
                </a>
            </div>
            @endforeach
            <div class="vf-rubric-bottom" style="width:100%;">
                    <span onclick="event.preventDefault();sbSwap()">
                        <i class="fa fa-times sb_btn"> |</i></span>
                КАТЕГОРИИ |
                <i class="fa fa-angle-double-up"></i>
            </div>
        </div>
    </nav>
</div>
