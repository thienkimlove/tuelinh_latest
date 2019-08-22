@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{trans('common.delivery')}}</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>Import XLS File</h2>
                            {!! Form::open(['url' => url('importXls'), 'files' => true]) !!}

                            <div class="form-group">
                                {!! Form::label('Product Name') !!}
                                {!! Form::text('name', null, array('placeholder'=>'Ca Dua Leo')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('XLS File (Please upload file to public folder first)') !!}
                                {!! Form::text('file_path', 'ca-gai-leo.xls') !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Submit!') !!}
                            </div>
                            {!! Form::close() !!}
                            @include('errors.list')
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('common.delivery_list_city_label')}}</th>
                                <th>Product</th>
                                <th>{{trans('common.delivery_list_title_label')}}</th>
                                <th>{{trans('common.delivery_list_address_label')}}</th>
                                <th>{{trans('common.delivery_list_phone_label')}}</th>
                                
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deliveries as $cat)
                            <tr>
                                <td>{{$cat->id}}</td>
                                <td>{{$cat->city->name}}</td>
                                <td>{{$cat->product->name}}</td>
                                <td>{{$cat->title}}</td>
                                <td>{{$cat->address}}</td>
                                <td>{{$cat->phone}}</td>
                                <td>
                                    <button id-attr="{{$cat->id}}" class="btn btn-primary btn-sm edit-delivery" type="button">{{trans('common.button_edit')}}</button>&nbsp;
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['deliveries.destroy', $cat->id]]) !!}
                                    <button type="submit" class="btn btn-danger btn-mini">{{trans('common.button_delete')}}</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-primary add-delivery" type="button">{{trans('common.button_add')}}</button>
                    <div class="row">
                        <div class="col-sm-6">{!!$deliveries->render()!!}</div>
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
            $('.add-delivery').click(function(){
                window.location.href = window.baseUrl + '/admin/deliveries/create';
            });
            $('.edit-delivery').click(function(){
                window.location.href = window.baseUrl + '/admin/deliveries/' + $(this).attr('id-attr') + '/edit';
            });
        });
    </script>
@endsection