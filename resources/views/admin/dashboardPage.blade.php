@extends('layouts.admin.master')

@section('title', "Dashboard")

@section('content')
	<div class="container-fluid mt-n10">

		<div class="col-lg-12 mb-4">
      <!-- Project Card Example -->
      <div class="card shadow mb-4">
        <div class="card-body">
          <p class="fs-5 text-justify">Selamat datang di aplikasi <span class="fs-4 fw-bold">SIMPERS</span> (Sistem Informasi Penyimpanan Data Personel) Disminpers Koarmada I, aplikasi ini adalah tool untuk mempermudah proses layanan penyimpanan data personel di lingkungan Mako Koarmada I. Dengan aplikasi ini layanan penyimpanan data personel dapat dilaksanakan secara efektif dan efisien.</p>
         </div>
        </div>
      </div>    	

		<!-- Content Row -->

		<div class="row">

			<div class="col-lg-6 mb-4">
        <!-- Project Card Example -->
        <div class="card shadow mb-4">
        	<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Personel Per Jenis</h6>
					</div>
          <div class="card-body">
          	<div class="chart-pie pt-4 pb-2">
              <canvas id="myPieChartPusat"></canvas>
            </div>
          </div>
        </div>
    	</div>

    	<div class="col-lg-6 mb-4">
        <!-- Project Card Example -->
        <div class="card shadow mb-4">
        	<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Personel Per Jenis Kelamin</h6>
					</div>
          <div class="card-body">
          		<div class="chart-pie pt-4 pb-2">
              <canvas id="myPieChartDaerah"></canvas>
            </div>
          </div>
        </div>
    	</div>

			<!-- Pie Chart -->
			<div class="col-xl-12 col-lg-12">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div
						class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Progres Arsip</h6>
					</div>
					<!-- Card Body -->
					<div class="card-body">
						@if(isset($arsip))
						<div class="progress" role="progressbar" aria-label="Default striped example" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
							@php($width = $arsip['ref'] > 0 ? $arsip['jml'] / $arsip['ref'] : 0)
					  	<div class="progress-bar progress-bar-striped" style="width: {{$width * 100}}%"> {{number_format($width * 100, 2)}} % </div>
						</div>

						<!--<div class="progress-stacked mt-3">
						  <div class="progress" role="progressbar" aria-label="Segment one" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 15%">
						    <div class="progress-bar">PNS</div>
						  </div>
						  <div class="progress" role="progressbar" aria-label="Segment two" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
						    <div class="progress-bar bg-success">Militer</div>
						  </div>
						</div>-->

						<div class="d-flex justify-content-between align-items-center gap-3 mt-3">
							<div class="shadow card card-body bg-primary text-light h3 text-center">Jumlah Data : {{$arsip['ref']}}</div>
							<div class="shadow card card-body bg-success text-light h3 text-center">Jumlah Arsip : {{$arsip['jml']}}</div>
						</div>
						
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
@endsection

@section('js-content')

<script type="text/javascript">
	window.onload = (event)=> {
		let myAlert = document.querySelector('.toast');
		if(myAlert){
			let bsAlert = new bootstrap.Toast(myAlert);
			bsAlert.show();	
		}
	}
</script>
@endsection
	