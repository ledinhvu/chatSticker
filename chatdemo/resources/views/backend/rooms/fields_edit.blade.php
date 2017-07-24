<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'rooms-textarea']) !!}
</div>

<!-- Role Field -->
<div class="form-group col-sm-6">	
    {!! Form::label('role', 'Role') !!}
    <select name="role" class="form-control">
    	<option @if(($rooms->role)== '1') selected @endif value="1">Public</option>
        <option @if(($rooms->role)== '2') selected @endif value="2">Protected</option>
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('rooms.index') !!}" class="btn btn-default">Cancel</a>
</div>