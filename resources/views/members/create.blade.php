@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li><a href="{{ route('members.index') }}">Member</a></li>
					<li class="active">Tambah Member</li>
				</ul>
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">
							Tambah Member
						</div>
					</div>
					<div class="panel-body">
						{!! Form::open(['url' => route('members.store'), 'method' => 'post', 'files' => true, 'class' => 'form-horizontal']) !!}
							@include('members._form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection