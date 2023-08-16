<form class="d-flex flex-column gap-2" method="post" action="{{route('cariprodukhukumpost')}}" style="max-width: 30vw;">
	@csrf
	<h4 class="h-title">CARI PRODUK HUKUM</h4>
	<input class="form-control rounded-0" name="sjudul" type="search" placeholder="Cari Judul" value="{{isset($sjudul) ? $sjudul : ''}}" />
	<!--<select class="form-control rounded-0" id="stipe" name="stipe">
		<option value="0" selected>-Semua Tipe -</option>
		@if(isset($tipedokhukums))
			@foreach($tipedokhukums as $key => $value)
				@if(isset($stipe) && $stipe == $value->id)
					<option value="{{$value->id}}" selected>{{strtoupper($value->nama)}}</option>
				@else
					<option value="{{$value->id}}">{{strtoupper($value->nama)}}</option>
				@endif
			@endforeach
		@endif
	</select>-->
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
	<input class="form-control rounded-0" name="snomor" type="search" placeholder="Cari Nomor" value="{{isset($snomor) ? $snomor : ''}}" />
	<input class="form-control rounded-0" name="stahun" type="search" placeholder="Cari Tahun" value="{{isset($stahun) ? $stahun : ''}}" />
	<button class="w-100 btn btn-primary rounded-0" type="submit">
		<i class="bi bi-search"></i>
		Cari
	</button>
</form>	