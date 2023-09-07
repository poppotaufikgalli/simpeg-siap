@extends('layouts.admin.master')

@section('title', "Formulir Personil")

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid mt-n10">
		<div class="card shadow mb-4">
			<div class="card-header">
				<div class="d-flex gap-2 justify-content-between align-items-center">
					<div>
						<a href="{{route('arsip_elektronik', ['id_jenis_personel' => $id_jenis_personel])}}" class="btn btn-secondary btn-sm">
							<i class="bi bi-chevron-left"></i>
						</a>	
						<span>{{$PageTitle ?? $title}}</span>
					</div>
					<div class="float-end">
						<input type="search" class="form-control" size="30" id="id" name="id" value="{{$id ?? null}}" placeholder="cari :NIP">	
					</div>
				</div>
			</div>
			@php($mylive = str_replace('_','-',$route) . '.formulir')
			@livewire($mylive, ['method' => $method, 'next' => $next, 'sid' => $id ?? ''])
		</div>
	</div>
@endsection

@section('js-content')
	<script>
		//Dropzone.autoDiscover = false;
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
	    			window.location.href = "/pegawai/create/";
	    		}else{
	    			window.location.href = "/pegawai/edit/"+nip;
	    		}
	    	}
	    })

	    document.addEventListener("DOMContentLoaded", () => {
		  	var hash = location.hash.replace(/^#/, "");
		  	//alert(hash)
			if (hash) {
			  	var triggerEl = document.querySelector("#" + hash + "-tab");
			  	triggerEl.click();
			}
		})

		window.addEventListener('reloadPage', function(e) {
	        console.log(e)
	        const {detail} = e;
	        window.location.hash = detail
	        location.reload();
	    });
	</script>
@endsection