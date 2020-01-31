<div class="sidebar-container col-lg-2 col-md-4 col-sm-6 col-xs-8">
    <div class="sb-btn">
        <div class="vf-rubric-label">
            <span onclick="event.preventDefault();sbSwap()">
                <i id="sb_btn" class="fa fa-bars"> </i></span>&nbsp; РУБРИКИ
        </div>
    </div>
    <nav id="sidebar">
        <div class="row">
            @foreach(Category::getCategories() as $category)
            <div class="col-12 rub-link {{ $category->id == $currentCategory ? 'vf-select' : '' }}">
                <a href="/{{$category->alias}}">
                    <h5>{{ $category->name }}</h5>
                    <img src="{{$category->image ? $category->image : '/img/vegans.jpg'}}" />
                    <p>{{$category->descr}}</p>
                    <div class="rubs-un-line"></div>
                </a>
            </div>
            @endforeach
            <div class="vf-rubric-bottom" style="width:100%;">
                    <span onclick="event.preventDefault();sbSwap()">
                        <i class="fa fa-times sb_btn"> |</i></span>
                РУБРИКИ |
                <i class="fa fa-angle-double-up"></i>
            </div>
        </div>
    </nav>
</div>
