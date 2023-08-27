@extends('layouts.admin.master')

@section('title', $PageTitle)

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid mt-n10">
		@include('partials/toast')
		<div class="card shadow mb-4">
			<div class="card-header">
				<div class="d-flex justify-content-end align-items-center">
					<div class="d-flex gap-1">
						<a href="{{route('personel.create', ['id_jenis_personel' => $id_jenis_personel])}}" class="btn btn-sm btn-primary">Tambah</a>
					</div>
				</div>
			</div>
			@livewire('personel.main', ['id_jenis_personel' => $id_jenis_personel ?? 0])
		</div>
	</div>
@endsection