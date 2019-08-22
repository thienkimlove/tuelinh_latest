@extends('frontend')

@section('content')
    <section data-position="true" class="box-news" id="box-news">
        <div class="fix">
            <div class="layout">

                <ul class="breadCrumb clearFix">
                    <li><a href="{{url('/')}}">{{trans('common.home_cate')}}</a></li>
                    <li class="active">{{trans('common.lienhe_title')}}</li>
                </ul>

                <div class="box-contact">
                    <h1 class="title">{{trans('common.lienhe_title')}}</h1>
                    <div class="col-left">
                        <h3 class="head">{{trans('common.lienhe_diachi')}}</h3>
                        <ul>
                            <li><strong>{{trans('common.lienhe_hanoi')}}</strong></li>
                            <li>{{trans('common.lienhe_hanoi_diachi')}}</li>
                            <li>{{trans('common.lienhe_hanoi_dienthoai')}}</li>
                            <li>Fax: 024.62824263</li>
                            <li><strong>{{trans('common.lienhe_hcm')}}</strong></li>
                            <li>{{trans('common.lienhe_hcm_diachi')}}</li>
                            <li>{{trans('common.lienhe_hcm_dienthoai')}}</li>
                            <li>Fax: 0286.2646832.</li>
                            <li>{{trans('common.lienhe_hotline')}}</li>
                        </ul>
                        <div class="map-tuelinh">
                           <iframe frameborder="0" width="479" height="259" src="https://www.google.com/maps/place/C%C3%B4ng+ty+TNHH+Tu%E1%BB%87+Linh/@21.0078767,105.8010542,17z/data=!4m2!3m1!1s0x3135ab5a02fbb0f5:0x75b5e966c9fb8bc0"></iframe>
                        </div>
                    </div>
                    <div class="col-right">
                        <h3 class="head">{{trans('common.lienhe_guithu')}}</h3>
                        {!! Form::open(['method' => 'POST', 'route' => ['saveContact'], 'name' => 'questionForm']) !!}
                            <input type="text" name="name" class="txt txt-name" placeholder="Name"/>
                            <input type="email" name="email" class="txt txt-email" placeholder="Email"/>
                            <input type="number" name="phone" class="txt txt-phone" placeholder="Phone"/>
                            <input type="text" name="title" class="txt txt-name" placeholder="Title"/>
                            <select name="department" class="txt txt-name">
                                <option>{{trans('common.lienhe_phongban')}}</option>
                                @foreach ($departments as $department)
                                    <option value="{{$department}}">{{$department}}</option>
                                @endforeach
                            </select>
                            <textarea name="content" class="txt txt-content" placeholder="Text"></textarea>
                            <input type="submit" value="Send" class="btn btn-submit"/>
                            <input type="reset" value="Reset" class="btn btn-submit"/>
                       {!! Form::close() !!}
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        @include('frontend.foot-slide')
    </section><!--//box-solution-->
@endsection