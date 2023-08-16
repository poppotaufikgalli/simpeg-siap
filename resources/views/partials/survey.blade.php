@if(1)
	<section id="surveySection">
		<div class="container container-jdih">
			<div class="row align-items-start my-5">
				<div class="col-sm-12 col-md-8 col-lg-8">
					<h4 class="mb-3 h-title">Survey Website JDIH</h4>
					<p>Silahkan mengisi data survey Kami</p>
					<p class="text-muted">
						Terima kasih atas penilaian yang telah anda berikan, masukan anda sangat bermanfaat untuk kemajuan unit kami agar terus memperbaiki dan meningkatkan kualitas pelayanan bagi masyarakat
					</p>
					@if(!Cookie::get('jdih'))
						<div class="my-5">
							<button id="btnSurvey" class="small btn btn-sm btn-outline-primary rounded-0" type="button" data-bs-toggle="modal" data-bs-target="#modalSurvey" aria-expanded="false" aria-controls="modalSurvey">
	    						Ikuti Survey
	  						</button>
						</div>
					@endif
				</div>
				<div class="col-sm-12 col-md-4 col-lg-4">
					<div class="card card-body">
						<p class="h-title">Apakah Informasi Hukum pada Website JDIH Kota Tanjungpinang membantu Anda?</p>
						<div class="d-flex mx-auto" style="max-width: 200px;">
							<canvas id="surveyChart">sdsa</canvas>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<!-- Modal -->
		<div class="modal fade" id="modalSurvey" tabindex="-1" aria-labelledby="modalSurveyLabel" aria-hidden="true">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-body">
						<h5 class="h-title">Apakah Informasi Hukum pada Website JDIH Kota Tanjungpinang membantu Anda?</h5>
						<form class="d-flex flex-column" method="post" action="{{route('survey')}}" >
							@csrf
							<div class="m-4 mx-auto">
								<div class="form-check form-check-inline">
								  	<input class="form-check-input" type="radio" name="nilai" id="chSurveyYa" value="1" required>
								  	<label class="form-check-label" for="chSurveyYa">
								    	Ya
								  	</label>
								</div>
								<div class="form-check form-check-inline">
								  	<input class="form-check-input" type="radio" name="nilai" id="chSurveyTidak" value="0">
								  	<label class="form-check-label" for="chSurveyTidak">
								    	Tidak
								  	</label>
								</div>
							</div>
							<div class="mb-4 text-center">
							  	<label for="email" class="form-label">Email Anda</label>
							  	<input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
							  	<input type="hidden" class="form-control" id="ip" name="ip" value="{{visitor()->ip()}}">
							  	<input type="hidden" class="form-control" id="browser" name="browser" value="{{ visitor()->browser() }}">
							  	<input type="hidden" class="form-control" id="judul" name="judul" value="Apakah Informasi Hukum pada Website JDIH Kota Tanjungpinang membantu Anda?">
							</div>
							<button class="btn btn-sm btn-primary" type="submit">Simpan</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		
	</script>
@endif