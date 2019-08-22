<div class="layout-right">
    @include('frontend.right-tim-kiem')
    <div class="boxNotify">
        <div class="head">
            {{$category->title}}
        </div>
        <div class="content" id="scrollNotify">
            <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
            <div class="viewport">
                <div class="overview">
                    <div class="group">
                        <ul class="list-news">
                            @foreach ($list as $post)
                            <li><a href="{{url(str_slug($post->title.' '.$post->id))}}">{{str_limit($post->title, env('TITLE_TRIM'))}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--//boxNotify-->

    @include('frontend.right-noi-bat')

    @include('frontend.right-lien-quan')

    @include('frontend.right-utility')
    <div class="box-form-email">
        <div class="head">
            Đăng ký nhận tin
        </div>
        <div class="item">
            <form action="">
                <p>
                Bạn là người luôn quan tâm đến thông tin y tế sức khỏe? Hãy đăng ký Email để được nhận tin từ Tuệ Linh mỗi ngày. Tìm hiểu về <a href="http://www.viemgan.com.vn/viem-gan-b-nguyen-nhan-trieu-chung-va-cach-dieu-tri.html" target="_blank">viem gan virus b</a>, <a href="http://www.giaocolam.vn" target="_blank">giao co lam</a>, <a href="http://tuyentienliet.vn" target="_blank">tien liet tuyen</a>, <a href="http://www.benhxogan.com.vn" target="_blank">benh xo gan</a>, <a href="http://www.viemgan.com.vn/men-gan-cao-trieu-chung-nguyen-nhan-va-cach-dieu-tri.html" target="_blank">men gan cao</a></p>
                <input type="text" placeholder="Email của bạn">
                <a href="" class="more">Gửi</a>
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
                    <iframe width="280" height="315" src="https://www.youtube.com/embed/Xjld6P5KTn4" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="box-social">
        <div class="head">
            Social
        </div>
        <div class="item">
            <div class="fb-page" data-href="https://www.facebook.com/tuelinh.vn" data-width="280" data-height="274" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/tuelinh.vn"><a href="https://www.facebook.com/tuelinh.vn">Tue Linh</a></blockquote></div></div>
        </div>
    </div>
</div>
