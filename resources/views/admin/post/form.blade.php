@extends('admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{trans('common.post')}}</h1>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <h2>{{trans('common.post_form_title')}}</h2>
            @if(!empty($post))
            {!! Form::model($post,['method' => 'PATCH', 'route' => ['posts.update', $post->id], 'files' => true]) !!}

            @else
            {!! Form::model($post = new App\Post,['route' => ['posts.store'], 'files' => true]) !!}
            @endif

            @foreach(['vi', 'en', 'fr'] as $lang)
                <div class="form-group">
                    {!! Form::label('title_'.$lang, trans('common.post_form_title_label_'.$lang)) !!}
                    {!! Form::text('title_'.$lang, $post->translateOrNew($lang)->title, ['class' => 'form-control']) !!}
                </div>
            @endforeach


            <div class="form-group">
                {!! Form::label('tieude', trans('common.post_form_tieude_label_vi')) !!}
                {!! Form::text('tieude', null, ['class' => 'form-control']) !!}
            </div>



            <div class="form-group">
                {!! Form::label('image', 'Image') !!}
                @if ($post->image)
                    <img src="{{url('cache/small/' .$post->image)}}" />
                    <hr>
                @endif
                {!! Form::file('image', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('footer_image', 'Image for Footer Slider') !!}
                @if ($post->footer_image)
                    <img src="{{url('cache/small/' .$post->footer_image)}}" />
                    <hr>
                @endif
                {!! Form::file('footer_image', null, ['class' => 'form-control']) !!}
            </div>

            @foreach(['vi', 'en', 'fr'] as $lang)
                <div class="form-group">
                    {!! Form::label('desc_'.$lang, trans('common.post_form_desc_label_'.$lang)) !!}
                    {!! Form::textarea('desc_'.$lang, $post->translateOrNew($lang)->desc, ['class' => 'form-control']) !!}
                </div>
            @endforeach

            @foreach(['vi', 'en', 'fr'] as $lang)
                <div class="form-group">
                    {!! Form::label('content_'.$lang, trans('common.post_form_content_label_'.$lang)) !!}
                    {!! Form::textarea('content_'.$lang, $post->translateOrNew($lang)->content, ['class' => 'form-control ckeditor']) !!}
                </div>
            @endforeach

            <div class="form-group">
                {!! Form::label('category_id', trans('common.post_form_category_label')) !!}
                {!! Form::select('category_id', $display, null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tag_list', trans('common.post_form_tag_label')) !!}
                {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
            </div>

            @foreach ($modules as $key => $module)
            <div class="form-group">

                {!! Form::label('modules['.$key.']', $module) !!}

                    {!! Form::checkbox('modules['.$key.'][display]', null, $post->modules->contains('slug', $key)) !!}

                    {!! Form::text('modules['.$key.'][order]', ($post->modules->where('slug', $key)->first()) ? $post->modules->where('slug', $key)->first()->order : 0) !!}

            </div>
            @endforeach

            <div class="form-group">
                {!! Form::label('status', trans('common.post_form_status_label')) !!}
                {!! Form::checkbox('status', null, null) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>

            {!! Form::close() !!}
            @include('errors.list')

        </div>
    </div>
@stop
@section('footer')
    <script>
        $('#tag_list').select2({
            placeholder : 'Choose a tag',
            tags : true //allow to add new tag which not in list.
        });
    </script>
@endsection