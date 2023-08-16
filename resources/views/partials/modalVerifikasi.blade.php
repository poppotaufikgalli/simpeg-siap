<!-- Hapus Data Modal-->
<div class="modal fade" id="verifikasiModal" tabindex="-1" role="dialog" aria-labelledby="verifikasiModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="frmModalHapus" method="post" action="">
				@csrf
				<div class="modal-header">
					<h5 class="modal-title" id="verifikasiModalLabel">Verifikasi Data</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p>Apakah anda yakin memverifikasi data??</p>
					<input type="hidden" name="id_dok_hukum" id="id_dok_hukum" class="form-control">
					<input type="hidden" name="verify_stts" id="verify_stts" class="form-control">
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
	const verifikasiModal = document.getElementById('verifikasiModal')
	if(verifikasiModal){
		verifikasiModal.addEventListener('show.bs.modal', e => {
			const button = e.relatedTarget
			const router = button.getAttribute('data-bs-router')
			const id = button.getAttribute('data-bs-id')
			const verify_stts = button.getAttribute('data-bs-verify_stts')
			const recipient = button.getAttribute('data-bs-recipient')
			// If necessary, you could initiate an AJAX request here
			// and then do the updating in a callback.
			//
			// Update the modal's content.
			const modalBodyInput = verifikasiModal.querySelector('.modal-body p')
			const modalID = verifikasiModal.querySelector('.modal-body input#id_dok_hukum')
			const modalVerifyStts = verifikasiModal.querySelector('.modal-body input#verify_stts')
			const modalForm = verifikasiModal.querySelector('.modal-content form')
			const verifikasiModalLabel = verifikasiModal.querySelector('.modal-header #verifikasiModalLabel')
			const modalHeader = verifikasiModal.querySelector(".modal-header")

			if(verify_stts == 1){
				modalHeader.classList.remove('bg-success')
				modalHeader.classList.add('bg-warning')
				verifikasiModalLabel.textContent = "Batal Verifikasi Data"
				modalBodyInput.innerHTML = `<div class="d-flex align-item-center gap-4">
												<i class="bi bi-x-circle display-3 text-warning"></i> 
												<p class="m-auto">Apakah anda ingin <b>membatalkan</b> Verifikasi Data<br>"${recipient}" ??</p>`	
				//modalBodyInput.textContent = `Apakah anda ingin membatalkan memverifikasi "${recipient}" ??`	
			}else{
				modalHeader.classList.remove('bg-warning')
				modalHeader.classList.add('bg-success')
				verifikasiModalLabel.textContent = "Verifikasi Data"
				modalBodyInput.innerHTML = `<div class="d-flex align-item-center gap-4">
												<i class="bi bi-check-circle-fill display-3 text-success"></i>
												<p class="m-auto">Apakah anda yakin telah <b>memverifikasi</b> Data<br>"${recipient}" ??</p>`
				//modalBodyInput.textContent = `Apakah anda yakin memverifikasi "${recipient}" ??`
			}
			
			modalID.value = id;
			modalVerifyStts.value = verify_stts
			modalForm.action = "/"+router
		})

		verifikasiModal.addEventListener('hidden.bs.modal', event => {
		  	const modalForm = verifikasiModal.querySelector('.modal-content form')
		  	const modalID = verifikasiModal.querySelector('.modal-body input')
		  	modalID.value = '';
		  	modalForm.action = ""
		})
	}
</script>