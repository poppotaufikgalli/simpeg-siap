<div>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
	<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <div class="container-fluid">
	    <form method="post" class="mb-3" action="{{route('config.store', ['method' => 'banner', 'page' => 'banner'])}}" enctype="multipart/form-data">
	    	@csrf
	    	<div class="input-group mb-3">
			  	<input type="file" id="guid" name="guid" class="form-control" accept="image/jpg,image/png" required>
			  	<button class="btn btn-outline-secondary" type="submit" id="button-addon1">Upload</button>
			</div>
			<small class="fst-italic">*File Banner adalah gambar tidak lebih dari 2mb</small>
	    </form>
	    @if(isset($lsbanner))
	    	<div class="row g-4">
		    	@foreach($lsbanner as $key => $value)
		    		<div class="col-4">
		    			<!--<a href="#" class="hvr-float-shadow" data-bs-toggle="modal" data-bs-target="#gambarModal" data-bs-src="{{asset('images/banner/'.$value['basename'])}}" data-bs-filename="{{$value['basename']}}">-->
		    			<div class="position-relative">
			    			<a href="{{asset('images/banner/'.$value['basename'])}}" class="glightbox" data-gallery="gallery">
		    					<img src="{{asset('images/banner/'.$value['basename'])}}" class="img-thumbnail d-block" alt="{{$value['filename']}}"
		    					>
		    				</a>
		    				<div class="position-absolute top-0 start-0">
			    				<button class="btn btn-sm btn-danger"
			    					data-bs-toggle="modal" 
			                        data-bs-target="#hapusModal" 
			                        data-bs-target1="Banner" 
			                        data-bs-id_tipe_dok_hukum="destroy"
			                        data-bs-router="config"
			                        data-bs-id="{{$value['basename']}}" 
			                        data-bs-recipient="{{$value['basename']}}"
			    				>
			    					<i class="bi bi-trash3-fill"></i>
			    				</button>
			    			</div>
		    			</div>
		    		</div>
		    	@endforeach
		    </div>
	    @endif
	</div>
</div>