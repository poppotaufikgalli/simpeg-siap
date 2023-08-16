@extends('layouts.admin.master')

@section('title', "Dashboard")

@section('content')
	<div class="container-fluid mt-n10">

		@php($border=['primary', 'success', 'info', 'danger', 'warning'])
		<!-- Content Row -->
		@if(isset($tipedokhukum))
		<div class="row">
			@php($n = 0)
			@foreach($tipedokhukum as $key => $value)
			<!-- Earnings (Monthly) Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-{{$border[$n]}} shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col d-flex gap-2">
								<div class="p-2 bg-{{$border[$n]}} rounded shadow">
									<h1 class="text-white font-weight-bold">{{count($value->ndokhukum)}}</h1>
								</div>
								<div class="text-xs font-weight-bold text-{{$border[$n]}}">
									{{$value->nama}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@php($n == 4 ? $n=0 : $n = $n+1)
			@endforeach
		</div>
		@endif

		<!-- Content Row -->

		<div class="row">

			<div class="col-lg-6 mb-4">
        <!-- Project Card Example -->
        <div class="card shadow mb-4">
        	<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Produk Hukum Pusat</h6>
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
						<h6 class="m-0 font-weight-bold text-primary">Produk Hukum Daerah</h6>
					</div>
          <div class="card-body">
          		<div class="chart-pie pt-4 pb-2">
              <canvas id="myPieChartDaerah"></canvas>
            </div>
          </div>
        </div>
    	</div>

			<!-- Area Chart -->
			<div class="col-xl-7 col-lg-7">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Produk Hukum Populer</h6>
					</div>
					<!-- Card Body -->
					<div class="card-body">
						@if(isset($produkhukum_populer))
						<ol class="list-group list-group-numbered lh-1">
							@foreach($produkhukum_populer as $key => $value)
								@if($value->klik > 0)
							  <li class="list-group-item d-flex justify-content-between align-items-start">
									<div class="ms-2 me-auto">
									  <div class="fw-bold">{{$value->judul_peraturan}}</div>
									  {{$value->tipe_dok_hukum}} / {{$value->jns_hukum}}
									</div>
									<span class="badge bg-primary rounded-pill">{{$value->klik}} Views</span>
							  </li>
							  @endif
						  @endforeach
						</ol>
						@endif
					</div>
				</div>
			</div>

			<!-- Pie Chart -->
			<div class="col-xl-5 col-lg-5">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div
						class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Konten Populer</h6>
					</div>
					<!-- Card Body -->
					<div class="card-body">
						@if(isset($konten_populer))
						<ol class="list-group list-group-numbered lh-1">
							@foreach($konten_populer as $key => $value)
								@if($value->klik > 0)
							  <li class="list-group-item d-flex justify-content-between align-items-start">
									<div class="ms-2 me-auto">
									  <div class="fw-bold">{{$value->judul}}</div>
									  {{$getHal[$value->jns]}}
									</div>
									<span class="badge bg-primary rounded-pill">{{$value->klik}} Views</span>
							  </li>
							  @endif
						  @endforeach
						</ol>
						@endif
					</div>
				</div>
			</div>

			<!-- Pie Chart -->
			<div class="col-xl-12 col-lg-12">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div
						class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Buku Tamu</h6>
					</div>
					<!-- Card Body -->
					<div class="card-body">
						@if(isset($bukutamu))
							<nav>
								<div class="nav nav-tabs" id="nav-tab" role="tablist">
									@foreach($bukutamu as $key => $value)	
										@php($tabId = str_replace(' ', '-', strtolower($key)))
										@php($active = $key == 'Buku Tamu' ? 'active' : '')
										<button class="nav-link {{$active}}" id="nav-{{$tabId}}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{$tabId}}" type="button" role="tab" aria-controls="nav-{{$tabId}}" aria-selected="true">{{$key}}</button>
									@endforeach
								</div>
							</nav>
							<div class="tab-content" id="nav-tabContent">
								@foreach($bukutamu as $key => $value)	
									@php($tabId = str_replace(' ', '-', strtolower($key)))
									@php($active = $key == 'Buku Tamu' ? 'active' : '')
									<div class="tab-pane fade show {{$active}} border p-3" id="nav-{{$tabId}}" role="tabpanel" aria-labelledby="nav-{{$tabId}}-tab" tabindex="0">
										<div class="list-group lh-1">
											@foreach($value as $k => $v)
											  <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
													<div class="ms-2 me-auto">
														<span class="small">{{$v->judul}}</span>
													  <div class="fw-bold">{{$v->pesan}}</div>
													  <span class="small">{{$v->nama}} / {{$v->email}}</span>
													</div>
													<span class="badge bg-primary rounded-pill">{{$v->created_at}}</span>
											  </a>
										  @endforeach
										</div>
									</div>
								@endforeach
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
	