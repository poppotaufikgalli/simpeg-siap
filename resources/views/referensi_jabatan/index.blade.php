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
						@php($myroute = $route . '.create')
						<a href="{{route($myroute, ['jenis_jabatan_id' => $jenis_jabatan_id])}}" class="btn btn-sm btn-primary">Tambah</a>
					</div>
				</div>
			</div>
			@php($mylive = str_replace('_','-',$route) . '.main')
			@livewire($mylive, ['route' => $route, 'jenis_jabatan_id' => $jenis_jabatan_id])
		</div>
	</div>
	@include('partials/modalHapus')
@endsection