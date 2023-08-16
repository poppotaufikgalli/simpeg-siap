@extends('layouts.master')

@section('title', "JDIH Kota Tanjungpinang")

@section('content')
	<!-- carouselJDIH-->
	<style type="text/css">
		.text-truncate-2 {
		    -webkit-line-clamp: 2;
		    overflow : hidden;
		    text-overflow: ellipsis;
		    display: -webkit-box;
		    -webkit-box-orient: vertical;
		}

		.text-truncate-3 {
		    -webkit-line-clamp: 3;
		    overflow : hidden;
		    text-overflow: ellipsis;
		    display: -webkit-box;
		    -webkit-box-orient: vertical;
		}
		#myChart{
			width: 100%!important;
			max-height: 50vh!important;
		}
		.nu-gradient {
			background: rgb(2,0,36);
			background: linear-gradient(34deg, rgba(2,0,36,1) 0%, rgba(0,0,0,0) 100%);
		}
		.nbv-icon{
			background-repeat: no-repeat;
			background-position-x: 90%;
			background-position-y: 10px;
	  		background-size: 35%;
		}
	</style>
	<section>
		<div class="position-relative">
			<div id="carouselJDIH" class="carousel slide" data-bs-ride="carousel">
				<div class="carousel-inner" style=" width:100%; max-height: 80vh !important;">
					@if(isset($banner))
						@foreach($banner as $k => $item)
							<div class="carousel-item {{$k == 1 ? 'active' : ''}} img-fluid">
								<img src="{{asset('/images/banner/'.$item['basename'])}}" class="d-block w-100 darkened-image" alt="...">
							</div>
						@endforeach
					@endif
				</div>				
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselJDIH" data-bs-slide="prev">
				<div class="bg-danger d-flex p-2">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				</div>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselJDIH" data-bs-slide="next">
				<div class="bg-danger d-flex p-2">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
				</div>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
	</section>
	@if(isset($active_intro) && $active_intro != "")
		<audio id="my-audio" controls class="d-none">
			<source src="{{asset($active_intro)}}" type="audio/mp3">
		</audio>
	@endif
	<section id="formCari">
		<div class="container container-jdih">
			<div class="p-3 bg-white d-flex justify-content-center align-items-center" style="min-height: 20vh">
				@include('partials.formcari2')
			</div>
		</div>
	</section>
	@if(isset($tipedokhukum))
	<!-- Icons Grid-->
	<section class="bg-primary py-3">
		<div class="container container-jdih position-relative">
			<div class="row g-2">
				@php($n = count($tipedokhukum))
				@foreach($tipedokhukum as $key => $value)
				<div class="col-md-6 col-lg-3 hvr-sweep-to-right py-3 py-lg-1 {{ $key%2? 'bg-danger' : '' }}">
					<div class="position-relative">
						<a class="stretched-link link-light text-decoration-none" href="{{route('statdokhukum', ['id' => $value->id, 'title' => $value->nama])}}">
							<div class="d-flex gap-2 justify-content-center">
								<h1>{{count($value->ndokhukum)}}</h1>
							</div>
						</a>
						<p class="mb-0 px-5 text-center text-white">{{$value->nama}}</p>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	@endif
	@include('partials.config-menu')
	<section id="content">
		<div class="container container-jdih">
			<div class="row g-4 mb-4">
				<div class="col-sm-12 col-md-8 col-lg-8">
					<h4 class="pt-4 mt-5 mb-3 h-title">PRODUK HUKUM TERBARU</h4>
					@if(isset($produkhukum))
						<div class="row g-3">
							@foreach($produkhukum as $key => $value)
							<div class="col-lg-4 py-2">
								<div class="position-relative">
									<div class="d-flex flex-column gap-1">
										<span class="text-success mt-0">{{$value->jns_hukum}}</span>
										@if($value->nomor_peraturan != '' && $value->nomor_peraturan != '-')
											<span class="fw-bold">NOMOR {{$value->nomor_peraturan}} TAHUN {{$value->tahun_peraturan}}</span>
											<a class="stretched-link link-dark text-decoration-none lh-1 text-truncate-3" href="{{route('cariprodukhukum', ['id' => $value->id])}}">
												TENTANG {{$value->judul}}
											</a>
										@else
											<a class="stretched-link link-dark text-decoration-none lh-1 text-truncate-3" href="{{route('cariprodukhukum', ['id' => $value->id])}}">
												{{$value->judul}}
											</a>
										@endif
										<span class="text-muted small">TANGGAL {{$value->tgl_penetapan}}-{{$value->bln_penetapan}}-{{$value->thn_penetapan}}</span>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					@endif
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="position-sticky my-5" style="top: 6rem;">
						<div class="p-4 mb-3 bg-primary bg-opacity-10 rounded-0">
							<h4 class="mb-3 h-title">TERPOPULER</h4>
							@if(isset($produkhukum_populer))
								<ul class="list-group list-group-flush">
									@foreach($produkhukum_populer as $key => $value)
									<li class="list-group-item lh-1 bg-transparent">
										<a class="stretched-link link-dark text-decoration-none text-truncate-3" href="{{route('cariprodukhukum', ['id' => $value->id])}}">
											{{$value->judul_peraturan}}
										</a>
									</li>
									@endforeach
								</ul>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@if(isset($datagrafik))
		<section class="bg-primary bg-opacity-10 py-3">
			<div class="container container-jdih">
				<div class="row g-2"> 
					@foreach($datagrafik as $key => $value)
						<div class="col-sm-12 col-md-12">
							<h3 class="mt-5 mb-3 h-title text-center">{{$value->judul}}</h3>
							{!! $value->isi !!}
						</div>
					@endforeach
				</div>
			</div>
		</section>
	@endif
	<!-- Icons Grid-->
	<section id="content">
		<div class="container container-jdih">
			<div class="row g-4 mb-4">
				<div class="col">
					<h4 class="mt-5 mb-3 h-title">BERITA TERBARU</h4>
					@if(isset($berita))
						<table id="example" class="display table table-hover">
							<thead>
								<tr>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($berita as $key => $value)
								<tr>
									<td class="px-0" width="30%">
										@if(isset($value->guid))
											<img src="{{asset('images/'.$value->guid)}}" class="img-fluid glightbox" alt="{{$value->guid}}">
										@endif
									</td>
									<td class="position-relative">
										<h5 class="fw-bolder">{{$value->judul}}</h5>
										<div class="d-flex justify-content-start gap-3 mb-2">
											<span class="small">
												{{$value->created_at}}
											</span>
											<div class="vr"></div>
											<span class="small">
												{{$value->crname}}
											</span>
										</div> 
									  <p>{{ $value->isi_truncate }}</p>
									  <a class="small stretched-link btn btn-sm btn-outline-primary rounded-0" href="/page/{{$value->id}}">Selengkapnya -></a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					@endif
				</div>
				
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="position-sticky my-5" style="top: 6rem;">
						@if(isset($videotesti) && count($videotesti) > 0 )
							<div class="p-4 mb-3 bg-primary bg-opacity-10 rounded-0">
								<h4 class="mb-3 h-title">Testimoni</h4>
								@foreach($videotesti as $key => $value)
									<div class="position-relative">
										{!! $value->isi !!}
									</div>
								@endforeach
							</div>
						@endif
						@if(isset($videotron) && count($videotron) > 0 )
							<div class="p-4 mb-3 bg-primary bg-opacity-10 rounded-0">
								<h4 class="mb-3 h-title">Videotron JDIH</h4>
								@foreach($videotron as $key => $value)
									<div class="position-relative">
										{!! $value->isi !!}
									</div>
								@endforeach
							</div>
						@endif
						@include('partials.config-sidebar')
					</div>
				</div>
			</div>
		</div>
	</section>
	@include('partials.perpustakaanJDIH')
	@include('partials.survey')
	@include('partials.penghargaan')
	<section>
		<!-- Modal -->
		<div class="modal fade" id="modalSearchMain" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-body">
						<div class="card">
							<div class="d-flex justify-content-start align-items-center gap-2 mx-2 my-0">
								<i class="bi bi-search" style="font-size: 1.75rem;"></i>
								<input type="text" id="searchbox_a" style="width: 100%;">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
@section('js-content')

<script type="text/javascript">
	var isplay = false;
	window.onload = (event)=> {
		var ndatatable = document.getElementById("example")
		if(ndatatable){
			const table = new DataTable('#example', {searching: false, info: false, lengthChange: false, pageLength: 6});
			table.context[0].nTHead.classList.add('d-none')
			//search by agolia
		}

		const hash = window.location.hash;
		if(hash == "#survey"){
			const element = document.getElementById("surveySection");
  			element.scrollIntoView({ behavior: 'auto' /*or smooth*/, block: 'center' });
		}

		let audio = new Audio('a_file');

		audio.muted = true;
		audio.addEventListener("canplaythrough", () => {
		   audio.play()
		});
	}

	
	function PlayMusic() {
		document.getElementById("my-audio").play();
	}
</script>
@endsection