@extends('layouts.admin.master')

@section('title', "Formulir Data Referensi")

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid mt-n10">
		<div class="card shadow mb-4">
			<div class="card-header">
				<div class="d-flex gap-2 align-items-center">
					<a href="{{route('jenis_personel')}}" class="btn btn-secondary btn-sm">
						<i class="bi bi-chevron-left"></i>
					</a>	
					@if(isset($PageTitle))
						{{$PageTitle}}
					@else
						@yield('title')
					@endif
				</div>
			</div>
			<div class="card-body">
				@livewire('jenis-personel.formulir', ['method' => $method, 'next' => $next, 'sid' => $id_jenis_personel ?? ''])
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
@endsection