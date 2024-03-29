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
						Selamat datang di Menu Administrasi E-Library.
						<hr>
						<p>Statistik Penulis</p>
						<canvas id="chartPenulis" width="400" height="150"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset("/js/Chart.min.js") }}"></script>
	<script type="text/javascript">
		var data = {
			labels: {!! json_encode($authors) !!},
			datasets: [{
				label: 'Jumlah buku',
				data: {!! json_encode($books) !!},
				backgroundColor: "rgba(151,187,205,0.5)",
				borderColor: "rgba(151,187,205,0.8)",
			}]
		};
		var options = {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true,
						stepSize: 1
					}
				}]
			}
		};
		var ctx = document.getElementById("chartPenulis").getContext("2d");
		var authorChart = new Chart(ctx, {
			type: 'bar',
			data: data,
			options: options
		});
	</script>
@endsection