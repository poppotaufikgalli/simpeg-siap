@extends('layouts.admin.master')

@section('title', "Formulir Konfigurasi")

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid">
		@include('partials/toast')
		<!-- Page Heading -->
		
		<!-- DataTales Example -->
		<div class="card shadow mb-4">
			<div class="card-header">
				<div class="d-flex gap-2 align-items-center">
					@php($backhash = $page == 'menuGrid' ? 'menu-grid' : ($page == 'menuSidebar' ? 'menu-sidebar' : $page))
					<a href="{{route('config').'#'.$backhash}}" class="btn btn-secondary btn-sm">
						<i class="bi bi-chevron-left"></i>
					</a>	
					Konfigurasi {{ucwords($page)}}
				</div>
			</div>
			<div class="card-body">
				<form class="row" method="post" action="{{route($next, ['method' => $method, 'page' => $page])}}" enctype="multipart/form-data">
					@csrf
					<div class="mb-3 row">
						<div class="col-sm-10 offset-sm-2">
						  	<input type="hidden" name="id" class="form-control" value="{{isset($data->id) ? $data->id : null}}">
						</div>
					</div>
					<div class="mb-3 row">
						<label for="ref" class="col-sm-2 col-form-label">Referensi</label>
						<div class="col-sm-10">
						  	<input type="text" id="referensi" value="{{isset($ref_menu->judul) ? $ref_menu->judul : 'Top Menu'}}" class="form-control" disabled>
						  	<input type="hidden" id="ref" name="ref" value="{{isset($ref_menu->id) ? $ref_menu->id : 0}}" class="form-control">
						  	<input type="hidden" id="page" name="page" value="{{$page}}" class="form-control">
						</div>
				  	</div>
					<div class="mb-3 row">
						<label for="judul" class="col-sm-2 col-form-label">Judul</label>
						<div class="col-sm-10">
						  	<input type="text" class="form-control" id="judul" name="judul" value="{{isset($data->judul) ? $data->judul : old('judul')}}" required>
						</div>
				  	</div>
				  	@if($page == 'menuGrid' || $page == 'menuSidebar')
				  	<div class="mb-3 row">
						<label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="keterangan" name="keterangan" value="{{isset($data->keterangan) ? $data->keterangan : old('keterangan')}}">
						</div>
				  	</div>
				  	<div class="mb-3 row">
						<label for="icon" class="col-sm-2 col-form-label">{{$page == 'menuGrid' ? 'Icon' : 'Gambar'}}</label>
						<div class="col-sm-10">
							<input type="file" name="guid" id="guid" class="form-control {{$page}}" value="{{$data->guid ?? null}}" accept="image/png" />
							<div id="guidHelpBlock" class="form-text">
								{{$page == 'menuGrid' ? 'Icon adalah gambar dengan ekstensi png, dengan dimensi ukuran maksimal 100x100.' : 'Gambar adalah gambar dengan ekstensi png'}}
							</div>
							@if(isset($data->guid))
								<img id="img-guid" src="{{asset('images/menuIcon/'.$data->guid)}}" class="img-fluid mt-2" style="cursor: pointer;" />
							@endif
						</div>
				  	</div>
				  	@endif
				  	<div class="mb-3 row">
						<label for="ref" class="col-sm-2 col-form-label">Jenis</label>
						<div class="col-sm-10 d-flex align-items-center gap-2">
						  	<div class="form-check form-check-inline">
							  	<input class="form-check-input seljns" type="radio" name="jns[]" id="inlineRadio0" value="0" {{isset($data->jns) && $data->jns == 0 ? 'checked' : ''}} required>
							  	<label class="form-check-label" for="inlineRadio0"># (Non-link)</label>
							</div>
						  	<div class="form-check form-check-inline">
							  	<input class="form-check-input seljns" type="radio" name="jns[]" id="inlineRadio1" value="1" {{isset($data->jns) && $data->jns == 1 ? 'checked' : ''}}>
							  	<label class="form-check-label" for="inlineRadio1">Posting</label>
							</div>
							<div class="form-check form-check-inline">
							  	<input class="form-check-input seljns" type="radio" name="jns[]" id="inlineRadio2" value="2" {{isset($data->jns) && $data->jns == 2 ? 'checked' : ''}}>
							  	<label class="form-check-label" for="inlineRadio2">Link</label>
							</div>
							<div class="form-check form-check-inline">
							  	<input class="form-check-input seljns" type="radio" name="jns[]" id="inlineRadio3" value="3" {{isset($data->jns) && $data->jns == 3 ? 'checked' : ''}}>
							  	<label class="form-check-label" for="inlineRadio3">Cari Jenis Hukum</label>
							</div>
							<div class="form-check form-check-inline">
							  	<input class="form-check-input seljns" type="radio" name="jns[]" id="inlineRadio4" value="4" {{isset($data->jns) && $data->jns == 4 ? 'checked' : ''}}>
							  	<label class="form-check-label" for="inlineRadio4">Cari Dokumen Hukum</label>
							</div>
							<div class="form-check form-check-inline">
							  	<input class="form-check-input seljns" type="radio" name="jns[]" id="inlineRadio5" value="5" {{isset($data->jns) && $data->jns == 5 ? 'checked' : ''}}>
							  	<label class="form-check-label" for="inlineRadio5">List Konten</label>
							</div>
						</div>
				  	</div>
				  	<div class="mb-3 row">
						<label for="target" class="col-sm-2 col-form-label">Target</label>
						<div class="col-sm-10">
						  	<input type="text" id="target" name="target" class="form-control" value="{{isset($data->target) ? $data->target : old('target')}}" required>
						  	<select id="starget" name="starget">
						  		@if(isset($halaman))
						  			<option selected disabled>Pilih Halaman</option>
						  			@foreach($halaman as $key => $value)
						  				@if(isset($data->target) && ($value->id == $data->target) && ($data->jns == 1))
						  					<option value="{{$value->id}}" selected>{{$value->judul}}</option>
						  				@else
						  					<option value="{{$value->id}}">{{$value->judul}}</option>
						  				@endif
						  			@endforeach
						  		@endif
						  	</select>

						  	<select id="starget2" name="starget2">
						  		@if(isset($jnshukums))
						  			<option selected disabled>Pilih Jenis</option>
						  			@foreach($jnshukums as $key => $value)
						  				@if(isset($data->target) && ($value->id == $data->target) && ($data->jns == 3))
						  					<option value="{{$value->id}}" selected>{{$value->nama}}</option>
						  				@else
						  					<option value="{{$value->id}}">{{$value->nama}}</option>
						  				@endif
						  			@endforeach
						  		@endif
						  	</select>

						  	<select id="starget3" name="starget3">
						  		@if(isset($tipedokhukums))
						  			<option selected disabled>Pilih Tipe Produk</option>
						  			@foreach($tipedokhukums as $key => $value)
						  				@if(isset($data->target) && ($value->id == $data->target) && ($data->jns == 4))
						  					<option value="{{$value->id}}" selected>{{$value->nama}}</option>
						  				@else
						  					<option value="{{$value->id}}">{{$value->nama}}</option>
						  				@endif
						  			@endforeach
						  		@endif
						  	</select>

						  	<select id="starget4" name="starget4">
						  		@if(isset($kontens))
						  			<option selected disabled>Pilih List Konten</option>
						  			@foreach($kontens as $key => $value)
						  				@if(isset($data->target) && ($value == $data->target) && ($data->jns == 5))
						  					<option value="{{$key}}" selected>{{$value}}</option>
						  				@else
						  					<option value="{{$key}}">{{$value}}</option>
						  				@endif
						  			@endforeach
						  		@endif
						  	</select>
						</div>
				  	</div>
				  	<div class="mb-3 row">
						<div class="col-sm-10 offset-sm-2">
							@if(in_array($method, ['create', 'edit']))
								<button class="btn btn-sm btn-primary" id="btnSubmit">Simpan</button>
								<button class="btn btn-sm btn-dark" type="reset">Reset</button>
							@endif
						</div>
				  </div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
@endsection

@section('js-content')
<script type="text/javascript">
	var editorTextarea;
	var ckeditorDiv;
	var curTarget = '{{isset($data->target) ? $data->target : "#"}}';
	var curJns = '{{isset($data->jns) ? $data->jns : 0}}';

	window.onload = (event)=> {
		let myAlert = document.querySelector('.toast');
		if(myAlert){
			let bsAlert = new bootstrap.Toast(myAlert);
			bsAlert.show();	
		}

		const starget = document.getElementById('starget')
		if(starget){
			new TomSelect(starget, {
				plugins: ['dropdown_input'],
			});	
		}

		const starget2 = document.getElementById('starget2')
		if(starget2){
			new TomSelect(starget2, {
				plugins: ['dropdown_input'],
			});	
		}

		const starget3 = document.getElementById('starget3')
		if(starget3){
			new TomSelect(starget3, {
				plugins: ['dropdown_input'],
			});	
		}

		const starget4 = document.getElementById('starget4')
		if(starget4){
			new TomSelect(starget4, {
				plugins: ['dropdown_input'],
			});	
		}

		const inlineRadio1 = document.getElementById('inlineRadio1')
		if(inlineRadio1.checked){
			var target = document.getElementById("target")
			target.type = "hidden";

			var tsWrapper2 = document.getElementById('starget2').nextElementSibling
			tsWrapper2.classList.add('d-none')

			var tsWrapper3 = document.getElementById('starget3').nextElementSibling
			tsWrapper3.classList.add('d-none')

			var tsWrapper4 = document.getElementById('starget4').nextElementSibling
			tsWrapper4.classList.add('d-none')
		}else if(inlineRadio3.checked){
			var target = document.getElementById("target")
			target.type = "hidden";

			var tsWrapper = document.getElementById('starget').nextElementSibling
			tsWrapper.classList.add('d-none')

			var tsWrapper3 = document.getElementById('starget3').nextElementSibling
			tsWrapper3.classList.add('d-none')

			var tsWrapper4 = document.getElementById('starget4').nextElementSibling
			tsWrapper4.classList.add('d-none')
		}else if(inlineRadio4.checked){
			var target = document.getElementById("target")
			target.type = "hidden";

			var tsWrapper = document.getElementById('starget').nextElementSibling
			tsWrapper.classList.add('d-none')

			var tsWrapper2 = document.getElementById('starget2').nextElementSibling
			tsWrapper2.classList.add('d-none')

			var tsWrapper3 = document.getElementById('starget4').nextElementSibling
			tsWrapper3.classList.add('d-none')
		}else if(inlineRadio5.checked){
			var target = document.getElementById("target")
			target.type = "hidden";

			var tsWrapper = document.getElementById('starget').nextElementSibling
			tsWrapper.classList.add('d-none')

			var tsWrapper2 = document.getElementById('starget2').nextElementSibling
			tsWrapper2.classList.add('d-none')

			var tsWrapper3 = document.getElementById('starget3').nextElementSibling
			tsWrapper3.classList.add('d-none')
		}else{
			var tsWrapper = document.getElementById('starget').nextElementSibling
			//var tsWrapper = document.querySelector(".ts-wrapper")
			tsWrapper.classList.add('d-none')

			var tsWrapper2 = document.getElementById('starget2').nextElementSibling
			//var tsWrapper = document.querySelector(".ts-wrapper")
			tsWrapper2.classList.add('d-none')

			var tsWrapper3 = document.getElementById('starget3').nextElementSibling
			//var tsWrapper = document.querySelector(".ts-wrapper")
			tsWrapper3.classList.add('d-none')

			var tsWrapper4 = document.getElementById('starget4').nextElementSibling
			tsWrapper4.classList.add('d-none')
		}
	}

	let chAll = document.querySelectorAll('.seljns')
	chAll.forEach((el) => {
		el.addEventListener('change', (e) => {
			var target = document.getElementById("target")
			var starget = document.getElementById('starget')
			var starget2 = document.getElementById('starget2')
			var starget3 = document.getElementById('starget3')
			var starget4 = document.getElementById('starget4')
			var tsWrapper = starget.nextElementSibling
			var tsWrapper2 = starget2.nextElementSibling
			var tsWrapper3 = starget3.nextElementSibling
			var tsWrapper4 = starget4.nextElementSibling

			target.value = ""
			target.type = "text";

			if(e.target.value == 5){
				tsWrapper4.classList.remove('d-none')
				tsWrapper3.classList.add('d-none')
				tsWrapper2.classList.add('d-none')
				tsWrapper.classList.add('d-none')

				target.type = "hidden";
			}else if(e.target.value == 4){
				tsWrapper4.classList.add('d-none')
				tsWrapper3.classList.remove('d-none')
				tsWrapper2.classList.add('d-none')
				tsWrapper.classList.add('d-none')

				target.type = "hidden";
			}else if(e.target.value == 3){
				tsWrapper4.classList.add('d-none')
				tsWrapper3.classList.add('d-none')
				tsWrapper2.classList.remove('d-none')
				tsWrapper.classList.add('d-none')

				target.type = "hidden";
			}else if(e.target.value == 2){
				tsWrapper4.classList.add('d-none')
				tsWrapper3.classList.add('d-none')
				tsWrapper2.classList.add('d-none')
				tsWrapper.classList.add('d-none')

				target.type = "url";
				target.value = "https://";
			}else if(e.target.value == 1){
				tsWrapper4.classList.add('d-none')
				tsWrapper3.classList.add('d-none')
				tsWrapper2.classList.add('d-none')
				tsWrapper.classList.remove('d-none')

				target.type = "hidden";
			}else if(e.target.value == 0){
				tsWrapper4.classList.add('d-none')
				tsWrapper3.classList.add('d-none')
				tsWrapper2.classList.add('d-none')
				tsWrapper.classList.add('d-none')

				target.value = "#"
			}

			if(curJns == e.target.value){
				target.value = curTarget
			}
		})	
	})

	document.getElementById('starget').addEventListener('change', function(e){
		//console.log(e.target.value)
		document.getElementById('target').value = e.target.value
	})

	document.getElementById('starget2').addEventListener('change', function(e){
		//console.log(e.target.value)
		document.getElementById('target').value = e.target.value
	})

	document.getElementById('starget3').addEventListener('change', function(e){
		//console.log(e.target.value)
		document.getElementById('target').value = e.target.value
	})

	document.getElementById('starget4').addEventListener('change', function(e){
		//console.log(e.target.value)
		document.getElementById('target').value = e.target.value
	})

	document.getElementById('guid').addEventListener('change', function(e){
		let img = new Image()
		img.src = window.URL.createObjectURL(event.target.files[0])
		img.onload = () => {
			if(e.target.classList.contains('menuGrid') == true){
				if(img.width < 100 && img.height < 100 && img.width == img.height){
			        document.getElementById('guidHelpBlock').innerHTML = `Icon adalah gambar dengan ekstensi png, dengan dimensi ukuran maksimal 100x100.  Ukuran gambar anda ${img.width}x${img.height}`;
			        document.getElementById('guidHelpBlock').classList.remove('text-bg-warning')
			        document.getElementById('guidHelpBlock').classList.add('text-bg-success')	
			    } else {
			    	document.getElementById('guidHelpBlock').innerHTML = `Icon adalah gambar dengan ekstensi png, dengan dimensi ukuran maksimal 100x100.  Ukuran gambar anda ${img.width}x${img.height}`;
				   	document.getElementById('guidHelpBlock').classList.remove('text-bg-success')
				   	document.getElementById('guidHelpBlock').classList.add('text-bg-warning')
			   	}                	
			}
		}
	})

	function chdisplay(target) {
		// body...
	}
</script>
@endsection