<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	{!! Form::label('name', 'Nama', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-6">
		{!! Form::text('name', null, ['class' => 'form-control']) !!}
		<strong>{!! $errors->first('name', '<p class="help-block">:message</p>') !!}</strong>
	</div>
</div>

<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
	</div>
</div>