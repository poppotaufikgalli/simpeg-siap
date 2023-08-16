<div class="modal fade" id="modalUploadArsip" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	    	<div class="modal-body">
	    		<div class="mb-2 row">
	                <label id="ndokUpload" class="col-sm-2 col-form-label">Upload Dokumen</label>
	                <div class="col-sm-10">
	                    <div class="needsclick dropzone" id="document-dropzone"></div>
	                </div>
	            </div>
				@if(count($dataset) > 0)
					@foreach($dataset as $key => $value)
						<div class="mb-2">
							{{$value->filename}}
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	const modalUploadArsip = document.getElementById('modalUploadArsip')
	var myDropzone;
	modalUploadArsip.addEventListener('show.bs.modal', event => {
		const button = event.relatedTarget
		var _url = button.getAttribute('data-bs-url');
		var _filename = button.getAttribute('data-bs-filename');
		var _sid = button.getAttribute('data-bs-sid');
		var _kdok = button.getAttribute('data-bs-kdok');
		var _ndok = button.getAttribute('data-bs-ndok');
		document.getElementById('ndokUpload').innerHTML = "Upload Dokumen "+_ndok

		myDropzone = new Dropzone("div#document-dropzone", { 
			url: _url,
			chunking: true,
			//autoProcessQueue: false,
			maxFiles: 1,
			method: "POST",
			maxFilesize: 40000000000,
			chunkSize: 1000000,
			parallelChunkUploads: true,
			acceptedFiles: ".pdf,.PDF, image/*",
		});

		myDropzone.on("addedfile", file => {
			let extension = file.name.split('.').pop();
			//console.log(extension)
			_filename += "."+extension;
		});

		myDropzone.on("sending", function(file, xhr, formData) {
			//let extension = file.name.split('.').pop();
			//console.log(extension)
			formData.append("_token", '{{ csrf_token() }}');
			formData.append("nama_file", _filename);
			formData.append("sid", _sid);
			formData.append("kdok", _kdok);
			formData.append("ndok", _ndok);
		});

		myDropzone.on("success", function(file, response) {
			console.log("success")
		});
	})
	
	modalUploadArsip.addEventListener('hidden.bs.modal', event => {
	  	myDropzone.destroy();
	})
</script>