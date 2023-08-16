<div class="container-fluid">
    <form method="post" class="mb-3" action="{{route('config.store', ['method' => 'intro', 'page' => 'intro'])}}" enctype="multipart/form-data">
    	@csrf
    	<div class="mb-2 row">
			<label for="" class="col-sm-3 col-form-label">Upload Website Intro</label>
			<div class="col-sm-9">
				<div class="needsclick dropzone" id="document-dropzone"></div>
			</div>
		</div>
    </form>
    @if(isset($lsintro))
    	<div class="row">
	    	@foreach($lsintro as $key => $value)
	    		<div class="col-sm-9 offset-sm-3">
	    			<div class="card card-body py-1 mb-1">
	    				<div class="d-flex justify-content-between align-items-center">
	    					<div class="d-flex flex-row">
			    				<button class="btn btn-sm btn-danger"
			    					data-bs-toggle="modal" 
			                        data-bs-target="#hapusModal" 
			                        data-bs-target1="intro" 
			                        data-bs-id_tipe_dok_hukum="destroy"
			                        data-bs-router="config"
			                        data-bs-id="{{$value['basename']}}" 
			                        data-bs-recipient="{{$value['basename']}}"
			    				>
			    					<i class="bi bi-trash3-fill"></i>
			    				</button>
			    			</div>
	    					{{$value['basename']}}
	    					<audio controls>
							  	<source src="{{asset('images/intro/'.$value['basename'])}}" type="audio/mpeg">
								Your browser does not support the audio element.
							</audio>
			    			<form class="row" method="post" action="{{route('config.store', ['method' => 'update', 'page' => 'active_intro'])}}">
								@csrf
								@if($value['basename'] == $active)
									<button class="btn btn-sm btn-warning"><i class="bi bi-x-circle-fill"></i></button>	
								@else
									<button class="btn btn-sm btn-success"><i class="bi bi-check-circle-fill"></i></button>	
								@endif
								<input type="hidden" name="filename" value="{{$value['basename']}}">
								<input type="hidden" name="stts" value="{{$value['basename'] == $active}}">
							</form>
		    			</div>
	    			</div>
	    		</div>
	    	@endforeach
	    </div>
    @endif
</div>