@if(isset($penghargaan) && count($penghargaan) > 0)
	<section class="bg-primary bg-opacity-50 pt-2">
		<div class="container container-jdih">
			<h3 class="mt-4 mb-5 h-title text-center">Penghargaan JDIH Tanjungpinang</h3>
			<div class="row mx-auto my-auto justify-content-center">
				<div id="carouselPenghargaan" class="carousel carousel-multi-item carousel-multi-item-penghargaan" data-bs-ride="carousel" data-interval="9000">
					<div class="carousel-inner" role="listbox" style="">
						@foreach($penghargaan as $key => $value)
							<div class="carousel-item {{$key == 0 ? 'active' : ''}}">
								<div class="col d-flex flex-column align-items-center position-relative">
									<div class="h-100 px-4 d-flex align-items-center">
										@php($gambar = $value->guid != '' ? '/images/'.$value->guid : '/images/penghargaan_jdih.png')
										<img src="{{asset($gambar)}}" class="d-block w-100 rounded-1" />
									</div>
									<a href="{{route('page', ['id' => $value->id])}}" class="fw-bold lh-1 text-center text-truncate-2 px-2 stretched-link text-decoration-none p-1" style="width: 20vh; height: 2.4em">{{$value->judul}}</a>	
								</div>
							</div>
						@endforeach
					</div>
					<button class="carousel-control-prev" type="button" data-bs-target="#carouselPenghargaan" data-bs-slide="prev">
						<div class="bg-danger d-flex p-2">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						</div>
						<span class="visually-hidden">Previous</span>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#carouselPenghargaan" data-bs-slide="next">
						<div class="bg-danger d-flex p-2">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
						</div>
						<span class="visually-hidden">Next</span>
					</button>
				</div>
				<div class="text-center my-5">
					<a class="small btn btn-sm btn-primary rounded-0"  href="{{route('lspage', ['id' => 'ph'])}}">Selengkapnya Daftar Penghargaan -></a>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		let items_penghargaan = document.querySelectorAll('.carousel-multi-item-penghargaan .carousel-item')

		items_penghargaan.forEach((el) => {
			const minPerSlide = 5
			let next = el.nextElementSibling
			//console.log(next)
			for (var i=1; i<minPerSlide; i++) {
				if (!next) {
					// wrap carousel by using first child
					next = items_penghargaan[0]
				}
				let cloneChild = next.cloneNode(true)
				el.appendChild(cloneChild.children[0])
				next = next.nextElementSibling
			}
		})
	</script>
@endif