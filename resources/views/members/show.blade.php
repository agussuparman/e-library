@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li><a href="{{ route('members.index') }}">Member</a></li>
					<li class="active">Detail {{ $member->name }}</li>
				</ul>
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">
							Detail {{ $member->name }}
						</div>
					</div>
					<div class="panel-body">
						<p class="text-muted">Buku yang sedang dipinjam</p>
						<table class="table table-condensed table-striped">
							<thead>
								<tr>
									<th>Judul</th>
									<th>Tanggal Pinjam</th>
								</tr>
							</thead>
							<tbody>
								@forelse($member->borrowLogs()->borrowed()->get() as $log)
									<tr>
										<td>{{ $log->book->title }}</td>
										<td>{{ $log->created_at }}</td>
									</tr>
								@empty
									<tr>
										<td colspan="2">Tidak ada data</td>
									</tr>
								@endforelse
							</tbody>
						</table>
						<p class="text-muted">Buku yang dikembalikan</p>
						<table class="table table-condensed table-striped">
							<thead>
								<tr>
									<th>Judul</th>
									<th>Tanggal Kembali</th>
								</tr>
							</thead>
							<tbody>
								@forelse($member->borrowLogs()->returned()->get() as $log)
									<tr>
										<td>{{ $log->book->title }}</td>
										<td>{{ $log->updated_at }}</td>
									</tr>
								@empty
									<tr>
										<td colspan="2">Tidak ada data</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection