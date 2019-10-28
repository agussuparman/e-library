<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
	{!! Form::label('title', 'Judul', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-6">
		{!! Form::text('title', null, ['class' => 'form-control']) !!}
		<strong>{!! $errors->first('title', '<p class="help-block">:message</p>') !!}</strong>
	</div>
</div>

<div class="form-group {{ $errors->has('author_id') ? 'has-error' : '' }}">
	{!! Form::label('author_id', 'Penulis', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-6">
		{!! Form::select('author_id', ['' => '']+App\Author::pluck('name', 'id')->all(), null, [
			'class' => 'js-selectize', 'placeholder' => 'Pilih Penulis']) !!}
		<strong>{!! $errors->first('author_id', '<p class="help-block">:message</p>') !!}</strong>
	</div>
</div>

<div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
	{!! Form::label('amount', 'Jumlah', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-6">
		{!! Form::number('amount', null, ['class' => 'form-control']) !!}
		<strong>{!! $errors->first('amount', '<p class="help-block">:message</p>') !!}</strong>
		@if(isset($book))
			<strong><p class="help-block">{{ $book->borrowed }} buku sedang dipinjam</p></strong>
		@endif
	</div>
</div>

<div class="form-group {{ $errors->has('cover') ? 'has-error' : '' }}">
	{!! Form::label('cover', 'Cover', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-md-6">
		{!! Form::file('cover', ['class' => 'filestyle']) !!}
		<br>
		@if(isset($book) && $book->cover)
			{!! Html::image(asset('img/' . $book->cover), null, ['class' => 'img-rounded img-responsive']) !!}
		@endif
		<strong>{!! $errors->first('cover', '<p class="help-block">:message</p>') !!}</strong>
	</div>
</div>

<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
	</div>
</div>