@extends('frontend')

@section('content')
<section class="box-slide" id="box-slide" data-set="space-slider" data-fix="header">
    <div class="owl-carousel" id="slide-home">
        @if (App::getLocale() == 'vi')
            <div class="item"><a href="http://tuelinh.vn/lich-su-hinh-thanh"><img src="{{url('images/example/banner-1356x658-2.png')}}" alt="" width="1356" height="658" border="0"/></a><a class="over" href="" title=""></a>            </div>
            <div class="item">
                <a href="http://tuelinh.vn/lich-su-hinh-thanh"><img src="{{url('images/example/banner-1356x658-3.png')}}" alt="" width="1356" height="658" border="0"/></a>
                <a class="over" href="" title=""></a>
            </div>
            <div class="item">
                <a href="http://tuelinh.vn/lich-su-hinh-thanh"><img src="{{url('images/example/banner-1356x658-1.png')}}" alt="" width="1356" height="658" border="0"/></a>
                <a class="over" href="" title=""></a>
            </div>
        @elseif (App::getLocale() == 'en')
            <div class="item">
                <a href="http://tuelinh.vn/lich-su-hinh-thanh"><img src="{{url('images/example/banner-1356x658-2.png')}}" alt="" width="1356" height="658" border="0"/></a>
                <a class="over" href="" title=""></a>
            </div>
            <div class="item">
                <a href="http://tuelinh.vn/lich-su-hinh-thanh"><img src="{{url('images/example/banner-1356x658-2.png')}}" alt="" width="1356" height="658" border="0"/></a>
                <a class="over" href="" title=""></a>
            </div>
            <div class="item">
                <a href="http://tuelinh.vn/lich-su-hinh-thanh"><img src="{{url('images/example/banner-1356x658-2.png')}}" alt="" width="1356" height="658" border="0"/></a>
                <a class="over" href="" title=""></a>
            </div>
        @else
            <div class="item">
                <a href="http://tuelinh.vn/lich-su-hinh-thanh"><img src="{{url('images/example/banner-1356x658-2.png')}}" alt="" width="1356" height="658" border="0"/></a>
                <a class="over" href="" title=""></a>
            </div>
            <div class="item">
                <a href="http://tuelinh.vn/lich-su-hinh-thanh"><img src="{{url('images/example/banner-1356x658-2.png')}}" alt="" width="1356" height="658" border="0"/></a>
                <a class="over" href="" title=""></a>
            </div>
            <div class="item">
                <a href="http://tuelinh.vn/lich-su-hinh-thanh"><img src="{{url('images/example/banner-1356x658-2.png')}}" alt="" width="1356" height="658" border="0"/></a>
                <a class="over" href="" title=""></a>
            </div>
        @endif
    </div>
</section><!--//box-slide-->
<section data-position="true" class="box-news" id="box-news">
    <div class="fix">
        <div class="head">
            <h2 class="title wow bounce-in-left" data-wow-duration="1s"><a href="{{url('tin-tuc')}}">{{trans('common.index_tin_tuc')}}</a></h2>
        </div>
        <div class="data wow bounce-in-right" data-wow-duration="1s">
            <div class="owl-carousel" id="slide-news">
                @foreach ($news as $post)
                <div class="item wow animated" data-wow-delay="0.6s" data-wow-duration="1s">
                    <a href="{{url(str_slug($post->title.' '.$post->id))}}" title="{{str_limit($post->title, 62)}}">
                        <img src="{{url('cache/256x256',  $post->image)}}"  alt=""/>
                    </a>
                    <p class="soft-news">{{$post->category->title}}</p>
                    <h3>
                        <a href="{{url(str_slug($post->title.' '.$post->id))}}" title="">{{str_limit($post->title, 62)}}</a>
                    </h3>
                    <h4>
                        <a href="{{url(str_slug($post->title.' '.$post->id))}}" title="{{$post->title}}">{{trans('common.index_chi_tiet')}}</a>
                    </h4>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section><!--//box-banner-->
<section class="box-video" id="box-video">
    <div class="fix">
        <div class="inner">
            <div class="item">
                <div class="left-img wow zoom-in">
                    <img src="{{url('images/example/left_img.png')}}" alt="" width="393" height="298">
                </div>
                <div class="bottom-img wow zoom-in">
                    <img src="{{url('images/example/bottom_img.png')}}" alt="">
                </div>
                <div class="text">
                    <h2 class="title"><a href="" target="_blank">{{trans('common.index_tiep_buoc')}}</a></h2>
                    <p class="data">
                        {{trans('common.index_tiep_buoc_text')}}
                    </p>
                    <div class="process wow bounce-in animated">
                        <a class='youtube' href="https://www.youtube.com/embed/PjEgnDDC4b0"><img src="{{url('images/example/i_video.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="gallery">
                    <img src="{{url('images/example/avatar.png')}}" alt="" width="300" height="550">
                </div>
            </div>
        </div>
    </div>
</section><!--//box-video-->
<section class="box-resources" id="box-resources">
    <div class="fix">
        <div class="head">
            <h3 class="title wow fade-in-left" data-wow-delay="1s" data-wow-duration="1s">{{trans('common.index_chuan_hoa')}}</h3>
            <p class="des wow fade-in-right">{{trans('common.index_chuan_hoa_text')}}</p>
        </div>
        @foreach ($forms->chunk(2) as $gPost)
        <div class="data">
            @foreach ($gPost as $post)
            <div class="item">
                <a href="{{url(str_slug($post->title.' '.$post->id))}}" class="thumb">
                    <img src="{{url('cache/500x350', $post->image)}}" alt="" ></a>
                <h3><a href="{{url(str_slug($post->title.' '.$post->id))}}">{{str_limit($post->title, env('TITLE_TRIM'))}}</a></h3>
                <p>{{str_limit($post->desc, env('DESC_TRIM'))}}</p>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</section><!--//box-resources-->
<section class="box-product">
    <div class="left-img">
        <img src="{{url('images/example/left01.png')}}" alt="">
    </div>
    <div class="fix">
        <div class="head">
            <h3 class="title wow fade-in-left" data-wow-delay="1s" data-wow-duration="1s"><a href="{{url('san-pham')}}">{{trans('common.index_san_pham')}}</a></h3>
            <p class="des wow fade-in-right">{{trans('common.index_san_pham_text')}}</p>
        </div>
        @foreach ($products->chunk(4) as $gPost)
        <div class="data">
            @foreach ($gPost as $post)
            <div class="item wow rotate-left" data-wow-delay="0.6s" data-wow-duration="1s">
                <div class="item-bg">
                    <a href="{{url(str_slug($post->title.' '.$post->id))}}" title="{{$post->title}}">
                        <img src="{{url('cache/256x256',  $post->image)}}" alt=""/>
                    </a>
                </div>
                <div class="des">
                    <h3>
                        <a href="{{url(str_slug($post->title.' '.$post->id))}}" title="{{$post->title}}">{{str_limit($post->title, env('TITLE_TRIM'))}}</a>
                    </h3>
                    <h4>
                        <a href="{{url(str_slug($post->title.' '.$post->id))}}" title="{{$post->title}}">
                            {{str_limit($post->desc, env('DESC_TRIM'))}}
                        </a>
                    </h4>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
        <div class="box-paging">
            @include('frontend.pagination', ['paginate' => $products])
        </div>
    </div>
</section><!--//box-product-->
<section data-position="true" class="box-activity">
    <div class="fix">
        <div class="head">
            <h3 class="title wow fade-in-left" data-wow-delay="1s" data-wow-duration="1s"><a href="{{url('tin-tuc/hoat-dong-tu-thien')}}">{{trans('common.index_tu_thien')}}</a></h3>
            <p class="des wow fade-in-right">{{trans('common.index_tu_thien_text')}}</p>
        </div>
        <div class="data wow bounce-in-right" data-wow-duration="1s">
            <div class="owl-carousel" id="slide-activity">
                @foreach ($charities as $post)
                <div class="item wow animated" data-wow-delay="0.6s" data-wow-duration="1s">
                    <a href="{{url(str_slug($post->title.' '.$post->id))}}" title="{{$post->title}}">
                        <img src="{{url('cache/256x190', $post->image)}}"  alt=""/>
                    </a>
                    <p class="soft-news">{{trans('common.index_hoat_dong')}}</p>
                    <h3>
                        <a href="{{url(str_slug($post->title.' '.$post->id))}}" title="{{$post->title}}">{{str_limit($post->title, 62)}}</a>
                    </h3>
                    <h4>
                        <a href="{{url(str_slug($post->title.' '.$post->id))}}" title="{{$post->title}}">{{trans('common.index_chi_tiet')}}</a>
                    </h4>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section><!--//box-activity-->
<section class="box-group">
    <div class="fix">
        <div class="head">
            <h3 class="title wow bounce-in" data-wow-delay="1s" data-wow-duration="1s">{{trans('common.index_hoi_dong')}}</h3>
            <p class="des wow fade-in-right">{{trans('common.index_hoi_dong_text')}}</p>
        </div>
        <div class="data">
            <div class="owl-carousel" id="slide-group">
                @foreach ($friends as $friend)
                <div class="item wow bounce-in" data-wow-delay="0.6s" data-wow-duration="1s">
                    <a href="#" title="">
                        <img src="{{url('cache/256x256',  $friend->image)}}"  alt=""/>
                    </a>
                    <h3>
                        <a href="#" title="">{{$friend->title}}</a>
                    </h3>
                    <h4>
                        <a href="#" title="">{{$friend->desc}}</a>
                    </h4>
                </div>
               @endforeach
            </div>
        </div>
    </div>
</section>
<section class="box-slideF">
    <div class="fix">
        <h3 class="title wow fade-in-left">
            @if (App::getLocale() == 'vi')
                <img src="{{url('images/example/header.png')}}" alt="Header" width="643" height="68">
            @elseif (App::getLocale() == 'en')
                <img src="{{url('images/example/header1.png')}}" alt="Header" width="643" height="68">
            @else
                <img src="{{url('images/example/header1.png')}}" alt="Header" width="643" height="68">
            @endif
        </h3>
        <div class="box-cup fade-in-right">
            <div class="owl-carousel" id="slide-cup">
                @foreach ($awards as $award)
                <div class="item">
                    <a href="javascript:void(0)" title="">
                        <img src="{{url('cache/140x167', $award->image)}}" />
                    </a>
                    <p class="year">{{$award->year}}</p>
                </div>
                @endforeach
            </div>
            <div class="mess">
                <p>{{trans('common.index_hoi_nhap_text')}}</p>
            </div>
        </div><!--//box-Cup-->
    </div>
</section>
@endsection
