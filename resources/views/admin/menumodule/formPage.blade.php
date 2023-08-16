@extends('layouts.admin.master')

@section('title', "Formulir Menu Module")

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid">
		@include('partials/toast')
		<!-- Page Heading -->
		<!-- DataTales Example -->
		<div class="card shadow mb-4">
			<div class="card-header py-3">
					<h1 class="h3 text-gray-800">{{$method}} {{$title}}</h1>
			</div>
			<div class="card-body">
				<form class="row" method="post" action="{{route('menumodule.perform', ['method' => $method])}}">
					@csrf
					<div class="mb-3 row">
						<div class="col-sm-10 offset-sm-2">
						  <input type="hidden" name="id" class="form-control" value="{{$data->id ?? null}}">
						</div>
			  	</div>
					<div class="mb-3 row">
						<label for="name" class="col-sm-2 col-form-label">Nama Module</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="name" name="name" value="{{$data->name ?? old('name')}}" required>
						</div>
				  </div>
				  <div class="mb-3 row">
						<label for="controller_name" class="col-sm-2 col-form-label">Nama Controller</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="controller_name" name="controller_name" value="{{$data->controller_name ?? old('controller_name')}}" required>
						</div>
				  </div>
				  <div class="mb-3 row">
						<div class="col-sm-10 offset-sm-2">
						  <button type="submit" class="btn btn-primary">Simpan</button>
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
	window.onload = (event)=> {
	let myAlert = document.querySelector('.toast');
	if(myAlert){
		let bsAlert = new bootstrap.Toast(myAlert);
		bsAlert.show();	
	}
}
</script>
@endsection