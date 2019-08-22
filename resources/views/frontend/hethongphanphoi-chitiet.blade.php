@extends('frontend')
@section('content')
    <section data-position="true" class="box-news" id="box-news">
        <div class="fix">
            <div class="layout">

                <ul class="breadCrumb clearFix">
                    <li><a href="{{url('/')}}">{{trans('common.home_cate')}}</a></li>
                    <li><a href="{{url('he-thong-phan-phoi')}}">{{trans('common.phanphoi_title')}}</a></li>
                    <li class="active">{{$product->name}}</li>
                </ul>

                <div class="box-distribution">
                    <h1 class="title">{{trans('common.phanphoi_tieude_chitiet')}} {{$city->name}} {{trans('common.phanphoi_tieude_chitiet1')}} {{$product->name}}</h1>
                    <div class="filter">
                        <div class="group">
                            <div class="order">
                                <div class="option" style="float:left">
                                    <input id="back-to-phan-phoi" type="button" value="Back" class="btn-search">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table table01">
                        <div class="row row01">
                            <div class="cel bg01">{{trans('common.phanphoi_stt')}}</div>
                            <div class="cel bg02 taC">{{trans('common.phanphoi_nhathuoc')}}</div>
                            <div class="cel bg02 taC">{{trans('common.phanphoi_diachi')}}</div>
                            <div class="cel bg02 taC">{{trans('common.phanphoi_sdt')}}</div>
                            <div class="cel bg02 taC">{{trans('common.phanphoi_sp')}}</div>
                        </div>
                       @foreach ($deliveries as $k => $delivery)
                       <div class="row{{($k % 2 == 0)? ' bg' : ''}}">
                            <div class="cel bg03">{{$k+1}}</div>
                              <div class="cel taC">{{$delivery->title}}</div>
                              <div class="cel taC">{{$delivery->address}}</div>
                              <div class="cel taC">{{$delivery->phone}}</div>
                              <div class="cel taC">{{$delivery->product->name}}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection