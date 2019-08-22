@extends('admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{trans('common.delivery')}}</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <h2>{{trans('common.delivery_form_title')}}</h2>
            @if(!empty($delivery))
            {!! Form::model($delivery,['method' => 'PATCH', 'route' => ['deliveries.update', $delivery->id]]) !!}

            @else
            {!! Form::model($delivery = new App\Delivery,['route' => ['deliveries.store']]) !!}
            @endif
            <div class="form-group">
                {!! Form::label('city_id', trans('common.delivery_form_city_label')) !!}
                {!! Form::select('city_id', $cities, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('title', trans('common.delivery_form_title_label')) !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('address', trans('common.delivery_form_address_label')) !!}
                {!! Form::text('address', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('phone', trans('common.delivery_form_phone_label')) !!}
                {!! Form::text('phone', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('area', trans('common.delivery_form_area_label')) !!}
                {!! Form::select('area', $areas, null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('product_id', 'Product') !!}
                {!! Form::select('product_id', $products, null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>

            {!! Form::close() !!}
            @include('errors.list')

        </div>
    </div>
@stop