@extends('layouts.master')

@section('title', "JDIH")

@section('content')
	<style type="text/css">
		figure.image > img {
		    max-width: 100%;
    		height: 200px;
		}
	</style>
	<section id="content">
		<div class="container container-jdih">
			<div class="row g-4 mb-4 ">
				<div class="col-sm-12 col-md-8 col-lg-8">
					@if(isset($vtype))
						@if($vtype == 'grid')
							<h2 class="h-title fw-bolder mt-5 mb-3">{{ ucwords($hal) }}</h2>
							@if(isset($data))
								<div class="row row-cols-1 row-cols-md-3 g-4">
								@foreach($data as $key => $value)
									<div class="col">
										<div class="card h-100">
										    <img src="{{asset('images/'.$value->guid)}}" class="img-fluid glightbox" alt="{{$value->gid}}">
										    <div class="card-body text-center">
											    <a href="{{route('page', ['id' => $value->id])}}" class="mt-2 text-center h-title">{{$value->judul}}</a>
											</div>
											<div class="card-footer">
	        									<small>Dilihat : {{$value->klik}}</small>
	      									</div>
										</div>
									</div>
								@endforeach
								</div>
								<div class="float-end mt-3">
									{{ $data->links() }}
								</div>
							@endif
						@elseif($vtype == 'grids')
							@if(isset($data))
								<div class="d-flex flex-column justify-content-between gap-4">
									@foreach($data as $k => $items)
										<div class="col">
											<div class="d-flex justify-content-between align-items-center mt-5 mb-2">
												<h2 class="h-title fw-bolder">{{ ucwords($k) }}</h2>
												<h5 class="h-title fw-bolder">{{ucwords($hal)}}</h5>
											</div>
											<div class="row row-cols-1 row-cols-md-3 g-4">
											@foreach($items as $key => $value)
												<div class="col">
													<div class="card text-center"> 
												    	{!! $value->isi !!}
												    	<a href="{{route('page', ['id' => $value->id])}}" class="text-decoration-none">{{$value->judul}}</a>
													    <div class="card-footer">
															<small>Dilihat : {{$value->klik}}</small>
														</div>
													</div>
												</div>
											@endforeach
											</div>
											<div class="float-end mt-3">
												{{ $items->links() }}
											</div>
										</div>
									@endforeach
								</div>
							@endif
						@elseif($vtype == 'grids0')
							@if(isset($data))
								<div class="d-flex flex-column justify-content-between gap-4">
									<div class="col">
										<div class="d-flex justify-content-between align-items-center mt-5 mb-2">
											<h2 class="h-title fw-bolder">Jadwal Zoom</h2>
											<h5 class="h-title fw-bolder">{{ucwords($hal)}}</h5>
										</div>
										<div class="row row-cols-1 row-cols-md-1 g-4">
										@foreach($data['Jadwal Zoom'] as $key => $value)
											<div class="col">
												<div class="card text-center"> 
													<a href="{{route('page', ['id' => $value->id])}}" class="text-decoration-none">{{$value->judul}}</a>
											    	{!! $value->isi !!}
												    <div class="card-footer">
														<small>Dilihat : {{$value->klik}}</small>
													</div>
												</div>
											</div>
										@endforeach
										</div>
										<div class="float-end mt-3">
											{{ $data['Jadwal Zoom']->links() }}
										</div>
									</div>
									<div class="col">
										<div class="d-flex justify-content-between align-items-center mt-5 mb-2">
											<h2 class="h-title fw-bolder">Video Pembelajaran</h2>
											<h5 class="h-title fw-bolder">{{ucwords($hal)}}</h5>
										</div>
										<div class="row row-cols-1 row-cols-md-3 g-4">
										@foreach($data['Video Pembelajaran'] as $key => $value)
											<div class="col">
												<div class="card text-center"> 
											    	{!! $value->isi !!}
											    	<a href="{{route('page', ['id' => $value->id])}}" class="text-decoration-none">{{$value->judul}}</a>
												    <div class="card-footer">
														<small>Dilihat : {{$value->klik}}</small>
													</div>
												</div>
											</div>
										@endforeach
										</div>
										<div class="float-end mt-3">
											{{ $data['Video Pembelajaran']->links() }}
										</div>
									</div>
								</div>
							@endif
						@elseif($vtype == 'list')
							<h2 class="h-title fw-bolder mt-5 mb-3">{{ ucwords($hal) }}</h2>
							@if(isset($data))
								<ul class="list-group list-group-flush">
									@foreach($data as $key => $value)
										<li class="list-group-item">
											<div class="fw-bold d-flex pt-2">
												<span class="pe-2">{{$key+1}}. </span>
									      		<a href="{{route('page', ['id' => $value->id])}}" class="text-decoration-none stretched-link">
									      			{{ucfirst($value->judul)}} apakah bisa berkata-kata porno dan menunjukkan ekspresi porno di depan umum termasuk dalam pelecehan seksual verbal dan dapat dipidana?
									      		</a>
									      	</div>
									      	@if(isset($value->isi_truncate))
												<span>{{$value->isi_truncate}}</span>
											@endif
											<div class="w-50 float-end d-flex justify-content-between">
												<span class="small">Dilihat : {{$value->klik}}</span>
								      			<div class="vr"></div>
								      			<span class="small">{{$value->crname}}</span>
											</div>
										</li>
									@endforeach
								</ul>
								<div class="float-end mt-3">
									{{ $data->links() }}
								</div>
							@endif
						@endif
					@else
						@if(isset($data))
							@foreach($data as $key => $value)
								<h2 class="mt-5 mb-3 h-title fw-bolder">{{$value->judul}}</h2>
								<div class="row"> 
									@if(isset($value->guid))
										<div class="col-lg-4">
											<img src="{{asset('images/'.$value->guid)}}" class="img-fluid glightbox" alt="{{$value->guid}}">
										</div>
									@endif
									<div class="position-relative mb-4 col">
										@if(isset($value->isi_truncate))
											<p>{{$value->isi_truncate}}</p>
										@else
											<p>{!! $value->isi !!}</p>
										@endif
									  	
									  	@if(isset($value->pdf))
									  		<iframe src="{{route('flipbook2', ['path' => 'pdfs', 'filename' => $value->pdf])}}" class="w-100 " style="height: 100vh"></iframe>
										@endif
										<a href="{{route('page', ['id' => $value->id])}}">Selengkapnya</a>
									</div>
								</div>
								<div class="my-2 p-2 bg-primary bg-opacity-10">
									<div class="d-flex justify-content-between align-items-center gap-3">
										<span class="small align-items-center">
											Dilihat : {{$value->klik}}
										</span>
										<div class="vr"></div>
										<span class="small">
											{{$value->created_at->format('d M Y H:i:s')}}
										</span>
										<div class="vr"></div>
										<span class="small">
											{{$value->crname}}
										</span>
										<div class="vr"></div>
										<div class="float-end">
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
							@endforeach
							<div class="float-end">
								{{ $data->links() }}
							</div>
						@else
							<h4 class="mt-5 mb-3 h-title fw-bolder">404 Data belum tersedia</h4>
						@endif
					@endif
				</div>
				@if(in_array($jns, ['bh', 'b', 'jk']))
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="position-sticky my-5" style="top: 1rem;">
						<div class="p-2 bg-white border">
							@include('partials.formcarikonten')
						</div>
					</div>
				</div>
				@endif
			</div>
		</div>
	</section>
@endsection

@section('js-content')
<script type="text/javascript">	
	window.onload = (event)=> {
		var figurGambar = document.querySelectorAll('figure.image > img');
		if(figurGambar){
			figurGambar.forEach(item => {
				//item.classList.add('img-fluid')
			})
		}
	}

	const lsTextTime = document.querySelectorAll(".text-to-time")

	lsTextTime.forEach((el) => {
		console.log(el)
		var eltime = timeSince(el.textContent)

		el.textContent = eltime;
		//var textTime = el.textContent;
	})

	function timeSince(date) {
		date = new Date(date)
		var seconds = Math.floor((new Date() - date) / 1000);
		var interval = Math.floor(seconds / 31536000);

		if (interval > 1) {
			return date;
		}
		
		interval = Math.floor(seconds / 2592000);
		if (interval > 1) {
			return date;
		}
		
		interval = Math.floor(seconds / 86400);
		if (interval > 1) {
			return interval + " Hari yang lalu";
		}
		
		interval = Math.floor(seconds / 3600);
		if (interval > 1) {
			return interval + " Jam yang lalu";
		}
		
		interval = Math.floor(seconds / 60);
		if (interval >= 1) {
			return interval + " Menit yang lalu";
		}
		return Math.floor(seconds) + " Detik";
	}
</script>
@endsection