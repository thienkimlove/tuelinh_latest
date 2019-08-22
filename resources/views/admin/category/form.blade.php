@extends('admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{trans('common.category')}}</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <h2>{{trans('common.category_form_title')}}</h2>
            @if(!empty($category))
            {!! Form::model($category,['method' => 'PATCH', 'route' => ['categories.update', $category->id]]) !!}

            @else
            {!! Form::model($category = new App\Category,['route' => ['categories.store']]) !!}
            @endif

            @foreach(['vi', 'en', 'fr'] as $lang)
                <div class="form-group">
                    {!! Form::label('title_'.$lang, trans('common.category_form_title_label_'.$lang)) !!}
                    {!! Form::text('title_'.$lang, !empty($category->translate($lang)) ? $category->translate($lang)->title : null, ['class' => 'form-control']) !!}
                </div>
            @endforeach


            @foreach(['vi', 'en', 'fr'] as $lang)
                <div class="form-group">
                    {!! Form::label('seo_title_'.$lang, 'SEO title '.$lang) !!}
                    {!! Form::text('seo_title_'.$lang, !empty($category->translate($lang)) ? $category->translate($lang)->seo_title : null, ['class' => 'form-control']) !!}
                </div>
            @endforeach


            <div class="form-group">
                {!! Form::label('parent_id', trans('common.parent_category')) !!}
                {!! Form::select('parent_id', $display, null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>

            {!! Form::close() !!}
            @include('errors.list')

        </div>
    </div>
@stop