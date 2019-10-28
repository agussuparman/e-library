@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Home</a></li>
					<li><a href="{{ route('books.index') }}">Buku</a></li>
					<li class="active">Export Buku</li>
				</ul>
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Export Buku</div>
					</div>
					<div class="panel-body">
						{!! Form::open(['url' => route('export.books.post'), 'method' => 'post', 'files' => true, 'class' => 'form-horizontal']) !!}
							<div class="form-group {{ $errors->has('author_id') ? 'has-error' : '' }}">
								{!! Form::label('author_id', 'Penulis', ['class' => 'col-md-2 control-label']) !!}
								<div class="col-md-6">
									{!! Form::select('author_id[]', ['' => '']+App\Author::pluck('name', 'id')->all(), null, [
										'class' => 'js-selectize', 'multiple', 'placeholder' => 'Pilih Penulis']) !!}
									<strong>{!! $errors->first('author_id', '<p class="help-block">:message</p>') !!}</strong>
								</div>
							</div>
							<div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
								{!! Form::label('type', 'Pilih Output', ['class' => 'col-md-2 control-label']) !!}
								<div class="col-md-6">
									{{ Form::radio('type', 'xls', true) }} Excel
									{{ Form::radio('type', 'pdf') }} PDF
									{!! $errors->first('type', '<p class="help-block">:message</p>') !!}
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-2">
									{!! Form::submit('Download', ['class' => 'btn btn-primary']) !!}
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection