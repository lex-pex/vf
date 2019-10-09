<div class="row justify-content-end">
    <div class="col-lg-3 col-md-5 col-sm-5 col-xs-6 text-right">
        <div class="soc text-center share-btns">
            <p class="soc-btn-header">поделиться</p>
            <a href="http://www.facebook.com/sharer.php?u={{$headers['url']}}" target="_blank" title="Facebook" class="fa fa-facebook"></a>
            <a href="https://plus.google.com/share?url={{$headers['url']}}" target="_blank" title="Google+" class="fa fa-google-plus"></a>
            <a target="_blank" data-size="large" href="https://twitter.com/intent/tweet?url={{$headers['url']}}" data-url="{{$headers['url']}}" data-text="{{$headers['title']}}" data-lang="ru" class="fa fa-twitter"></a>
            <a href="https://vk.com/share.php?url={{$headers['url']}}" target="_blank" title="Vk" class="fa fa-vk"></a>
            <p class="soc-btn-txt">Закрепите эту страничку себе на стену в Вашем профиле, чтобы легко её потом найти</p>
        </div>
    </div>
</div>