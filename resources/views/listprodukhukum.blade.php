@extends('layouts.master')

@section('title', "Halaman ".$title)

@section('content')
	<style type="text/css">
		.text-truncate-2 {
		    -webkit-line-clamp: 2;
		    overflow : hidden;
		    text-overflow: ellipsis;
		    display: -webkit-box;
		    -webkit-box-orient: vertical;
		}
	</style>
	<section id="content">
		<div class="container container-jdih">
			<div class="row g-4 mb-4">
				<div class="col-sm-12 col-md-8 col-lg-8">
					@if(isset($tipedokhukums))
						@foreach($tipedokhukums as $k => $item)
						@php($id = $item->id)
							@if(isset($lsdata[$id]))
								@php($data = $lsdata[$id])
								<h1 class="mt-5 mb-3 h-title fw-bolder">{{$title != '' ? $title : $item->nama}}</h1>
								@if($item->deskripsi != '')
									<div id="deskripsiCard">
										{!! $item->deskripsi !!}
									</div>
								@endif
								@php($border=['primary', 'success', 'info', 'danger', 'warning'])
								@if(isset($lsjns))
									<div class="row g-3 mb-4">
										@php($n = 0)
										@foreach($lsjns as $key => $value)
											<div class="col mb-1">
												<div class="card border-left-{{$border[$n]}} h-100">
													<div class="card-body">
														<div class="d-flex justify-content-between gap-2">
															<div class="d-block">
																<div class="p-2 bg-{{$border[$n]}} rounded shadow">
																	<h3 class="text-white font-weight-bold">{{$value->jml}}</h3>
																</div>
															</div>
															@if($value->jns_hukum == '')
																<span class="text-end text-{{$border[$n]}}">{{$title != '' ? $title : $item->nama}} Lainnya</span>
															@else
																<a href="{{route('statjnsdokhukum', ['id' => $value->id_jns_hukum])}}" class="text-end text-decoration-none stretched-link text-{{$border[$n]}}">{{$value->jns_hukum}}</a>
															@endif
														</div>
													</div>
													<div class="card-footer">
														<div class="float-end">
															<span class="small text-muted fst-italic"><i class="bi bi-clock-history"></i> {{$value->last}}</span>
														</div>
													</div>
												</div>
											</div>
											@php($n == 4 ? $n=0 : $n = $n+1)
										@endforeach
									</div>
								@endif
								@if($grid)
									@if(isset($data))
										<div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
											@foreach($data as $key => $value)
										    	<div class="col text-center mb-1 position-relative">
										    		<div class="h-100 d-flex align-items-end">
										    			<img src="{{asset($value->gambar)}}" class="img-fluid rounded-top" alt="...">
										    		</div>
										    		<a href="{{route('perpus.show', ['id' => $value->id])}}" class="fw-bold text-bg-primary lh-1 text-center text-truncate-2 px-2 stretched-link text-decoration-none">{{$value->judul_peraturan}}</a>	
												</div>
										    @endforeach
										</div>
						  			@endif
								@else
								<div class="table-responsive">
								  	<table class="table small table-bordered table-hover lsData">
								  		<thead class="table-dark">
								  			<tr>
								  				<th>No</th>
								  				<th>Jenis</th>
								  				<th>Nomor</th>
								  				<th>Judul</th>
								  				<th>Tanggal</th>
								  			</tr>
								  		</thead>
								  		<tbody>
								  			@if(isset($data))
								  				@foreach($data as $key => $value)
								  					<tr data-bs-id="{{$value->id}}" style="cursor: pointer;">
								  						<td>{{$key +1}}</td>
								  						<td>{{$value->jns_hukum}}</td>
								  						<td>{{$value->nomor_peraturan}}</td>
								  						<td>{{$value->judul}}</td>
								  						<td>{{isset($value->tgl_penetapan) ? date_format(date_create($value->tgl_penetapan."-".$value->bln_penetapan."-".$value->thn_penetapan), "d M Y"): ''}}</td>
								  					</tr>
								  				@endforeach
								  			@endif
								  		</tbody>
								  	</table>
								</div>
								@endif
							@endif
						@endforeach
					@endif
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="position-sticky my-5" style="top: 1rem;">
						<div class="p-2 bg-white border">
							@include('partials.formcari')
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@include('partials.flipbookmodal2')
@endsection

@section('js-content')
<script type="text/javascript">	
	window.onload = (event)=> {
		const table = new DataTable('.lsData', {});

		table.on( 'click', 'tr', function () {
		    var uuid = this.getAttribute('data-bs-id');
		    if(uuid != null){
		    	window.location.href = '/cariprodukhukum/'+ uuid;	
		    }
		});

		const deskripsiCard = document.getElementById("deskripsiCard");
		if(deskripsiCard){
			const imgs = deskripsiCard.getElementsByTagName('img')
			if(imgs.length > 0){
				for (var i = imgs.length - 1; i >= 0; i--) {
					imgs[i].classList.add('img-fluid')
				}
			}else{
				console.log("Tidak ada")
			}
		}

		var grid = document.querySelector('.grid');
		var msnry = new Masonry( grid, {
		  itemSelector: '.grid-item',
		  columnWidth: 200
		});

	}

	
</script>
@endsection