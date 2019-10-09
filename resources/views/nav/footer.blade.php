<footer class="footer text-center vf-footer">
    <div class="container-fluid">
        <div class="footer-spacer"></div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-6 text-center">
                <div class="soc soc-share-btn">
                    <p class="soc-btn-header">поделиться</p>
                    <a href="http://www.facebook.com/sharer.php?u={{Request::fullUrl()}}" target="_blank" title="Facebook" class="fa fa-facebook"></a>
                    <a href="https://plus.google.com/share?url={{Request::fullUrl()}}" target="_blank" title="Google+" class="fa fa-google-plus"></a>
                    <a target="_blank" data-size="large" href="https://twitter.com/intent/tweet?url={{Request::fullUrl()}}" data-url="{{$headers['url']}}" data-text="{{$headers['title']}}" data-lang="ru" class="fa fa-twitter"></a>
                    <a href="https://vk.com/share.php?url={{Request::fullUrl()}}" target="_blank" title="Vk" class="fa fa-vk"></a>
                    <p class="soc-btn-txt">Закрепите эту страничку себе на стену в Вашем профиле, чтобы легко её потом найти</p>
                </div>
            </div>
        </div>
        <div class="vf-bottom">
            Vegans Freedom © 2018-2019
            <p>Created by <img src="/img/details/ls.png" style="width: 15px"> Lexis-Studio <i class="fa fa-diamond"></i> com<br/>
            <small>создано студией лексис-студио ком</small></p>
        </div>
    </div>
</footer>