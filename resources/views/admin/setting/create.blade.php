@extends('admin')

@section('content')
    @include('admin.setting.heading')
    <div class="row">
        <div class="col-lg-6">
            <h2>Thêm Tùy chọn</h2>
            {!! Form::model($setting = new App\Setting, ['route' => ['settings.store']]) !!}
            @include('admin.setting.form', ['submitText' => 'Thêm Tùy chọn'])
            {!! Form::close() !!}
            @include('errors.list')

        </div>
    </div>
@stop