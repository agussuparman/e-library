@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Dashboard</div>
					</div>
					<div class="panel-body">
						<div class="text-center">Selamat datang di E-Library.</div>
						<div class="table-responsive">
							<table class="table table-condensed table-striped table-hover">
								<thead>
									<tr>
										<th class="text-muted">Buku Dipinjam</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach($borrowLogs as $borrowLog)
									<tr>
										<td>
											{{ $borrowLog->book->title }}
										</td>
										<td>
											{!! Form::open(['url' => route('member.books.return', $borrowLog->book_id), 'method' => 'put', 'class' => 'form-inline js-confirm', 'data-confirm' => "Anda yakin ingin mengembalikan " . $borrowLog->book->title . "?"]) !!}
												{!! Form::submit('Kembalikan', ['class' => 'btn btn-xs btn-default']) !!}
											{!! Form::close() !!}
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection