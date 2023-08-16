<!-- Hapus Data Modal-->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form id="frmModalHapus" method="post" action="">
				@csrf
				<div class="modal-header">
					<h5 class="modal-title" id="hapusModalLabel">Menghapus Data</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p>Apakah anda yakin menghapus data??</p>
					<input type="hidden" name="id" id="id" class="form-control">
					<input type="hidden" name="hash" id="hash" class="form-control">
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
					<button class="btn btn-danger" type="submit">Hapus</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	const hapusModal = document.getElementById('hapusModal')
	if(hapusModal){
		hapusModal.addEventListener('show.bs.modal', e => {
			const button = e.relatedTarget
			const target1 = button.getAttribute('data-bs-target1')
			const router = button.getAttribute('data-bs-router')
			const id = button.getAttribute('data-bs-id')
			const hash = button.getAttribute('data-bs-hash');
			//const id_tipe_dok_hukum = button.getAttribute('data-bs-id_tipe_dok_hukum')
			const recipient = button.getAttribute('data-bs-recipient')
			// If necessary, you could initiate an AJAX request here
			// and then do the updating in a callback.
			//
			// Update the modal's content.
			const modalTitle = hapusModal.querySelector('.modal-title')
			const modalBodyInput = hapusModal.querySelector('.modal-body p')
			const modalID = hapusModal.querySelector('.modal-body input#id')
			const modalForm = hapusModal.querySelector('.modal-content form')
			const modalHash = hapusModal.querySelector('.modal-body input#hash')

			modalTitle.textContent = `Menghapus Data ${target1}`
			modalBodyInput.textContent = `Apakah anda yakin menghapus "${recipient}" ??`
			modalID.value = id;
			modalHash.value = hash;
			modalForm.action = "/"+router+"/destroy"
		})

		hapusModal.addEventListener('hidden.bs.modal', event => {
		  	const modalForm = hapusModal.querySelector('.modal-content form')
		  	const modalID = hapusModal.querySelector('.modal-body input#id')
		  	const modalHash = hapusModal.querySelector('.modal-body input#hash')
		  	modalID.value = '';
		  	modalHash.value = '';
		  	modalForm.action = "";
		})
	}
</script>