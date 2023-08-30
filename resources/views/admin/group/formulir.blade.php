@extends('layouts.admin.master')

@section('title', "Formulir Group")

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid mt-n10">
		@include('partials/toast')
		
		<div class="card shadow mb-4">
			<div class="card-header">
				<div class="d-flex gap-2 align-items-center">
					<a href="{{route('group')}}" class="btn btn-secondary btn-sm">
						<i class="bi bi-chevron-left"></i>
					</a>	
					@yield('title')
				</div>
			</div>
			<div class="card-body">
				<form class="row" method="post" action="{{route($next, ['method' => $method])}}">
					@csrf
					<div class="mb-3 row">
						<div class="col-sm-10 offset-sm-2">
						  <input type="hidden" name="id" class="form-control" value="{{$data->id ?? null}}">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="nama" class="col-sm-2 col-form-label">Nama Group</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="nama" name="nama" value="{{$data->nama ?? old('nama')}}" required>
						</div>
				  </div>
				  <div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Menu Personel</label>
						<div class="col-sm-10 table-responsive">
						  <table class="table table-sm table-bordered">
							<thead class="table-dark">
								<tr class="text-center">
									<!--<th>&nbsp;</th>-->
									<th width="30%">Nama Route</th>
									<th>Akses</th>
								</tr>
							</thead>
							<tbody>
								@if($personel)
									@php($lsKonten = isset($data) ? json_decode($data->lsakses) : '')
									@php($lsKonten = isset($lsKonten->kontenakses) ? json_decode($lsKonten->kontenakses) : '')
									@foreach($personel as $key => $value)
										@php($n = $value->nama)
										@php($akses = $lsKonten->$n ?? null)
										<tr class="text-center">
											<td class="text-start">
												<label for="personel_pns">{{$value->nama}}</label>
											</td>
											@php($indexCh = isset($akses) && in_array('_index', $akses) ? 'checked' : '')
											<td>
												<input class="form-check-input ch_{{$value->nama}} ch_index" type="checkbox" id="{{$value->nama}}_index" name="kontenakses[{{$value->nama}}][]" value="_index" aria-label="{{$value->nama}}_index" data-bs-target="{{$value->nama}}" {{$indexCh}}>
											</td>
										</tr>
									@endforeach
								@endif
							</tbody>
						  </table>
						</div>
				  </div>
				  <div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Menu Arsip</label>
						<div class="col-sm-10 table-responsive">
						  <table class="table table-sm table-bordered">
							<thead class="table-dark">
								<tr class="text-center">
									<!--<th>&nbsp;</th>-->
									<th width="30%">Nama Route</th>
									<th>Akses</th>
								</tr>
							</thead>
							<tbody>
								@php($lsAkses = isset($data) ? json_decode($data->lsakses) : '')
								@php($lsAkses = isset($lsAkses->dokakses) ? json_decode($lsAkses->dokakses) : '')
								@php($v = 'arsip_elektronik')
								@php($akses = $lsAkses->$v ?? null)
								<tr class="text-center">
									<td class="text-start">
										<label for="arsip_elektronik">Arsip Elektronik</label>
									</td>
									@php($indexCh = isset($akses) && in_array('_index', $akses) ? 'checked' : '')
									<td>
										<input class="form-check-input ch_arsip_elektronik ch_index" type="checkbox" id="arsip_elektronik_index" name="dokakses[arsip_elektronik][]" value="_index" aria-label="arsip_elektronik_index" data-bs-target="arsip_elektronik" {{$indexCh}}>
									</td>
								</tr>
							</tbody>
						  </table>
						</div>
				  </div>
				  <div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Menu Akses</label>
						<div class="col-sm-10 table-responsive">
						  <table class="table table-sm table-bordered">
							<thead class="table-dark">
								<tr class="text-center">
									<!--<th>&nbsp;</th>-->
									<th width="30%">Nama Route</th>
									<th>Akses</th>
								</tr>
							</thead>
							<tbody>
								@if($routelist)
									@php($lsAkses = isset($data) ? json_decode($data->lsakses) : '')
									@php($lsAkses = isset($lsAkses->menu) ? json_decode($lsAkses->menu) : '')
									@foreach($routelist as $key => $value)
										@php($akses = $lsAkses->$value ?? null)
										@if(!in_array($value, ['personel', 'arsip_elektronik']))
											<tr class="text-center">
												<td class="text-start">
													<label for="{{$value}}">{{ucfirst($value)}}</label>
												</td>
												@php($indexCh = isset($akses) && in_array('_index', $akses) ? 'checked' : '')
												<td>
													<input class="form-check-input ch_{{$value}} ch_index" type="checkbox" id="{{$value}}_index" name="lsakses[{{$value}}][]" value="_index" aria-label="{{$value}}_index" data-bs-target="{{$value}}" {{$indexCh}}>
												</td>
											</tr>		
										@endif
									@endforeach
								@endif
							</tbody>
						  </table>
						</div>
				  </div>
				  <div class="mb-3 row">
						<div class="col-sm-10 offset-sm-2">
							@if(in_array($method, ['create', 'edit']))
								<button class="btn btn-sm btn-primary">Simpan</button>
								<button class="btn btn-sm btn-dark" type="reset">Reset</button>
							@endif
						</div>
				  </div>
				</form>
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