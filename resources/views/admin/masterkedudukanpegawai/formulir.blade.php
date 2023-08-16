@extends('layouts.admin.master')

@section('title', "Formulir Data Referensi")

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid mt-n10">
		<div class="card shadow mb-4">
			<div class="card-header">
				<div class="d-flex gap-2 align-items-center">
					<a href="{{route('jenis_jabatan')}}" class="btn btn-secondary btn-sm">
						<i class="bi bi-chevron-left"></i>
					</a>	
					@if(isset($PageTitle))
						{{$PageTitle}}
					@else
						@yield('title')
					@endif
				</div>
			</div>
			@livewire('kedudukan-pegawai.formulir', ['method' => $method, 'next' => $next, 'sid' => $kduduk ?? ''])
		</div>
	</div>
	<!-- /.container-fluid -->
@endsection