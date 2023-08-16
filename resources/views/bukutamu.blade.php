@extends('layouts.master')

@section('title', "Buku Tamu")

@section('content')
	<section id="content">
		<div class="container container-jdih">
			@include('partials/toast')
			<div class="row g-4 mb-4">
				<div class="col-sm-12 col-md-8 col-lg-8">
					<h2 class="mt-5 mb-3 h-title fw-bolder">{{$judul}}</h2>
					<p class="fst-italic">Silahkan Isi Formulir Dibawah Ini</p>
					<form class="row" method="post" action="{{route('bukutamu', ['judul' => $judul])}}">
						@csrf
						<div class="mb-3 row">
							<label for="nama" class="col-sm-2 col-form-label">Nama</label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" id="nama" name="nama" value="{{$data->nama ?? old('nama')}}" required>
							</div>
					  	</div>
					  	<div class="mb-3 row">
							<label for="email" class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
							  <input type="email" class="form-control" id="email" name="email" value="{{$data->email ?? old('email')}}" required>
							</div>
					  	</div>
					  	@if($judul != "Buku Tamu")
					  	<div class="mb-3 row">
							<label for="tentang" class="col-sm-2 col-form-label">Tentang</label>
							<div class="col-sm-10">
							  <input type="tentang" class="form-control" id="tentang" name="tentang" value="{{$judul}}" disabled>
							</div>
					  	</div>
					  	@endif
					  	<div class="mb-3 row">
							<label for="pesan" class="col-sm-2 col-form-label">Pesan</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="pesan" name="pesan" rows="4" required>{{$data->pesan ?? old('pesan')}}</textarea>
							</div>
					  	</div>
					  	<div class="mb-3 row">
							<div class="offset-sm-2 col-sm-10">
								<input type="hidden" class="form-control" id="judul" name="judul" value="{{$judul}}">
								<button class="btn btn-sm btn-primary">Kirim</button>
							</div>
					  	</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('js-content')
<script type="text/javascript">	
	window.onload = (event)=> {
	    let myAlert = document.querySelector('.toast');
	    if(myAlert){
	      let bsAlert = new bootstrap.Toast(myAlert);
	      bsAlert.show(); 
	    }
	}
</script>
@endsection