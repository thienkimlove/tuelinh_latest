<section class="box-slide-foot">
    <div class="fix">
        <h2 class="title wow bounce-in-left" data-wow-duration="1s">{{trans('common.index_san_pham')}}</h2>
        <div class="box-slide-products">
            <div class="owl-carousel" id="box-slide-foot">
                @foreach ($slidePosts as $slidePost)
                    <div class="item">
                        <a href="{{url(str_slug($slidePost->title.' '.$slidePost->id))}}" title="">
                            @if ($slidePost->footer_image)
                                <img src="{{url('cache/263x313', $slidePost->footer_image)}}"  alt=""/>
                            @else
                                <img src="{{url('cache/263x313', $slidePost->image)}}"  alt=""/>
                            @endif
                        </a>
                        <div class="info-foot">
                            <h3><a href="{{url(str_slug($slidePost->title.' '.$slidePost->id))}}">{{$slidePost->title}}</a></h3>
                            <p class="des">{{$slidePost->desc}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>