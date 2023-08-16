@extends('layouts.master')

@section('title', "Dokumentasi Hukum")

@section('content')
	<!-- Begin Page Content -->
	<section>
		<div class="container container-jdih">
			@if(isset($data))
			<div class="row my-4">
				<div class="col-12">
					<h2 class="h-title fw-bolder">
						{{$data->judul_peraturan}}

					</h2>

					@if(isset($listfield['teu_utama']))
						<p class="text-muted fst-italic">Oleh : {{$data->teu_utama}}</p>
					@endif
					<!--<nav class="breadcrumb">
						<ol class="breadcrumb">
						    <li class="breadcrumb-item"><a href="#">{{$data->tipe_dok_hukum}} </a></li>
						    @if(isset($data->jns_hukum))
						    	<li class="breadcrumb-item"><a href="#">{{$data->jns_hukum}} </a></li>
						    @endif
						    @if(isset($data->tahun_peraturan))
						    	<li class="breadcrumb-item"><a href="#">{{$data->tahun_peraturan}} </a></li>
						    @endif
						</ol>
					</nav>-->
				</div>
				<div class="col-sm-12 col-md-9">
					<div class="row g-4">
						<div class="col-4">
							@if(isset($listfield['stts_dok']))
								<div class="d-flex justify-content-start"> 
								@if(in_array($data->stts_dok, ['Tersedia', 'Berlaku']))
									<button class="w-100 btn btn-success rounded-0"><i class="bi bi-check-circle-fill"></i>  {{$data->stts_dok}}</button>
								@else
									<button class="w-100 btn btn-danger rounded-0"><i class="bi bi-x-circle-fill"></i>  {{$data->stts_dok}}</button>
								@endif
								</div>
							@else
								<button class="w-100 btn btn-secondary rounded-0"><i class="bi bi-question-circle-fill"></i>  Perlu Konfirmasi</button>
							@endif
							@php($url = !isset($listlampiran['Gambar']) ? '/images/pustaka_jdih.png' : '/data_file/'.$data->id.'/'.$listlampiran['Gambar'][0]->nama_file)
							<img src="{{asset($url.$data->gambar)}}" class="d-block w-100 rounded-bottom" />

							<div class="d-flex justify-content-between align-items-center mt-3">
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
						<div class="col-8">
							@if(isset($listfield['deskripsi_fisik']))
								<p class="mb-3 h-title fw-bolder">{{$listfield['deskripsi_fisik']}}</p>
								<p>{!! $data->deskripsi_fisik !!}</p>
							@endif
							<p class="mb-3 h-title fw-bolder">Detail Informasi</p>
							@include('partials.dokhukum.detailprodukhukum')
							@if(isset($listlampiran['Lampiran']))
								@foreach($listlampiran['Lampiran'] as $key => $value)
									<div class="collapse show" id="lampiran_{{$key}}">
									  	<iframe src="{{route('flipbook', ['id' => $value->id])}}" class="w-100 " style="height: 100vh"></iframe>
									</div>
								@endforeach
							@endif
						</div>
					</div>
				</div>

				<!-- Pie Chart -->
				<div class="col-sm-12 col-md-3 col-lg-3">
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
								<tr>
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