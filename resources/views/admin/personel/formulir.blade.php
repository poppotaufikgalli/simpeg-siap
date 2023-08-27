@extends('layouts.admin.master')

@section('title', "Formulir Personil")

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid mt-n10">
		<div class="card shadow mb-4">
			<div class="card-header">
				<div class="d-flex gap-2 justify-content-between align-items-center">
					<div>
						<a href="{{route('personel', ['id_jenis_personel' => $id_jenis_personel])}}" class="btn btn-secondary btn-sm">
							<i class="bi bi-chevron-left"></i>
						</a>	
						<span>{{$PageTitle ?? $title}}</span>
					</div>
					<div class="float-end">
						<input type="search" class="form-control" size="30" id="id" name="id" value="{{$id ?? null}}" placeholder="cari :NIP">	
					</div>
				</div>
			</div>
			<div class="card-body mb-3">
				@php($mid = str_replace('/','-', $id))
				@php($activePage = request()->route('page'))
				<ul class="nav nav-tabs">
				  	<li class="nav-item">
				    	<a class="nav-link {{$activePage == 'data-induk' ? 'active' : ''}}" aria-current="page" href="{{route('personel.edit', ['id' => $mid, 'id_jenis_personel' => $id_jenis_personel, 'page' => 'data-induk'])}}">Data Induk</a>
				  	</li>
				  	<li class="nav-item">
				    	<a class="nav-link {{$activePage == 'riwayat-pegawai' ? 'active' : ''}}" href="{{route('personel.edit', ['id' => $mid, 'id_jenis_personel' => $id_jenis_personel, 'page' => 'riwayat-pegawai'])}}">Riwayat Pegawai</a>
				  	</li>
				  	<li class="nav-item">
				    	<a class="nav-link {{$activePage == 'riwayat-pendidikan' ? 'active' : ''}}" href="{{route('personel.edit', ['id' => $mid, 'id_jenis_personel' => $id_jenis_personel, 'page' => 'riwayat-pendidikan'])}}">Riwayat Pendidikan</a>
				  	</li>
				  	<li class="nav-item">
				    	<a class="nav-link {{$activePage == 'data-keluarga' ? 'active' : ''}}" href="{{route('personel.edit', ['id' => $mid, 'id_jenis_personel' => $id_jenis_personel, 'page' => 'data-keluarga'])}}">Data Keluarga</a>
				  	</li>
				</ul>
				@php($selRoute = 'admin.personel.'.$page.'.index')
				@include($selRoute)
			</div>
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
	    

	    //Dropzone.autoDiscover = false;
        /*document.addEventListener("DOMContentLoaded", function() {
            let myDropzone = new Dropzone("div#dropzone-cpns", { 
                url: "{{route('pegawai.store', ['page' => 'cpns'])}}",
                chunking: true,
                //clickable: true,
                //addRemoveLinks: true,
                maxFiles: 1,
                method: "POST",
                maxFilesize: 40000000000,
                chunkSize: 1000000,
                parallelChunkUploads: true,
                acceptedFiles: ".pdf,.PDF, image/*",
            });

            myDropzone.on("addedfile", file => {
                let extension = file.name.split('.').pop();
                document.getElementById('file_skcpns').value = 'cpns_'+document.getElementById('tmtcpns').value+"."+extension;

                console.log(file)
            });

            myDropzone.on("sending", function(file, xhr, formData) {
                formData.append("_token", '{{ csrf_token() }}');
                formData.append("sid", document.getElementById('sid').value) ;
                formData.append("nama_file", document.getElementById('file_skcpns').value);
            });

            myDropzone.on("success", function(file, response) {
                console.log("success")
                document.getElementById('file_skcpns').click();
                document.getElementById("file_skcpns").dispatchEvent(new Event('input'));

                if(response != 0){
                   var anchorEl = document.createElement('a');
                   anchorEl.setAttribute('href',response);
                   anchorEl.setAttribute('target','_blank');
                   anchorEl.innerHTML = "<br>Download File";
                   file.previewTemplate.appendChild(anchorEl);
                }
            });
        });*/
	</script>
@endsection