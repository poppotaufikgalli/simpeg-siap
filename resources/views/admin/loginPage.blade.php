@extends('layouts.admin.master-login')

@section('title', "Login")

@section('content')
	<style type="text/css">
		#imgC {
			background-image: url('{{asset("images/background.jpeg")}}');
			background-position: center; /* Center the image */
			height: 100vh;
  			background-repeat: no-repeat; /* Do not repeat the image */
  			background-size: cover;
		}
	</style>
	<div class="container-fluid" style="height: 100vh">
		<div class="row">
			<div class="col-md-4 col-12">
				<div class="d-flex justify-content-center align-items-center" style="height : 100%">
					<div class="card border-0 card-body">
						<div class="p-5">
							<div class="text-center">
								<a href="/">
									<img src="{{asset('images/simpers2.png')}}" alt="app_logo" class="img-fluid">
								</a>
							</div>
							<form class="user" method="post" action="{{route('login.perform')}}">
								@csrf
								<div class="form-group">
									<input type="text" class="form-control form-control-user" id="nip" name="nip" value="{{ old('nip') }}" placeholder="Masukkan NIP" required>
								</div>
								<div class="form-group">
									<input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukkan Password">
								</div>
								<button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8 col position-relative" id="imgC">
				<div class="position-absolute top-0 start-0">
					<img class="ms-3 mt-3" src="{{asset('images/mako.png')}}" alt="app_logo" class="img-fluid" width="350">
				</div>
				<div class="position-absolute bottom-0 end-0">
					<img class="me-5" src="{{asset('assets/img/Logo_berakhlak_bangga.webp')}}" alt="app_logo" class="img-fluid" width="350">
				</div>
			</div>			
		</div>
		
	</div>
@endsection