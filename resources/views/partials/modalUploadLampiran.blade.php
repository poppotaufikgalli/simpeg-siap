<div class="modal fade" id="modalUpload" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	    	<div class="modal-body">
				<form id="uploaderForm" method="post" action="{{route($next, ['method' => $method, 'page' => 'fileinfo'])}}" enctype="multipart/form-data">
					@csrf
					<div class="mb-2 row">
						<div class="col-sm-9 offset-sm-3 d-flex gap-2">
							<input type="hidden" name="id_dok_hukum" class="form-control id_dok_hukum_file" value="{{$data->id ?? null}}">
							<input type="hidden" name="nama_file" class="form-control nama_file">
							<input type="hidden" name="id" class="form-control id_file">
						</div>
					</div>
					<div class="mb-2 row">
						<label for="jns" class="col-sm-3 col-form-label">Jenis Dokumen</label>
						<div class="col-sm-9">
							<input type="text" class="form-control jns_file" name="jns" id="jns" readonly>
						</div>
					</div>
					<div class="mb-2 row">
						<label for="judul" class="col-sm-3 col-form-label">Judul Dokumen</label>
						<div class="col-sm-9">
							<input type="text" class="form-control judul_file" name="judul" id="judul" required>
						</div>
					</div>
					<div class="mb-2 row">
						<label for="" class="col-sm-3 col-form-label">Upload Lampiran</label>
						<div class="col-sm-9">
							<div class="needsclick dropzone" id="document-dropzone">
							</div>
						</div>
					</div>
					<div class="mb-1 row">
						<div class="col-sm-9 offset-sm-3">
							<button class="btn btn-sm btn-primary" type="submit" id="btnSubmitLampiran">Upload</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	const modalUpload = document.getElementById('modalUpload')
	modalUpload.addEventListener('show.bs.modal', event => {
		const button = event.relatedTarget
		const jns = button.getAttribute('data-bs-jns')
		//console.log(jns)
		const judul = button.getAttribute('data-bs-judul')
		const nama_file = button.getAttribute('data-bs-nama_file')
		const id_file = button.getAttribute('data-bs-id_file')
		const modalBodyInputjns = modalUpload.querySelector('.modal-body input.jns_file')
		const modalBodyInputjudul = modalUpload.querySelector('.modal-body input.judul_file')
		const modalBodyInputnama = modalUpload.querySelector('.modal-body input.nama_file')
		const modalBodyInputidfile = modalUpload.querySelector('.modal-body input.id_file')
		modalBodyInputjns.value = jns
		modalBodyInputjudul.value = judul
		modalBodyInputnama.value = nama_file
		modalBodyInputidfile.value = id_file
	})

	modalUpload.addEventListener('shown.bs.modal', event => {
		const button = event.relatedTarget
		const jns = button.getAttribute('data-bs-jns')
		
		if(jns == 'Gambar'){
			document.querySelector(".dz-hidden-input").setAttribute('accept', 'image/*');
		}else{
			document.querySelector(".dz-hidden-input").setAttribute('accept', ".pdf,.PDF");
		}
	})
</script>