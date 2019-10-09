<div class="row pad-top-50">
    <div class="col-12">
        <form method="get" action="{{ route('shopSearch') }}" class="form-inline mt-2 mt-md-0 pl-3 pr-3">
            <input id="shop_search" name="query" class="form-control vf-search-input red-placeholder mr-sm-2" type="text" placeholder="Поиск по магазину" aria-label="Search" required>
            <button class="btn btn-outline-success vf-search-btn my-2 my-sm-0" type="submit">Поиск</button>
        </form>
    </div>
</div>