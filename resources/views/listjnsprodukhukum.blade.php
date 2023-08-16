@extends('layouts.master')

@section('title', "Halaman")

@section('content')
	<section id="content">
		<div class="container container-jdih">
			<div class="row g-4 mb-4">
				<div class="col-sm-12 col-md-8 col-lg-8">
					@if(isset($jnshukums))
						@foreach($jnshukums as $k => $item)
						@php($id = $item->id)
							@if(isset($lsdata[$id]))
								@php($data = $lsdata[$id])
								<h4 class="mt-5 mb-3 h-title fw-bolder">{{$item->nama}}</h4>
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
	}

	
</script>
@endsection