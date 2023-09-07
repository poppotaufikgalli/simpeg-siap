@extends('layouts.admin.master')

@section('title', $PageTitle)

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid mt-n10">
		@include('partials/toast')
		<div class="card shadow mb-4">
			@livewire('arsip-elektronik.main', ['id_jenis_personel' => $id_jenis_personel ?? 0])
		</div>
	</div>
@endsection