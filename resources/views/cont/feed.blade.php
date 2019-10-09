<div class="row pad-25"><!-- Feed Row Starts -->
    <div class="col-md-6 col-sm-12">
        <div class="col-12 vf-pop-rubric"><span>ПУБЛИКАЦИИ</span></div>
    </div>
    <div class="col-md-6 col-sm-12"></div>
    @foreach($blogPosts as $blogPost)
    <div class="col-md-6 col-sm-12">
        <div class="vf-card">@php $alias = Category::getAliasById($blogPost->category_id); $urn = $alias.'/'.$blogPost->alias; @endphp
            <span class="card-label"><a href="/{{ $alias }}">{{ Category::getName($blogPost->category_id) }}</a></span>
            <a href="/{{ $urn }}">
                <img src="{{ $blogPost->image ? $blogPost->image : '/img/details/nopic.jpg' }}" alt="{{ $blogPost->title }}" title="{{ $blogPost->title }}" />
                <h5 style="text-align: center">{{ $blogPost->title }}</h5>
                <p>{!! str_limit($blogPost->text, 115) !!}</p>
            </a>
            <div class="row vf-card-footer">
                <div class="col-6 text-left" title="Всего Просмотров и Коментариев">
                    <i class="fa fa-comment-o"></i> {{ Comment::amount($blogPost->id) }} |
                    <i class="fa fa-eye"></i> {{ Visit::amount(Category::getAliasById($blogPost->category_id) . '/' . $blogPost->alias) }}
                </div>
                <div class="col-6 text-right">
                    <i class="fa fa-clock-o"></i> {{ $blogPost->created_at ? $blogPost->created_at->format('d-m-y') : '' }}
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div> <!-- Feed Row Ends -->
@include('nav.pager')