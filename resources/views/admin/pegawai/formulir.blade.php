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
					<div class="float-end">
						<input type="search" class="form-control" size="30" id="id" name="id" value="{{$id ?? null}}" placeholder="cari :NIP">	
					</div>
				</div>
			</div>
			<div class="card-body mb-3">
				<ul class="nav nav-tabs" id="myTaba" role="tablist">
				  	<li class="nav-item" role="presentation">
				    	<button class="nav-link active" id="data-induk-tab" data-bs-toggle="tab" data-bs-target="#data-induk-tab-pane" type="button" role="tab" aria-controls="data-induk-tab-pane" aria-selected="true">Data Induk</button>
				  	</li>
				  	<li class="nav-item" role="presentation">
				    	<button class="nav-link" id="riwayat-pegawai-tab" data-bs-toggle="tab" data-bs-target="#riwayat-pegawai-tab-pane" type="button" role="tab" aria-controls="riwayat-pegawai-tab-pane" aria-selected="false">Riwayat Pegawai</button>
				  	</li>
				  	<li class="nav-item" role="presentation">
				    	<button class="nav-link" id="riwayat-pendidikan-tab" data-bs-toggle="tab" data-bs-target="#riwayat-pendidikan-tab-pane" type="button" role="tab" aria-controls="riwayat-pendidikan-tab-pane" aria-selected="false">Riwayat Pendidikan</button>
				  	</li>
				  	<li class="nav-item" role="presentation">
				    	<button class="nav-link" id="data-keluarga-tab" data-bs-toggle="tab" data-bs-target="#data-keluarga-tab-pane" type="button" role="tab" aria-controls="data-keluarga-tab-pane" aria-selected="false">Data Keluarga</button>
				  	</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="data-induk-tab-pane" role="tabpanel" aria-labelledby="data-induk-tab" tabindex="0">
						@include('admin.pegawai.data-induk.index')
					</div>
					<div class="tab-pane fade" id="riwayat-pegawai-tab-pane" role="tabpanel" aria-labelledby="riwayat-pegawai-tab" tabindex="0">
						@include('admin.pegawai.riwayat-pegawai.index')
					</div>
					<div class="tab-pane fade" id="riwayat-pendidikan-tab-pane" role="tabpanel" aria-labelledby="riwayat-pendidikan-tab" tabindex="0">
						@include('admin.pegawai.riwayat-pendidikan.index')
					</div>
					<div class="tab-pane fade" id="data-keluarga-tab-pane" role="tabpanel" aria-labelledby="data-keluarga-tab" tabindex="0">
						@include('admin.pegawai.data-keluarga.index')
					</div>
				</div>
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