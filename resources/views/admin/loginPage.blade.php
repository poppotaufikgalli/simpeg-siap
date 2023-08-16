@extends('layouts.admin.master-login')

@section('title', "Login")

@section('content')
	<div class="container">
		<!-- @include('partials/toast') -->
		<!-- Outer Row -->
		<div class="row justify-content-center">
			<div class="col-12 col-lg-6 col-md-8 col-sm-12">
				<div class="card o-hidden border-1 my-5">
					<div class="card-body p-0">
						<div class="p-5">
							<div class="text-center">
								<a href="/">
									<img src="{{ env('APP_LOGO') }}" alt="app_logo" height="100">
								</a>
								<h1>{{ env('APP_NAME') }}</h1>
								<h2 class="mb-4">{{ env('APP_COMPANY') }}</h2>
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
							<hr>
							<div class="d-flex justify-content-between">
								<div>
									<i class="bi bi-chevron-left"></i> 
									<a class="small" href="{{route('beranda')}}">Kembali Ke Beranda</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection