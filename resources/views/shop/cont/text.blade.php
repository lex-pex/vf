<div class="row">
    <div class="col-12 text-right" style="padding-right: 50px;">
        <small class="label">{{ $product->created_at ? $product->created_at->format('d . m . Y') : '' }}</small>
    </div>
    <div class="col-12 vf-txt">{!! isset($product->description) ? $product->description : 'этот товар без описания' !!}</div>
</div>
<div class="row vf-txt-footer">
    <div class="col-12" title="Смотреть рубрику данной статьи">
        <a href="/{{ $categoryUrn }}"><i class="fa fa-backward"></i> Назад в рубрику "{{ $categoryName }}"</a>
    </div>
    @if($edit)
    <div class="col-12 text-right">
        <a  href="{{ route('productEdit', $product->id) }}" class="btn btn-outline-danger">Редактировать</a>
    </div>
    @endif
</div>
