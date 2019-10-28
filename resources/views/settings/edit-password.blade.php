@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li class="active">Edit Password</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title">Edit Password</div>
					</div>
					<div class="panel-body">
						{!! Form::open(['url' => url('/settings/password'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
							<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
								{!! Form::label('password', 'Password Lama', ['class' => 'col-md-2 control-label']) !!}
								<div class="col-md-6">
									{!! Form::password('password', ['class' => 'form-control']) !!}
									<strong>{!! $errors->first('password', '<p class="help-block">:message</p>') !!}</strong>
								</div>
							</div>

							<div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
								{!! Form::label('new_password', 'Password Baru', ['class' => 'col-md-2 control-label']) !!}
								<div class="col-md-6">
									{!! Form::password('new_password', ['class' => 'form-control']) !!}
									<strong>{!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}</strong>
								</div>
							</div>

							<div class="form-group {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}">
								{!! Form::label('new_password_confirmation', 'Konfirmasi Password Baru', ['class' => 'col-md-2 control-label']) !!}
								<div class="col-md-6">
									{!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
									<strong>{!! $errors->first('new_password_confirmation', '<p class="help-block">:message</p>') !!}</strong>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-4 col-md-offset-2">
									{!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection