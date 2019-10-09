<div class="row pb-3"><!-- Jumbo Poster Row -->
    <div class="col-12 p-0">
        <img class="d-block w-100" src="{{ $headers['image'] ? $headers['image'] : '/img/shop/details/no_photo.jpg' }}" alt="{{ $headers['title'] }}">
        @include('shop.jumbo.text')
    </div>
</div> <!-- Jumbo Poster Row Ends -->