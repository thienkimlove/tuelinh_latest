@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tags</h1>
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
                                <th>Title</th>
                                <th>Banner</th>
                                <th>Link</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                            <tr>
                                <td>{{$tag->id}}</td>
                                <td>{{$tag->title}}</td>
                                <td>
                                    @if ($tag->banner_image)
                                    <img src="{{url('cache/small/'.  \App\ImageReverse::img($tag->banner_image))}}" />
                                    @else
                                        No Banner
                                    @endif
                                </td>
                                <td>{{ $tag->banner_link }}</td>
                                <td>
                                    <button id-attr="{{$tag->id}}" class="btn btn-primary btn-sm edit-tag" type="button">Edit</button>&nbsp;
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-6">{!!$tags->render()!!}</div>
                        </div>
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
            $('.edit-tag').click(function(){
                window.location.href = window.baseUrl + '/admin/tags/' + $(this).attr('id-attr') + '/edit';
            });
        });
    </script>
@endsection