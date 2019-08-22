<meta name="google-site-verification" content="oyIpKpDU3wFGvOwRYyDNDNW6Wxld5XoytUTOg-3hA-0" />
<meta name="google-site-verification" content="wDeM6m-kby9Osgr9zqQ9jtuCOjo8u2lHNeZf5tPuTvo" />
<div class="space-header" id="space-header"></div>
<div class="space-breadcrumb" id="space-breadcrumb"></div>
<div class="space-slider" id="space-slider"></div>
<header class="header" id="header" data-set="space-header">
    <div class="fix">
        <nav>
            <ul class="nav-main">
                <li class="current-menu-item">
                    <a href="{{url('/')}}" title="">{{trans('common.home_cate')}}</a>
                </li>
                <li>
                    <a href="#" title="">Tuệ Linh</a>
                    <ul>
                        <li>
                            <a href="{{url('lich-su-hinh-thanh')}}" title="">{{trans('common.recommend_cate')}}</a>
                        </li>
                        <li>
                            <a href="{{url('tam-nhin-su-menh')}}" title="">{{$cates['tam-nhin-su-menh']}}</a>
                        </li>
                        <li>
                            <a href="{{url('thanh-tuu')}}" title="">Thành tựu</a>
                        </li>
                        @if ($current == 'vi')
                        <li>
                            <a href="{{url('tam-nhin-su-menh/tuyen-dung')}}" title="">{{$cates['tuyen-dung']}}</a>
                        </li>
                        <li class="last">
                            <a href="{{url('tam-nhin-su-menh/hoat-dong-doanh-nghiep')}}" title="">{{$cates['hoat-dong-doanh-nghiep']}}</a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li>
                    <a href="{{url('san-pham')}}" title="">{{$cates['san-pham']}}</a>
                </li>
                @if ($current == 'vi')
                <li>
                    <a href="#" title="">{{trans('common.yduoc_cate')}}</a>
                    <ul>
                        <li>
                            <a href="{{url('thong-tin-suc-khoe/me-va-be')}}" title="">{{$cates['me-va-be']}}</a>
                        </li>
                        <li>
                            <a href="{{url('thong-tin-suc-khoe/y-hoc-co-truyen')}}" title="">{{$cates['y-hoc-co-truyen']}}</a>
                        </li>
                        <li>
                            <a href="{{url('thong-tin-suc-khoe/khoe-va-dep')}}" title="">{{$cates['khoe-va-dep']}}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" title="">{{trans('common.tracuu_cate')}}</a>
                    <ul>
                        <li>
                            <a href="{{url('dai-cuong-ve-benh')}}" title="">{{$cates['dai-cuong-ve-benh']}}</a>
                        </li>
                        <li>
                            <a href="{{url('tim-thuoc-theo-benh')}}" title="">{{$cates['tim-thuoc-theo-benh']}}</a>
                        </li>
                        <li>
                            <a href="{{url('thuoc-nam-tri-benh')}}" title="">{{$cates['thuoc-nam-tri-benh']}}</a>
                        </li>
                    </ul>
                </li>
                @endif
                <li><a href="{{url('he-thong-phan-phoi')}}" title="">{{trans('common.delivery_cate')}}</a></li>

                <li><a href="{{url('lien-he')}}" title="">{{trans('common.contact_cate')}}</a></li>
            </ul>
        </nav>
        <div class="search" id="search">
            {!! Form::open(['method' => 'GET', 'url' =>  url('tim-kiem') ]) !!}
                <input type="text"  placeholder="{{trans('common.search_placeholder')}}" name="q" class="txt"/>
                <input type="submit"  value="" name="submit" class="btn"/>
            {!! Form::close() !!}
        </div>


        <div class="language of-hide" id="language">
            <div class="selected {{$current}}" id="selected">{{$locales[$current]}}</div>
            <ul class="nav-language" id="nav-language">
                @foreach ($locales as $key => $local)
                  @if ($key !=  $current)
                    <li>
                        <a class="{{$key}}" key="{{$key}}" title="">{{$local}}</a>
                    </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <nav>
            <ul class="nav-social">
                <li>
                    <a target="_blank" class="social-1" href="https://www.facebook.com/tuelinh.vn" title="">Facebook</a>
                </li>
                <li>
                    <a target="_blank" class="social-3" href="https://www.youtube.com/user/tuelinhgroup" title="">Social3</a>
                </li>
            </ul>
        </nav>
    </div>
</header>