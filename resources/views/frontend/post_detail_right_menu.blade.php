<div class="layout-right">
    @include('frontend.right-tim-kiem')

    @include('frontend.right-noi-bat')

    <div class="box-hot">
        <div class="head">
            {{trans('common.rightlienquan_tieu_de')}}
        </div>
        <div class="item">
            <ul class="list-news">
                @foreach ($rightRelateds as $post)
                    <li><a href="{{url(str_slug($post->title.' '.$post->id))}}">{{str_limit($post->title, env('TITLE_TRIM'))}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    @include('frontend.right-utility')

    <div class="box-form-email">
        <div class="head">
           {{trans('common.menu_right_dangky')}}
        </div>
        <div class="item">
            <form action="">
                <p>
                   {{trans('common.menu_right_text')}}.<a href="http://www.viemgan.com.vn" target="_blank">benh viem gan</a>, <a href="http://www.giaocolam.vn" target="_blank">giao co lam</a>, <a href="http://www.cagaileo.vn" target="_blank">ca gai leo</a> </p>
                <input type="text" placeholder="Email">
                <a href="" class="more">{{trans('common.menu_right_gui')}}</a>
            </form>
        </div>
    </div>
    <div class="box-videos">
        <div class="head">
            Video
        </div>
        <div class="item">
            <div class="videoBoxIn">
                <div class="videoBoxInObject">
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/Xjld6P5KTn4" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="box-social">
        <div class="head">
            Social
        </div>
        <div class="item">
            <div class="fb-page" data-href="https://www.facebook.com/tuelinh.vn" data-width="300" data-height="274" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/tuelinh.vn"><a href="https://www.facebook.com/tuelinh.vn">Tu? Linh</a></blockquote></div></div>
        </div>
    </div>
</div>
