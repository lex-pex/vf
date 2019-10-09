<div class="row justify-content-center pad-50"> <!-- Pagination -->
    <div class="col-lg-3 col-md-5 col-sm-7 vf-pager">
        <ul class="pagination pagination-md" role="navigation">
    @foreach($pager as $page)
    <li class="page-item {{ $page['class'] }}"><a class="page-link" href="{{ $headers['url'] . $page['urn'] }}">{{ $page['label'] }}</a></li>
    @endforeach
</ul>
    </div>
</div>
