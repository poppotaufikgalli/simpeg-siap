<!-- Gambar Data Modal-->
<div class="modal fade" id="gambarModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form method="post" action="{{route('config.destroy', ['method' => 'banner', 'page' => 'banner'])}}" >
	    		@csrf
	    		<div class="position-relative">
					<img src="" class="mx-auto d-block" style="max-height: 80vh;">
					<input type="hidden" name="filename" id="filename">
					<div class="position-absolute top-0 end-0">
						<button class="btn btn-sm btn-danger">Hapus</button>	
					</div>
					
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	const gambarModal = document.getElementById('gambarModal')
	if(gambarModal){
		gambarModal.addEventListener('show.bs.modal', e => {
			const button = e.relatedTarget
			const src = button.getAttribute('data-bs-src')
			const filename = button.getAttribute('data-bs-filename')
			// If necessary, you could initiate an AJAX request here
			// and then do the updating in a callback.
			//
			// Update the modal's content.
			const img = gambarModal.querySelector('.modal-content img')
			const ifilename = gambarModal.querySelector('.modal-content input#filename')
			//const page = gambarModal.querySelector('.modal-content input#page')

			img.src = src;
			ifilename.value = filename;
		})
	}
</script>