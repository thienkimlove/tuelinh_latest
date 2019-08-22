@extends('frontend')
@section('content')
    <section data-position="true" class="box-news" id="box-news">
        <div class="fix">
            <div class="layout">
                <div class="layout-left">

                    <ul class="breadCrumb clearFix">
                        <li><a href="{{url('/')}}">{{trans('common.home_cate')}}</a></li>
                        <li class="active">{{$category->title}}</li>
                    </ul>

                    <article class="detail" id="data-detail">
                        <h1 class="title">{{$category->title}}</h1>
                        @php
                            $postSorts = $posts->sortBy('title');
                            $postSplice = $postSorts->splice(round($postSorts->count()/2));
                        @endphp
                        <div class="data">
                            <div class="col-left">
                                <ul class="list">
                                    @foreach ($postSorts as $post)
                                        <li><a href="{{url(str_slug($post->title.' '.$post->id))}}">{{str_limit($post->title, env('TITLE_TRIM'))}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-right">
                                <ul class="list">
                                    @foreach ($postSplice as $post)
                                        <li><a href="{{url(str_slug($post->title.' '.$post->id))}}">{{str_limit($post->title, env('TITLE_TRIM'))}}</a></li>

                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </article>
                    <div class="box-paging">
                        @include('frontend.pagination', ['paginate' => $posts])
                    </div>
                </div>

                @include('frontend.tracuu-right-menu', ['list' => $list])
            </div>
        </div>
        @include('frontend.foot-slide')
    </section>
@endsection
