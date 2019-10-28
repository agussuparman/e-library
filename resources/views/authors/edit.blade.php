@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Home</a></li>
					<li><a href="{{ route('authors.index') }}">Penulis</a></li>
					<li class="active">Edit Penulis</li>
				</ul>
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Edit Penulis</div>
					</div>
					<div class="panel-body">
						{!! Form::model($author, ['url' => route('authors.update', $author->id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
							@include('authors._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection