@extends('layouts.admin.master')

@section('title', $PageTitle)

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid mt-n10">
		<div class="card shadow mb-4">
			<div class="card-header">
				<div class="d-flex gap-2 justify-content-between align-items-center">
					<a href="{{route('personel', ['id_jenis_personel' => $id_jenis_personel])}}" class="btn btn-secondary btn-sm">
						<i class="bi bi-chevron-left"></i>
						Kembali
					</a>
					<div class="float-end">
						<input type="search" class="form-control" size="30" id="id" name="id" value="{{$id ?? null}}" placeholder="cari :NIP/NRP">	
					</div>
				</div>
			</div>
			<div class="card-body mb-3">
				@livewire('personel.data-induk.profil', [
                    'method' => $method, 
                    'next' => $next, 
                    'dataset' => $dataset ?? '',
                    'sid' => $id ?? '',
                    'id_jenis_personel' => $id_jenis_personel,
                ]) 
			</div>
		</div>
	</div>
@endsection

@section('js-content')
	<script>
		var id_jenis_personel = '{{$id_jenis_personel}}';

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

	    document.getElementById('id').addEventListener("keypress", function(event){
	    	if(event.key === 'Enter'){
	    		event.preventDefault();
	    		var nip = this.value;
	    		//alert(nip == '')
	    		if(nip == ''){
	    			window.location.href = "/personel/"+id_jenis_personel+"/create/";
	    		}else{
	    			window.location.href = "/personel/"+id_jenis_personel+"/edit/"+nip;
	    		}
	    	}
	    })
	</script>
@endsection