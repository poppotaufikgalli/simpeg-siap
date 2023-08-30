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
			<div class="col-4">
				<div class="d-flex justify-content-center align-items-center" style="height : 100%">
					<div class="card border-0 card-body">
						<div class="p-5">
							<div class="text-center">
								<a href="/">
									<img src="{{asset('images/SIMPERS2.PNG')}}" alt="app_logo" class="img-fluid">
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
			<div class="col-8" id="imgC"></div>			
		</div>
		
	</div>
@endsection