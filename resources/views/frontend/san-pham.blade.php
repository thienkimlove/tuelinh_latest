@extends('frontend')
@section('content')
    <section data-position="true" class="box-news" id="box-news">
        <div class="fix">
            <div class="layout">
                <div class="layout-left">

                    <ul class="breadCrumb clearFix">
                        <li><a href="{{url('/')}}">{{trans('common.home_cate')}}</a></li>
                        <li class="active">{{trans('common.index_san_pham')}}</li>
                    </ul>

                    <div class="box-news">
                        <div class="head">
                            <h1 class="title wow fade-in-left">{{trans('common.sanpham_tieu_de')}}</h1>
                            <p class="des wow fade-in-right">
                                {{trans('common.sanpham_tieu_de_text')}}
                            </p>
                        </div>
                        @foreach ($posts->chunk(3) as $k => $groupPost)
                            <div class="data wow bounce-in-{{($k % 2 == 0)? 'right' : 'left'}}">
                                @foreach ($groupPost as $post)
                                    <div class="item wow animated" data-wow-delay="0.6s" data-wow-duration="1s">
                                        <a href="{{url(str_slug($post->title.' '.$post->id))}}" title="{{$post->title}}">
                                            <img src="{{url('cache/256x256',  \App\ImageReverse::img($post->image))}}"  alt=""/>
                                        </a>
                                        <h3>
                                            <a href="{{url(str_slug($post->title.' '.$post->id))}}">{{str_limit($post->title, env('TITLE_TRIM'))}}</a>
                                        </h3>
                                        <p>
                                            <a href="{{url(str_slug($post->title.' '.$post->id))}}">{{str_limit($post->desc, env('DESC_TRIM'))}}</a>
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <div class="box-paging">
                            @include('frontend.pagination', ['paginate' => $posts])
                        </div>
                    </div>
                </div>
                @include('frontend.tin-y-duoc-right-menu')
            </div>
        </div>
    </section><!--//box-solution-->
@endsection