@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{trans('common.post')}}</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel-heading">
                <div class="input-group custom-search-form">
                    {!! Form::open(['method' => 'GET', 'route' =>  ['posts.index'] ]) !!}
                    <input type="text" value="{{$searchPost}}" name="q" class="form-control" placeholder="Search post..">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('common.post_list_title_label')}}</th>
                                <th>{{trans('common.post_list_desc_label')}}</th>
                                <th>{{trans('common.post_list_category_label')}}</th>
                                <th>{{trans('common.post_list_image_label')}}</th>

                                <th>{{trans('common.post_list_status_label')}}</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{ str_limit($post->desc, 50) }}</td>
                                <td>{{ $post->category->title }}</td>
                                <td><img src="{{url('cache/small/'.  \App\ImageReverse::img($post->image))}}" /></td>

                                <td>{{ $post->status }}</td>
                                <td>
                                    <button id-attr="{{$post->id}}" class="btn btn-primary btn-sm edit-post" type="button">{{trans('common.button_edit')}}</button>&nbsp;
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['posts.destroy', $post->id]]) !!}<br />
                                    <button type="submit" class="btn btn-danger btn-mini">{{trans('common.button_delete')}}</button>
                                    {!! Form::close() !!}<br />
                                    <button sub-id-attr="{{$post->id}}" sub-slug="{{str_slug($post->title)}}" class="btn btn-primary btn-sm view-post" type="button">Xem</button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-primary add-post" type="button">{{trans('common.button_add')}}</button>
                    <div class="row">
                        <div class="col-sm-6">{!!$posts->render()!!}</div>
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
            $('.add-post').click(function(){
                window.location.href = window.baseUrl + '/admin/posts/create';
            });
            $('.edit-post').click(function(){
                window.location.href = window.baseUrl + '/admin/posts/' + $(this).attr('id-attr') + '/edit';
            });
            $('.view-post').click(function(){
                window.open(window.baseUrl + '/' +  $(this).attr('sub-slug') + '-' + $(this).attr('sub-id-attr'));
            });
        });
    </script>
@endsection