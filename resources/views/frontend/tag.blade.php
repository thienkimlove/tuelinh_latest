@extends('frontend')
@section('content')
    <section data-position="true" class="box-news" id="box-news">
        <div class="fix">
            <div class="layout">
                <div class="layout-left">

                    <ul class="breadCrumb clearFix">
                        <li><a href="{{url('/')}}">{{trans('common.home_cate')}}</a></li>
                        <li class="active">{{$keyword}}</li>
                    </ul>

                    <div class="box-news">
                        <div class="head">
                            <h1 class="title wow fade-in-left">{{ucfirst($keyword)}}</h1>
                        </div>
                        @foreach ($posts->chunk(3) as $groupPost)
                            <div class="data wow bounce-in-right">
                                @foreach ($groupPost as $post)
                                    <div class="item wow animated" data-wow-delay="0.6s" data-wow-duration="1s">
                                        <a href="{{url(str_slug($post->title.' '.$post->id))}}" title="{{$post->title}}">
                                            <img src="{{url('cache/medium',  \App\ImageReverse::img($post->image))}}" width="256" height="256" alt=""/>
                                        </a>
                                        <h3>
                                            <a href="{{url(str_slug($post->title.' '.$post->id))}}">{{$post->title}}</a>
                                        </h3>
                                        <p>
                                            <a href="{{url(str_slug($post->title.' '.$post->id))}}">{{$post->desc}}</a>
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