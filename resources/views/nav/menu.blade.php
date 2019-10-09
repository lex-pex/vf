<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <a class="navbar-brand vf-brand text-white" href="/">Веганс Фридом</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#vfnb" aria-controls="vfnb" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="vfnb">
            <ul class="navbar-nav ml-auto"><!-- Right Side Of Navbar -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="rubrics_list" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Рубрики</a>
                    <div class="dropdown-menu" aria-labelledby="rubrics_list">
                        <a class="vf-main-item dropdown-item{{ $currentCategory === 0 ? ' vf-active' : '' }}" href="/">Главная</a>
                        @foreach(Category::getCategories() as $category)
                        <a class="dropdown-item{{ $category->id == $currentCategory ? ' vf-active' : '' }}" href="/{{ $category->alias }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contacts">| &nbsp; Контакты <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">| &nbsp; О нас </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/shop">| &nbsp; Магазин </a>
                </li>
                <li>
                    <form method="get" action="{{ route('search') }}" class="form-inline mt-2 mt-md-0 pl-3 pr-3">
                        <input name="query" class="form-control vf-search-input mr-sm-2 red-placeholder" type="text" placeholder="Поиск по сайту" aria-label="Search" required>
                        <button class="btn btn-outline-success vf-search-btn my-2 my-sm-0" type="submit">Поиск</button>
                    </form>
                </li>
                <li class="dropdown-divider"></li>
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('auth.register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/cabinet">Кабинет</a>
                        <a class="dropdown-item" href="/add">Добавить Статью</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('auth.logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
                <li class="dropdown-divider"></li>
            </ul>
        </div>
    </nav>
</header>