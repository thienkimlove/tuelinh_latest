<div class="box-searchs">
    <div class="head">
       {{trans('common.righttimkiem_tieu_de')}}
    </div>
    <div class="search-q">
        {!! Form::open(['method' => 'GET', 'url' =>  url('tim-kiem'), 'name'=> 'rightForm' ]) !!}
            <input name="q" type="text" placeholder="">
            <a id="right_search_submit"  class="btn-search">{{trans('common.righttimkiem_tieu_de')}}</a>
        {!! Form::close() !!}
    </div>
</div>
