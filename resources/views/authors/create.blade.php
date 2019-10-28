@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Home</a></li>
					<li><a href="{{ route('authors.index') }}">Penulis</a></li>
					<li class="active">Tambah Penulis</li>
				</ul>
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Tambah Penulis</div>
					</div>
					<div class="panel-body">
						{!! Form::open(['url' => route('authors.store'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
							@include('authors._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection