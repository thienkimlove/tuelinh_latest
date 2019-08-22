@extends('admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tag</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <h2>Tag</h2>
            {!! Form::model($tag,['method' => 'PATCH', 'route' => ['tags.update', $tag->id], 'files' => true]) !!}

            <div class="form-group">
                {!! Form::label('banner_link', 'Link') !!}
                {!! Form::text('banner_link', $tag->banner_link, ['class' => 'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('banner_image', 'Image') !!}
                @if ($tag->banner_image)
                    <img src="{{url('cache/small/' .$tag->banner_image)}}" />
                    <hr>
                @endif
                {!! Form::file('banner_image', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>

            {!! Form::close() !!}
            @include('errors.list')

        </div>
    </div>
@stop