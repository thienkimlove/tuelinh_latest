@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Hội đồng</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Chức danh</th>
                                <th>Ảnh</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($friends as $friend)
                            <tr>
                                <td>{{$friend->id}}</td>
                                <td>{{$friend->title}}</td>
                                <td>{{ str_limit($friend->desc, 50) }}</td>
                                <td><img src="{{url('cache/small/'.  \App\ImageReverse::img($friend->image))}}" /></td>
                                <td>
                                    <button id-attr="{{$friend->id}}" class="btn btn-primary btn-sm edit-friend" type="button">Edit</button>&nbsp;
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['friends.destroy', $friend->id]]) !!}
                                    <button type="submit" class="btn btn-danger btn-mini">Xóa</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-primary add-friend" type="button">Add</button>
                    <div class="row">
                        <div class="col-sm-6">{!!$friends->render()!!}</div>
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
            $('.add-friend').click(function(){
                window.location.href = window.baseUrl + '/admin/friends/create';
            });
            $('.edit-friend').click(function(){
                window.location.href = window.baseUrl + '/admin/friends/' + $(this).attr('id-attr') + '/edit';
            });
        });
    </script>
@endsection