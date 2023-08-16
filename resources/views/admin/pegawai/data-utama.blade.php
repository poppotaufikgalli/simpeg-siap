@extends('layouts.admin.master')

@section('title', "Formulir Personil")

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid mt-n10">
		<div class="card shadow mb-4">
			<div class="card-header">
				<div class="d-flex gap-2 justify-content-between align-items-center">
					<div>
						<a href="{{route('pegawai')}}" class="btn btn-secondary btn-sm">
							<i class="bi bi-chevron-left"></i>
						</a>	
						<span>{{$PageTitle ?? $title}}</span>
					</div>
				</div>
			</div>
			<div class="card-body mb-3">
				@livewire('pegawai.data-induk.identitas-pegawai', [
                    'method' => $method, 
                    'next' => $next, 
                    'dataset' => $dataset ?? '',
                    'sid' => $id ?? '',
                ]) 
			</div>
		</div>
	</div>
@endsection

@section('js-content')
	<script>
	    window.addEventListener('errors', function(e) {
	        const notyf = new Notyf();
	        const {detail} = e;

	        var lserror = Object.values(detail);
	        console.log(lserror)
	        if(lserror.length > 0){
	            for (var i = lserror.length - 1; i >= 0; i--) {
	                notyf.error(lserror[i][0])
	            }
	        }
	    });

	    window.addEventListener('informations', function(e) {
	        const notyf = new Notyf();
	        const {detail} = e;

	        notyf.success(detail)
	    });
	</script>
@endsection