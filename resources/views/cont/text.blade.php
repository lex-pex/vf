<div class="row">
    <div class="col-6 text-left">
        <small class="cyphers"> Просмотров:
            <i class="fa fa-eye"></i> {{ Visit::amount(Category::getAliasById($blogPost->category_id) . '/' . $blogPost->alias) }}
        </small>
    </div>
    <div class="col-6 text-right" style="padding-right: 50px;">
        <small class="label">{{ $blogPost->created_at ? $blogPost->created_at->format('d . m . Y') : '' }}</small>
    </div>
    <div class="col-12 vf-txt">{!! isset($blogPost->text) ? $blogPost->text : 'Blog Post Text is Empty!' !!}</div>
</div>
<div class="row vf-txt-footer">
    <div class="col-12" title="Смотреть рубрику данной статьи">
        <a href="/{{ $categoryUrn }}"><i class="fa fa-backward"></i> Назад в рубрику "{{ $categoryName }}"</a>
    </div>
    @if($edit)
    <div class="col-12 text-right">
        <a  href="{{ route('postEdit', $blogPost->id) }}" class="btn btn-outline-danger">Редактировать</a>
    </div>
    @endif
</div>
