@extends('layouts.admin.master')

@section('title', "Formulir Pengguna")

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid mt-n10">
		@include('partials.toast')

		<div class="card shadow mb-4">
			<div class="card-header">
				<div class="d-flex gap-2 align-items-center">
					<a href="{{route('user')}}" class="btn btn-secondary btn-sm">
						<i class="bi bi-chevron-left"></i>
					</a>	
					@yield('title')
				</div>
			</div>
			<div class="card-body">
				<form class="row" method="post" action="{{route($next, ['method' => $method])}}">
					@csrf
					<div class="mb-3 row">
						<div class="col-sm-10 offset-sm-2">
						  <input type="hidden" name="id" class="form-control" value="{{$data->id ?? null}}">
						</div>
				  	</div>
					<div class="mb-3 row">
						<label for="nip" class="col-sm-2 col-form-label">NIP</label>
						<div class="col-sm-3">
						  	<input type="text" class="form-control" id="nip" name="nip" value="{{$data->nip ?? old('nip')}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="18" required>
						</div>
						<label for="nama" class="col-sm-1 col-form-label">Nama</label>
						<div class="col-sm-6">
						  	<input type="text" class="form-control" id="nama" name="nama" value="{{$data->nama ?? old('nama')}}">
						</div>
				  </div>
				  <div class="mb-3 row">
						<label class="col-sm-2 col-form-label">Group</label>
						<div class="col-sm-10">
							<select class="form-control" id="gid" name="gid">
								<option selected disabled>Pilih Group</option>
								@if($group)
									@foreach($group as $key => $value)
										@if(isset($data->gid) && $data->gid == $value->id)
											<option value="{{$value->id}}" selected>{{$value->nama}}</option>
										@else
											<option value="{{$value->id}}">{{$value->nama}}</option>
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
@endsection

@section('js-content')
<script type="text/javascript">
	var method = '{{$method}}'
	const nip = document.getElementById('nip');
	nip.addEventListener('input', getPegawai)

	window.onload = (event)=> {
	  	let myAlert = document.querySelector('.toast');
	  	if(myAlert){
	    	let bsAlert = new bootstrap.Toast(myAlert);
	    	bsAlert.show(); 
	  	}

	  	if(method == 'show' || method == 'edit'){
	  		getPegawai()
	  	}
	}

	function getPegawai() {
	    let l = document.getElementById('nip').value;
	    if(l.length == '8' || l.length == '18'){
	    	var xhttp = new XMLHttpRequest();
		    xhttp.onreadystatechange = function() {
		         if (this.readyState == 4 && this.status == 200) {
		             let retval = JSON.parse(this.responseText);
		             
		             if(retval['status'] == 200){
		             	document.getElementById('nama').value = retval['datapegawai']['nama'];
		             }else{
		             	alert(retval['message'])
		             	document.getElementById('nama').value = '';
		             }
		         }
		    };
		    xhttp.open("GET", "/api/getPegawai/"+l, true);
		    //xhttp.setRequestHeader("Content-type", "application/json");
		    xhttp.send();
	    }
	}

</script>
@endsection