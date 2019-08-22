<div class="form-group">
     {!! Form::label('name', 'Tên') !!}
     {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group">
     {!! Form::label('value', 'Giá trị') !!}
     {!! Form::textarea('value', null, ['class' => 'form-control']) !!}
</div>

  <div class="form-group">
        {!! Form::submit($submitText, ['class' => 'btn btn-primary form-control']) !!}
  </div>