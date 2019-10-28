@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Daftar Buku</div>
					</div>
					<div class="panel-body">
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