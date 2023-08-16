@extends('layouts.admin.master')

@section('title', "Data Referensi")

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid mt-n10">
		@include('partials/toast')
		<div class="card shadow mb-4">
			<div class="card-header">
				<div class="d-flex justify-content-between align-items-center">
					@if(isset($PageTitle))
						<span>{{$PageTitle}}</span>
					@else
						<span>@yield('title')</span>
					@endif
					<div class="d-flex gap-1">
						<a href="{{route('unkerja.create')}}" class="btn btn-sm btn-primary">Tambah</a>
					</div>
				</div>
			</div>
			@livewire('unit-kerja.main')
		</div>
	</div>
	@include('partials/modalHapus')
@endsection