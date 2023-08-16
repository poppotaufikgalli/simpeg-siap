<!-- Navigation-->
<header>
	<nav class="navbar navbar-light navbar-expand-lg fixed-top" id="navbar_top">
		<div class="container container-jdih ">
			<span class="navbar-brand main-nav-item">
				<a  href="https://jdihn.go.id"><img src="{{asset('assets/img/jdih.png')}}" alt="JDIH" height="50"></a>
				<a href="https://tanjungpinangkota.go.id"><img src="{{asset('assets/img/logo-tpi.png')}}" alt="PEMKO" height="50"></a>
				<span class="nav-item-main">JDIH Kota Tanjungpinang</span>
			</span>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="d-flex align-items-center" style="max-width: 45vw">
				<div class="collapse navbar-collapse" id="navbarNavDropdown">
					<ul class="navbar-nav small" id="mainNav">
						@if(isset($navbars['main']))
							@foreach($navbars['main'] as $key => $value)
								@php($link = $value->jns == 0 ? "/#" : ($value->jns == 1 ? "/page/".$value->target : ($value->jns == 3 ? "/statjnsdokhukum/".$value->target :  ($value->jns == 4 ? "/statdokhukum/".$value->target :  ($value->jns == 5 ? "/lspage/".$value->target : $value->target) )  ) ) )
								@if(isset($value->sub))
									<li class="nav-item dropdown main-nav-item">
										<a class="nav-link dropdown-toggle" href="{{$link}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{strtoupper($value->judul)}}</a>
										@if(isset($navbars['sub'][$value->id]))
											@php($sub = $navbars['sub'][$value->id])
											<ul class="dropdown-menu rounded-0 py-0 bg-transparent" style="font-size: 11px;">
												@foreach($sub as $k => $v)
													@php($l = $v->jns == 0 ? "/#" : ($v->jns == 1 ? "/page/".$v->target : ($v->jns == 3 ? "/statjnsdokhukum/".$v->target :   ($v->jns == 4 ? "/statdokhukum/".$v->target : ($v->jns == 5 ? "/lspage/".$v->target : $v->target) ) ) ) )
													
													@if(isset($navbars['sub'][$v->id]))
														<li class="nav-item bg-light bg-gradient">
															<a class="dropdown-item d-flex justify-content-between" >{{$v->judul}} <span>&raquo;</span></a>
															<ul class="submenu dropdown-menu py-0 mt-2">
																@php($subsub = $navbars['sub'][$v->id])
																@foreach($subsub as $kk => $vv)
																	@php($ll = $vv->jns == 0 ? "/#" : ($vv->jns == 1 ? "/page/".$vv->target : ($vv->jns == 3 ? "/statjnsdokhukum/".$vv->target : ($vv->jns == 4 ? "/statdokhukum/".$vv->target : ($vv->jns == 5 ? "/lspage/".$vv->target : $vv->target) )  ) ))
																	<li class="nav-item bg-light">
																		<a class="dropdown-item ps-4 py-1" href="{{$ll}}">{{$vv->judul}}</a>
																	</li>
																@endforeach
															</ul>
														</li>
													@else
														<li class="nav-item bg-light">
															<a class="dropdown-item" href="{{$l}}">{{$v->judul}}</a>
														</li>
													@endif
													
												@endforeach
											</ul>
										@endif
									</li>	
								@else
									<li class="nav-item main-nav-item">
										<a class="nav-link" aria-current="page" href="{{$link}}">{{strtoupper($value->judul)}}</a>
									</li>	
								@endif
							@endforeach
						@endif
					</ul>
				</div>
			</div>
		</div>
	</nav>
</header>
<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(){
		if (window.innerWidth < 992) {
			// make it as accordion for smaller screens
			document.querySelectorAll('.dropdown-menu a').forEach(function(element){
			    element.addEventListener('mouseover', function (e) {
			    	console.log(element)
			        let nextEl = this.nextElementSibling;
			        if(nextEl && nextEl.classList.contains('submenu')) {	
			          // prevent opening link if link needs to open dropdown
			          e.preventDefault();
			          if(nextEl.style.display == 'block'){
			            nextEl.style.display = 'none';
			          } else {
			            nextEl.style.display = 'block';
			          }
			        }
			    });
			})
		}
	}); 
	// DOMContentLoaded  end
</script>