<div class="modal fade" id="modalFlipbook" tabindex="-1" aria-labelledby="modalFlipbookLabel" aria-hidden="true">
  	<div class="modal-dialog modal-xl ">
    	<div class="modal-content" id="modalContent">
      		<iframe class="flip-iframe" style="height: 95vh;"></iframe>
  		</div>
	</div>
</div>
<script type="text/javascript">
	const modalFlipbook = document.getElementById('modalFlipbook');
	const flipIframe = document.querySelector('.flip-iframe')

	modalFlipbook.addEventListener('shown.bs.modal', event => {
	  	const button = event.relatedTarget
	  	const path = button.getAttribute('data-bs-path')
	  	const filename = button.getAttribute('data-bs-filename')
	  	flipIframe.setAttribute('src', "/flipbook2/"+path+"/"+filename)		  
	})

	modalFlipbook.addEventListener('hide.bs.modal', event => {
		//flipIframe.setAttribute('src', null)		  	
	})
</script>