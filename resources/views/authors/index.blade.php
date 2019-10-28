@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Home</a></li>
					<li class="active">Penulis</li>
				</ul>
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Penulis</div>
					</div>
					<div class="panel-body">
						<p><a href="{{ route('authors.create') }}" class="btn btn-primary">Buat Penulis</a></p>
						{!! $html->table(['class' => 'table-striped']) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	{!! $html->scripts() !!}
@endsection