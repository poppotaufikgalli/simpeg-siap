<form class="d-flex flex-row gap-2" method="post" action="{{route('cariprodukhukumpost')}}" >
	@csrf
	<h3 class="h-title">CARI PRODUK HUKUM</h3>
	<div class="d-flex flex-column gap-2">
		<input class="form-control rounded-0" name="sjudul" type="search" placeholder="Masukkan Kata Kunci" value="{{isset($sjudul) ? $sjudul : ''}}" />
		<div class="row g-2 mb-2">
			<div class="col-lg-3 col-md-6 col-sm-12">
				<select class="form-control rounded-0" id="sjns" name="sjns">
					<option value="0" selected>-Semua Jenis -</option>
					@if(isset($jnshukums))
						@foreach($jnshukums as $key => $value)
							@if(isset($sjns) && $sjns == $value->id)
								<option value="{{$value->id}}" selected>{{strtoupper($value->nama)}}</option>
							@else
								<option value="{{$value->id}}">{{strtoupper($value->nama)}}</option>
							@endif
						@endforeach
					@endif
				</select>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12">
				<input class="form-control rounded-0" name="snomor" type="search" placeholder="Cari Nomor" value="{{isset($snomor) ? $snomor : ''}}" />
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12">
				<input class="form-control rounded-0" name="stahun" type="search" placeholder="Cari Tahun" value="{{isset($stahun) ? $stahun : ''}}" />
			</div>
			<div class="col-lg-3 col-md-6 col-sm-12">
				<button class="w-100 btn btn-primary rounded-0" type="submit">
					<i class="bi bi-search"></i>
					Cari
				</button>
			</div>
		</div>
	</div>
</form>	