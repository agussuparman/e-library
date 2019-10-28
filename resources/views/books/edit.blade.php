@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Home</a></li>
					<li><a href="{{ route('books.index') }}">Buku</a></li>
					<li class="active">Edit Buku</li>
				</ul>
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Edit Buku</div>
					</div>
					<div class="panel-body">
						{!! Form::model($book, ['url' => route('books.update', $book->id), 'method' => 'put', 'files' => true, 'class' => 'form-horizontal']) !!}
							@include('books._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection