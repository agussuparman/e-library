@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li class="active">Edit Profil</li>
				</ul>
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Edit Profil</div>
					</div>
					<div class="panel-body">
						{!! Form::model(auth()->user(), ['url' => url('/settings/profile'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
							<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
								{!! Form::label('name', 'Nama', ['class' => 'col-md-2 control-label']) !!}
								<div class="col-md-6">
									{!! Form::text('name', null, ['class' => 'form-control']) !!}
									<strong>{!! $errors->first('name', '<p class="help-block">:message</p>') !!}</strong>
								</div>
							</div>

							<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
								{!! Form::label('email', 'Alamat Email', ['class' => 'col-md-2 control-label']) !!}
								<div class="col-md-6">
									{!! Form::email('email', null, ['class' => 'form-control']) !!}
									<strong>{!! $errors->first('email', '<p class="help-block">:message</p>') !!}</strong>
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