<div class="box-utility">
    <div class="list-utility">
	@if (App::getLocale() == 'vi')
	<div class="item">
        <a href="{{url('dai-cuong-ve-benh')}}"><img src="{{url('images/bg/bg_u1.png')}}" alt="B1"></a>
	</div>
	<div class="item">
        <a href="{{url('tim-thuoc-theo-benh')}}"><img src="{{url('images/bg/bg_u2.png')}}" alt="B1"></a>
	</div>
	<div class="item">
        <a href="{{url('thuoc-nam-tri-benh')}}"><img src="{{url('images/bg/bg_u3.png')}}" alt="B1"></a>
	</div>	
	@elseif (App::getLocale() == 'en')
	<div class="item">
	    <a href="{{url('dai-cuong-ve-benh')}}"><img src="{{url('images/bg/bg_u1_en.png')}}" alt="B1"></a>
	</div>
	<div class="item">
        <a href="{{url('tim-thuoc-theo-benh')}}"><img src="{{url('images/bg/bg_u2_en.png')}}" alt="B1"></a>
	</div>
	<div class="item">
        <a href="{{url('thuoc-nam-tri-benh')}}"><img src="{{url('images/bg/bg_u3_en.png')}}" alt="B1"></a>
	</div>
	@endif
    </div>
</div>