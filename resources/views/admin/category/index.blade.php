@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{trans('common.category')}}</h1>
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
                                <th>{{trans('common.category_list_title_label')}}</th>
                                <th>{{trans('common.category_list_parent_label')}}</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $cat)
                            <tr>
                                <td>{{$cat->id}}</td>
                                <td><a href="{{url('admin/categories/'. $cat->id)}}">{{$cat->title}}</a></td>
                                <td>
                                    @if ($cat->parent_id)
                                       @if ($cat->parent)
                                       {{ $cat->parent->title }}
                                       @else
                                           Bạn đã xóa thư mục cha của thư mục này, <a href="{{url('admin/categories/'. $cat->id.'/edit')}}">bấm vào đây để chọn cha mới</a>.
                                       @endif
                                    @endif
                                </td>
                                <td>
                                    <button id-attr="{{$cat->id}}" class="btn btn-primary btn-sm edit-category" type="button">{{trans('common.button_edit')}}</button>&nbsp;
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $cat->id]]) !!}
                                    <button type="submit" class="btn btn-danger btn-mini">{{trans('common.button_delete')}}</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-primary add-category" type="button">{{trans('common.button_add')}}</button>
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
            $('.add-category').click(function(){
                window.location.href = window.baseUrl + '/admin/categories/create';
            });
            $('.edit-category').click(function(){
                window.location.href = window.baseUrl + '/admin/categories/' + $(this).attr('id-attr') + '/edit';
            });
        });
    </script>
@endsection