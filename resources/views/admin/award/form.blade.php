@extends('admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Giải thưởng</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            @if(!empty($award))
            {!! Form::model($award,['method' => 'PATCH', 'route' => ['awards.update', $award->id], 'files' => true]) !!}

            @else
            {!! Form::model($award = new App\Award,['route' => ['awards.store'], 'files' => true]) !!}
            @endif

            <div class="form-group">
            {!! Form::label('year', 'Year') !!}
            {!! Form::text('year', null, ['class' => 'form-control']) !!}



            <div class="form-group">
                {!! Form::label('image', 'Image') !!}
                @if ($award->image)
                    <img src="{{url('cache/small/' .$award->image)}}" />
                    <hr>
                @endif
                {!! Form::file('image', null, ['class' => 'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>

            {!! Form::close() !!}
            @include('errors.list')

        </div>
    </div>
@stop