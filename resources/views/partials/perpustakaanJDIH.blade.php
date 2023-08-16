@if(isset($monografi) && count($monografi) > 0)
	<section class="bg-primary bg-opacity-50 pt-2" style="background-image: url('{{asset("images/spacer.png")}}');">
		<div class="container container-jdih">
			<h3 class="mt-4 mb-5 h-title text-center">Perpustakaan JDIH</h3>
			<div class="row mx-auto my-auto justify-content-center">
				<div id="carouselPerpus" class="carousel carousel-multi-item" data-bs-ride="carousel" data-interval="9000">
					<div class="carousel-inner" role="listbox" style="">
						@foreach($monografi as $key => $value)
							<div class="carousel-item {{$key == 0 ? 'active' : ''}}">
								<div class="col d-flex flex-column align-items-center position-relative">
									<div class="h-100 px-4 d-flex align-items-center">
										@php($url = $value->gambar == 'pustaka_jdih.png' ? '/images/' : '/data_file/'.$value->id.'/')
										<img src="{{asset($url.$value->gambar)}}" class="d-block w-100 rounded-1" />
									</div>
									<a href="{{route('perpus.show', ['id' => $value->id])}}" class="fw-bold lh-1 text-center text-truncate-2 px-2 stretched-link text-decoration-none p-1" style="width: 20vh; height: 2.4em">{{$value->judul_peraturan}}</a>	
								</div>
							</div>
						@endforeach
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselPerpus" data-bs-slide="prev">
						<div class="bg-danger d-flex p-2">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						</div>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselPerpus" data-bs-slide="next">
						<div class="bg-danger d-flex p-2">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
						</div>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
				<div class="text-center my-5">
					<a class="small btn btn-sm btn-primary rounded-0"  href="{{route('statdokhukum', ['id' => 2, 'title' => 'Perpustakaan JDIH', 'grid' => true])}}">Selengkapnya Perpustakaan JDIH -></a>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		let items = document.querySelectorAll('.carousel-multi-item .carousel-item')

		items.forEach((el) => {
			const minPerSlide = 5
			let next = el.nextElementSibling
			//console.log(next)
			for (var i=1; i<minPerSlide; i++) {
				if (!next) {
					// wrap carousel by using first child
					next = items[0]
				}
				let cloneChild = next.cloneNode(true)
				el.appendChild(cloneChild.children[0])
				next = next.nextElementSibling
			}
		})
	</script>
@endif