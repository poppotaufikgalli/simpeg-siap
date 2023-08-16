<div class="card card-body small mb-2">
	<form class="row" method="post" action="" >
		@csrf
		<div class="col-lg-2">
			<h5 class="h-title">CARI PRODUK HUKUM</h5>
		</div>
		<div class="col-lg-10">
			<div class="d-flex flex-column gap-2">
				<input type="hidden" name="verify_stts" value="{{$verify_stts}}">
				<input class="form-control rounded-0" name="judul" type="search" placeholder="Masukkan Kata Judul" value="{{isset($input['judul']) ? $input['judul'] : ''}}" />
				<div class="row g-2 mb-2">
					<div class="col-lg-3 col-md-6 col-sm-12">
						<select class="form-control rounded-0" id="id_jns_hukum" name="id_jns_hukum">
							<option value="" selected disabled>-Semua Jenis -</option>
							@if(isset($jnshukums))
								@foreach($jnshukums as $key => $value)
									@if(isset($input['id_jns_hukum']) && $input['id_jns_hukum'] == $value->id)
										<option value="{{$value->id}}" selected>{{strtoupper($value->nama)}}</option>
									@else
										<option value="{{$value->id}}">{{strtoupper($value->nama)}}</option>
									@endif
								@endforeach
							@endif
						</select>
					</div>
					<div class="col">
						<input class="form-control rounded-0" name="nomor_peraturan" type="search" placeholder="Cari Nomor" value="{{isset($input['nomor_peraturan']) ? $input['nomor_peraturan'] : ''}}" />
					</div>
					<div class="col">
						<input class="form-control rounded-0" name="tahun_peraturan" type="search" placeholder="Cari Tahun" value="{{isset($input['tahun_peraturan']) ? $input['tahun_peraturan'] : ''}}" />
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12">
						<div class="d-flex gap-1">
							<button class="w-100 btn btn-primary rounded-0" type="submit">
								<i class="bi bi-search"></i>
								Cari
							</button>
							<a href="{{url()->current()}}" class="w-10 btn btn-danger rounded-0">
								<i class="bi bi-x"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>	
</div>