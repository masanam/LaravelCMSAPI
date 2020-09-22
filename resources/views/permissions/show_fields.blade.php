<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:', ['class' => 'd-block']) !!}
    <p>{!! $permission->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:', ['class' => 'd-block']) !!}
    <p>{!! $permission->name !!}</p>
</div>

<!-- Guard Name Field -->
<div class="form-group">
    {!! Form::label('guard_name', 'Guard Name:', ['class' => 'd-block']) !!}
    <p>{!! $permission->guard_name !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:', ['class' => 'd-block']) !!}
    <p>{!! $permission->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:', ['class' => 'd-block']) !!}
    <p>{!! $permission->updated_at !!}</p>
</div>

