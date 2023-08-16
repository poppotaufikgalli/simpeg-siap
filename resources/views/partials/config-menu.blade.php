@if(isset($menuGrid) && isset($menuGrid['main']))
	<section class="bg-primary bg-opacity-50 py-5">
		<div class="container container-jdih">		
			<div class="row g-2">
				@foreach($menuGrid['main'] as $key => $value)
					@php($img = $value->guid != '' ? asset('/images/menuIcon/'.$value->guid) : asset('/images/stack.svg'))
					@php($link = $value->jns == 0 ? "/#" : ($value->jns == 1 ? "/page/".$value->target : ($value->jns == 3 ? "/statjnsdokhukum/".$value->target :  ($value->jns == 4 ? "/statdokhukum/".$value->target :  ($value->jns == 5 ? "/lspage/".$value->target : $value->target) )  ) ) )
					@if($value->jns == 0)
					<a class="col-md-6 col-lg-3 hvr-float-shadow mt-5 text-decoration-none" data-bs-toggle="modal" data-bs-target="#modal_{{$value->id}}" style="cursor: pointer;">
					@else
					<a href="{{$link}}" class="col-md-6 col-lg-3 hvr-float-shadow mt-5 text-decoration-none" style="cursor: pointer;">
					@endif
						<div class="bg-light bg-opacity-75 py-2 h-100 position-relative">
							<div class="position-absolute top-0 start-50 translate-middle">
								<img src="{{$img}}" class="rounded-circle p-1 bg-white" width="60" height="60" />
							</div>
							<div class="p-2 text-center" style="margin-top: 30px;">
								<h5 class="d-block fw-bold ">{{$value->judul}}</h5>
								<span class="text-muted fst-italic">{{$value->keterangan}}</span>
							</div>
						</div>
					</a>
				@endforeach
			</div>
		</div>
		@foreach($menuGrid['main'] as $key => $value)
			@php($img = $value->guid != '' ? asset('/images/menuIcon/'.$value->guid) : asset('/images/stack.svg'))
			@if($value->sub)
				@php($sub = $value->sub)
				<div class="modal fade" id="modal_{{$value->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  		<div class="modal-dialog modal-dialog-centered rounded-0">
						<div class="modal-content">
				  			<div class="modal-header text-bg-primary bg-opacity-50">
				  				<div class="d-flex flex-column">
					  				<h5 class="h-title">{{$value->judul}}</h5>
									<span class="fst-italic fw-light lh-1">{{$value->keterangan}}</span>
								</div>
								<img src="{{$img}}" class="rounded-circle p-1 bg-white me-2" width="60" height="60" />
				  			</div>
				  			<div class="modal-body d-grid gap-2">
								@foreach($sub as $k => $v)
									@php($img0 = $v->guid != '' ? asset('/images/menuIcon/'.$v->guid) : asset('/images/stack.svg'))
									@php($link0 = $v->jns == 0 ? "/".$v->target : ($v->jns == 1 ? "/page/".$v->target : ($v->jns == 3 ? "/statjnsdokhukum/".$v->target :  ($v->jns == 4 ? "/statdokhukum/".$v->target :  ($v->jns == 5 ? "/lspage/".$v->target : $v->target) )  ) ) )
									<a href="{{$link0}}" class="btn btn-sm btn-outline-primary">
										<div class="d-flex justify-content-between align-items-center">
											<img src="{{$img0}}" class="img-fluid rounded" width="20" height="20" />
											{{$v->judul}}
										</div>
									</a>
								@endforeach
				  			</div>
						</div>
			  		</div>
				</div>
			@endif
		@endforeach
	</section>
@endif