@extends('admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Hội đồng</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <h2>Hội đồng thành viên</h2>
            @if(!empty($friend))
            {!! Form::model($friend,['method' => 'PATCH', 'route' => ['friends.update', $friend->id], 'files' => true]) !!}

            @else
            {!! Form::model($friend = new App\Friend,['route' => ['friends.store'], 'files' => true]) !!}
            @endif

            @foreach(['vi', 'en', 'fr'] as $lang)
                <div class="form-group">
                    {!! Form::label('title_'.$lang, 'Tên - '.$lang. ':' ) !!}
                    {!! Form::text('title_'.$lang, $friend->translateOrNew($lang)->title, ['class' => 'form-control']) !!}
                </div>
            @endforeach



            <div class="form-group">
                {!! Form::label('image', 'Image') !!}
                @if ($friend->image)
                    <img src="{{url('cache/small/' .$friend->image)}}" />
                    <hr>
                @endif
                {!! Form::file('image', null, ['class' => 'form-control']) !!}
            </div>

            @foreach(['vi', 'en', 'fr'] as $lang)
                <div class="form-group">
                    {!! Form::label('desc_'.$lang, 'Chức danh - '.$lang. ':' ) !!}
                    {!! Form::textarea('desc_'.$lang, $friend->translateOrNew($lang)->desc, ['class' => 'form-control']) !!}
                </div>
            @endforeach


            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>

            {!! Form::close() !!}
            @include('errors.list')

        </div>
    </div>
@stop