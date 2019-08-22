@extends('admin')
@section('content')
    @include('admin.setting.heading')
    <div class="row" data-ng-controller="SettingIndex">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Hiện thị danh sách tùy chọn của trang web.
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Giá trị</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settings as $setting)
                                <tr>
                                    <td>{{$setting->id}}</td>
                                    <td>{{$setting->name}}</td>
                                    <td>{!! $setting->value !!}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm edit-setting" id-attr="{{$setting->id}}" type="button">Sửa</button>
                                        <br>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['settings.destroy', $setting->id]]) !!}
                                        <button type="submit" class="btn btn-danger btn-mini">Xóa</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">

                        <div class="col-sm-6">{!! $settings->render() !!}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><button class="btn btn-primary add-setting" type="button">Thêm</button></div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>

    </div>
@endsection

@section('footer')
    <script>
        $(function(){
            $('.add-setting').click(function(){
                window.location.href = window.baseUrl + '/admin/settings/create';
            });
            $('.edit-setting').click(function(){
                window.location.href = window.baseUrl + '/admin/settings/' + $(this).attr('id-attr') + '/edit';
            });
        });
    </script>
@endsection