@extends('layouts.master')

@section('title', "Halaman")

@section('content')
	<section id="content" style="min-height: 60vh">
		<div class="container container-jdih">
			<div class="row g-4 mb-4">
				<div class="col-sm-12 col-md-8 col-lg-8">
					@if(isset($data))
						<h1 class="mt-5 mb-3 h-title fw-bolder">{{$data->judul}}</h1>
						@if(isset($data->guid))
							<img src="{{asset('images/'.$data->guid)}}" class="img-fluid glightbox" alt="{{$data->guid}}">
						@endif
						<div class="position-relative mb-4" style="text-align: justify;">
						  	<p>{!! $data->isi !!}</p>
						  	@if(isset($data->pdf))
						  		<iframe src="{{route('flipbook2', ['path' => 'pdfs', 'filename' => $data->pdf])}}" class="w-100 " style="height: 100vh"></iframe>
							@endif
						</div>
						@if(isset($lsFile) && count($lsFile) > 0)
						<hr class="my-4"/>
						<div class="row row-cols-1 row-cols-md-3 g-3 mb-3">
							@foreach($lsFile as $key => $value)
	  							<div class="col">
	  								<div class="card position-relative">
		  								<img src="{{asset('images/item/'.$data->id.'/'.$value)}}" class="img-fluid glightbox">
		  							</div>
	  							</div>
  							@endforeach
  						</div>
  						@endif
						<div class="d-flex justify-content-between align-items-center mb-2">
							<div class="d-flex gap-3">
								<span class="small align-items-center">
									Dilihat : 
									{{$data->klik}}
								</span>
								<div class="vr"></div>
								<span class="small text-to-time">
									{{date_format(date_create($data->created_at), "d M Y H:i:s")}}
								</span>
								<div class="vr"></div>
								<span class="small">
									{{$data->crname}}
								</span>
							</div>
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
					@else
						<h4 class="mt-5 mb-3 h-title fw-bolder">404 Data belum tersedia</h4>
					@endif
				</div>
			</div>
		</div>
	</section>
@endsection

@section('js-content')
<script type="text/javascript">	
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