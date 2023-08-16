@extends('layouts.master')

@section('title', "Dokumentasi Hukum")

@section('content')
	<!-- Begin Page Content -->
	<section>
		<div class="container container-jdih">
			@if(isset($data))
			<div class="row mt-4">
				<div class="col-12">
					<h2 class="mb-3 h-title fw-bolder">{{$data->judul_peraturan}}</h2>
					<nav class="breadcrumb">
						<ol class="breadcrumb">
						    <li class="breadcrumb-item"><a href="#">{{$data->tipe_dok_hukum}} </a></li>
						    @if(isset($data->jns_hukum))
						    	<li class="breadcrumb-item"><a href="#">{{$data->jns_hukum}} </a></li>
						    @endif
						    @if(isset($data->tahun_peraturan))
						    	<li class="breadcrumb-item"><a href="#">{{$data->tahun_peraturan}} </a></li>
						    @endif
						</ol>
					</nav>
				</div>
				<div class="col-sm-12 col-md-8 col-lg-8 mb-3">
					@include('partials.dokhukum.detailprodukhukum')
					@if(isset($listlampiran['Lampiran']))
						@foreach($listlampiran['Lampiran'] as $key => $value)
							<div class="collapse show" id="lampiran_{{$key}}">
							  	<iframe src="{{route('flipbook', ['id' => $value->id])}}" class="w-100 " style="height: 100vh"></iframe>
							</div>
						@endforeach
					@endif
					<div class="d-flex justify-content-between align-items-center">
						<label class="text-muted fst-italic">Dilihat : {{$data->klik}}</label>
						<div class="btn-group">
							<a href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}"onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" title="Share on Facebook" target="_blank" class="btn btn-sm btn-primary text-white">
								<i class="bi bi-facebook"></i>
							</a>
							<a href="https://web.whatsapp.com/send?text={{Request::url()}}" target="_blank" class="btn btn-sm btn-success">
								<i class="bi bi-whatsapp"></i>
							</a>
							<a href="https://twitter.com/intent/tweet?text={{Request::url()}}" data-action="share/whatsapp/share" target="_blank" class="btn btn-sm btn-info text-white twitter-share-button">
								<i class="bi bi-twitter"></i>
							</a>
						</div> 
					</div>
				</div>

				<!-- Pie Chart -->
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="p-2 bg-white border mb-3">
						@include('partials.formcari')
					</div>
					<table class="table small table-bordered table-hover">
						<thead class="table-light">
							<tr>
								<th>
									<span class="h6">Produk Hukum Terbaru</span>
								</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($lsdokterbaru))
								@foreach($lsdokterbaru as $key => $value)
								<tr style="cursor: pointer;">
								  	<td>
								  		<a href="{{route('cariprodukhukum', ['id' => $value->id])}}" class="list-group-item list-group-item-action {{$value->id == $id ? 'active' : ''}}" aria-current="true">
								  		{{$value->judul_peraturan}}
								  	</a>
								  	<span class="badge bg-secondary">{{$value->jns_hukum ?? $value->tipe_dok_hukum}}</span>
									</td>
								</tr>
								@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
			@else
				<div class="row mt-4" style="min-height: 50vh;">
					<div class="col-12">
						<h2 class="mb-3 h-title fw-bolder">Data Belum Tersedia</h2>
					</div>
				</div>
			@endif
		</div>
	</section>
@endsection

@section('js-content')
<script type="text/javascript">
	
</script>
@endsection