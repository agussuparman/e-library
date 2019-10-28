@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li class="active">Member</li>
				</ul>
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Member</div>
					</div>
					<div class="panel-body">
						<p><a href="{{ url('/admin/members/create') }}" class="btn btn-primary">Buat Member</a></p>

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