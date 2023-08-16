<!-- Hapus Data Modal-->
<div class="modal fade" id="publikasiModalContent" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="formVerifikasi" method="post" action="">
				@csrf
				<div class="modal-header">
					<h5 class="modal-title" id="hapusModalLabel">Publikasi Data</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p>Apakah anda telah memverifikasi data??</p>
					<input type="hidden" name="id" id="id" class="form-control">
					<label>Catatan</label>
					<textarea class="form-control" name="catatan"></textarea>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
					<button class="btn btn-success" type="submit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	const publikasiModalContent = document.getElementById('publikasiModalContent')	
	if(publikasiModalContent){
		publikasiModalContent.addEventListener('show.bs.modal', event => {
			const button = event.relatedTarget
			const router = button.getAttribute('data-bs-router')
			const method = button.getAttribute('data-bs-method')
			const publish = button.getAttribute('data-bs-publish')
			const id = button.getAttribute('data-bs-id')
			const recipient = button.getAttribute('data-bs-recipient')
			// If necessary, you could initiate an AJAX request here
			// and then do the updating in a callback.
			//
			// Update the modal's content.
			const modalBodyInput = publikasiModalContent.querySelector('.modal-body p')
			const modalID = publikasiModalContent.querySelector('.modal-body input#id')
			const modalForm = publikasiModalContent.querySelector('.modal-content form')
			const hapusModalLabel = publikasiModalContent.querySelector("#hapusModalLabel")
			const modalHeader = publikasiModalContent.querySelector(".modal-header")

			if(publish == 'Y'){
				modalBodyInput.innerHTML = `<div class="d-flex align-item-center gap-4">
												<i class="bi bi-x-circle display-3 text-warning"></i> 
												<p class="m-auto">Apakah anda ingin <b>membatalkan</b> Publikasi Data<br>"${recipient}" ??</p>`	
				hapusModalLabel.textContent = "Batal Publikasi"
				modalHeader.classList.add('bg-warning')
				modalHeader.classList.remove('bg-success')
			}else{
				modalBodyInput.innerHTML = `<div class="d-flex align-item-center gap-4">
												<i class="bi bi-check-circle-fill display-3 text-success"></i>
												<p class="m-auto">Apakah anda yakin telah <b>memverifikasi</b> Data<br>"${recipient}" ??</p>`
				hapusModalLabel.textContent = "Verifikasi dan Publikasi"
				modalHeader.classList.add('bg-success')
				modalHeader.classList.remove('bg-warning')
			}
			
			modalID.value = id;
			modalForm.action = "/"+router+"/"+method
		})

		publikasiModalContent.addEventListener('hidden.bs.modal', event => {
		  	const modalForm = publikasiModalContent.querySelector('.modal-content form')
		  	const modalID = publikasiModalContent.querySelector('.modal-body input')
		  	modalID.value = '';
		  	modalForm.action = ""
		})
	}
</script>