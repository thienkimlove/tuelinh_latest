@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Giải thưởng</h1>
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
                                <th>Year</th>
                                <th>Ảnh</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($awards as $award)
                            <tr>
                                <td>{{$award->id}}</td>
                                <td>{{$award->year}}</td>
                                <td><img src="{{url('cache/small/'.  \App\ImageReverse::img($award->image))}}" /></td>
                                <td>
                                    <button id-attr="{{$award->id}}" class="btn btn-primary btn-sm edit-award" type="button">Edit</button>&nbsp;
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['awards.destroy', $award->id]]) !!}
                                    <button type="submit" class="btn btn-danger btn-mini">Xóa</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-primary add-award" type="button">Add</button>
                    <div class="row">
                        <div class="col-sm-6">{!!$awards->render()!!}</div>
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
            $('.add-award').click(function(){
                window.location.href = window.baseUrl + '/admin/awards/create';
            });
            $('.edit-award').click(function(){
                window.location.href = window.baseUrl + '/admin/awards/' + $(this).attr('id-attr') + '/edit';
            });
        });
    </script>
@endsection