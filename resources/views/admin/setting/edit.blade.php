@extends('admin')

@section('content')
  @include('admin.setting.heading')
  <div class="row">
      <div class="col-lg-6">
          <h2>Sửa tùy chọn "{{ $setting->name }}"</h2>
          {!! Form::model($setting, ['method' => 'PATCH', 'route' => ['settings.update', $setting->id]]) !!}
              @include('admin.setting.form', ['submitText' => 'Sửa'])
          {!! Form::close() !!}
          @include('errors.list')

      </div>
  </div>
@stop