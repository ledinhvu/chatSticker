<!-- Key Field -->
<div class="form-group col-sm-6">
    {!! Form::label('key', 'Key:') !!}
    {!! Form::text('key', null, ['class' => 'form-control']) !!}
</div>

<div class="col-lg-12">
    <div class="form-group">
        {{ Form::file('image',['class' => 'control','id' => 'files', 'multiple' => 'multiple']) }}
    </div>
    <div id="selectedFiles"></div>
</div

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('images.index') !!}" class="btn btn-default">Cancel</a>
</div>
