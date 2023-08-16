<div id="detailprodukhukum">
	@if(isset($listfield))
	<table class="table small table-bordered table-striped">
		@if(isset($listfield['judul']))
		<tr>
			<td>{{$listfield['judul']}}</td>
			<td colspan="2">{{$data->judul}}</td>
		</tr>
		@endif
		@if(isset($listfield['nomor_peraturan']))
		<tr>
			<td>{{$listfield['nomor_peraturan']}}</td>
			<td colspan="2">{{$data->nomor_peraturan}}</td>
		</tr>
		@endif
		@if(isset($listfield['id_tipe_dok_hukum']))
		<tr>
			<td width="25%">{{$listfield['id_tipe_dok_hukum']}}</td>
			<td colspan="2">{{$data->tipe_dok_hukum}}</td>
		</tr>
		@endif
		@if(isset($listfield['id_jns_hukum']))
		<tr>
			<td>{{$listfield['id_jns_hukum']}}</td>
			<td colspan="2">{{$data->jns_hukum}}</td>
		</tr>
		@endif
		@if(isset($listfield['tahun_peraturan']))
		<tr>
			<td>{{$listfield['tahun_peraturan']}}</td>
			<td colspan="2">{{$data->tahun_peraturan}}</td>
		</tr>
		@endif
		@if(isset($listfield['tgl_penetapan']))
		<tr>
			<td>{{$listfield['tgl_penetapan']}}</td>
			<td colspan="2">
				{{$data->tgl_penetapan}}
				@if(isset($listfield['bln_penetapan']))
					-{{$data->bln_penetapan}}-
				@endif
				@if(isset($listfield['thn_penetapan']))
					{{$data->thn_penetapan}}
				@endif
			</td>
		</tr>
		@endif
		@if(isset($listfield['tgl_pengundangan']))
		<tr>
			<td>{{$listfield['tgl_pengundangan']}}</td>
			<td colspan="2">{{$data->tgl_pengundangan}}</td>
		</tr>
		@endif
		@if(isset($listfield['urusan_pemerintahan']))
		<tr>
			<td>{{$listfield['urusan_pemerintahan']}}</td>
			<td colspan="2">{{$data->urusan_pemerintahan}}</td>
		</tr>
		@endif
		@if(isset($listfield['teu_utama']))
		<tr>
			<td rowspan="3">{{$listfield['teu_utama']}}</td>
			<td width="25%">{{$listfield['jns_teu']}}</td>
			<td>{{$data->jns_teu}}</td>
		</tr>
		<tr>
			<td>T.E.U Utama</td>
			<td>{{$data->teu_utama}}</td>
		</tr>
		@endif
		@if(isset($listfield['teu_tambahan']))
		<tr>
			<td>T.E.U Tambahan</td>
			<td>{{$data->teu_tambahan}}</td>
		</tr>
		@endif
		@if(isset($listfield['edisi']))
		<tr>
			<td>{{$listfield['edisi']}}</td>
			<td colspan="2">{{$data->edisi}}</td>
		</tr>
		@endif
		@if(isset($listfield['tempat_terbit']))
		<tr>
			<td>{{$listfield['tempat_terbit']}}</td>
			<td colspan="2">{{$data->tempat_terbit}}</td>
		</tr>
		@endif
		@if(isset($listfield['penerbit']))
		<tr>
			<td>{{$listfield['penerbit']}}</td>
			<td colspan="2">{{$data->penerbit}}</td>
		</tr>
		@endif
		@if(isset($listfield['penandatanganan']))
		<tr>
			<td>{{$listfield['penandatanganan']}}</td>
			<td colspan="2">{{$data->penandatanganan}}</td>
		</tr>
		@endif
		@if(isset($listfield['deskripsi_fisik']))
		<tr>
			<td>{{$listfield['deskripsi_fisik']}}</td>
			<td colspan="2">{{$data->deskripsi_fisik}}</td>
		</tr>
		@endif
		@if(isset($listfield['subjek']))
		<tr>
			<td>{{$listfield['subjek']}}</td>
			<td colspan="2">{{$data->subjek}}</td>
		</tr>
		@endif
		@if(isset($listfield['isbn']))
		<tr>
			<td>{{$listfield['isbn']}}</td>
			<td colspan="2">{{$data->isbn}}</td>
		</tr>
		@endif
		@if(isset($listfield['bahasa']))
		<tr>
			<td>{{$listfield['bahasa']}}</td>
			<td colspan="2">{{$data->bahasa}}</td>
		</tr>
		@endif
		@if(isset($listfield['ref_lokasi']))
		<tr>
			<td>{{$listfield['ref_lokasi']}}</td>
			<td colspan="2">{{$data->nama_wilayah}}</td>
		</tr>
		@endif
		@if(isset($listfield['id_bidang_hukum']))
		<tr>
			<td>{{$listfield['id_bidang_hukum']}}</td>
			<td colspan="2">{{$data->bidang_hukum}}</td>
		</tr>
		@endif
		@if(isset($listfield['nomor_induk_buku']))
		<tr>
			<td>{{$listfield['nomor_induk_buku']}}</td>
			<td colspan="2">{{$data->nomor_induk_buku}}</td>
		</tr>
		@endif
	</table>
	<table class="table small table-bordered table-striped">
		@if(isset($listfield['lampiran']))
			@if(isset($listlampiran['Lampiran']))
			<tr>
				<td width="25%">Lampiran</td>
				<td colspan="2">
					@foreach($listlampiran['Lampiran'] as $key => $value)
						<div class="btn-group">
							<button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#lampiran_{{$key}}" aria-expanded="false" aria-controls="lampiran_{{$key}}">
								<i class="bi bi-book"></i>
								Baca
							</button>
							<a id="link-lampiran" href="{{asset('data_file/'.$id.'/'.$value)}}" target="_blank" class="btn btn-sm btn-outline-success">
								<i class="bi bi-download"></i>
								Unduh
							</a>
							<button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalFlipbook" data-bs-source="{{$value}}">
								<i class="bi bi-arrow-up-right-square-fill"></i>
								Popup
							</button>
						</div>
						<div class="collapse show mt-2" id="lampiran_{{$key}}">
						  <iframe src="{{route('flipbook', ['id' => $id])}}" class="w-100 " style="height: 100vh"></iframe>
						</div>
					@endforeach
				</td>
			</tr>
			@endif
			@if(isset($listlampiran['Abstrak']))
			<tr>
				<td>Abstrak</td>
				<td colspan="2">
					@foreach($listlampiran['Abstrak'] as $key => $value)
						<div class="btn-group">
							<button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#abstrak_{{$key}}" aria-expanded="false" aria-controls="abstrak_{{$key}}">
								<i class="bi bi-book"></i>
								Baca
							</button>
							<a id="link-lampiran" href="{{asset('data_file/'.$id.'/'.$value)}}" target="_blank" class="btn btn-sm btn-outline-success">
								<i class="bi bi-download"></i>
								Unduh
							</a>
							<button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalFlipbook" data-bs-source="{{$value}}">
								<i class="bi bi-arrow-up-right-square-fill"></i>
								Popup
							</button>
						</div>
						<div class="collapse mt-2" id="abstrak_{{$key}}">
						  <iframe src="{{route('flipbook', ['id' => $id])}}" class="w-100 " style="height: 100vh"></iframe>
						</div>
					@endforeach
				</td>
			</tr>
			@endif
			@if(isset($listlampiran['Peraturan Terkait']))
			<tr>
				<td>Peraturan Terkait</td>
				<td colspan="2">
					@foreach($listlampiran['Peraturan Terkait'] as $key => $value)
						<div class="d-flex align-items-center justify-content-between">
							<label>{{$value}}</label>
							<div class="btn-group">
								<button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#peraturan_terkait_{{$key}}" aria-expanded="false" aria-controls="peraturan_terkait_{{$key}}">
									<i class="bi bi-book"></i>
									Baca
								</button>
								<a id="link-lampiran" href="{{asset('data_file/'.$id.'/'.$value)}}" target="_blank" class="btn btn-sm btn-outline-success">
									<i class="bi bi-download"></i>
									Unduh
								</a>
								<button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalFlipbook" data-bs-source="{{$value}}">
									<i class="bi bi-arrow-up-right-square-fill"></i>
									Popup
								</button>
							</div>
							<div class="collapse mt-2" id="peraturan_terkait_{{$key}}">
							  <iframe src="{{route('flipbook', ['id' => $id])}}" class="w-100 " style="height: 100vh"></iframe>
							</div>
						</div>
					@endforeach
				</td>
			</tr>
			@endif
			@if(isset($listlampiran['Dokumen Terkait']))
			<tr>
				<td>Dokumen Terkait</td>
				<td colspan="2">
					@foreach($listlampiran['Dokumen Terkait'] as $key => $value)
						<div class="btn-group">
							<button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#dokumen_terkait_{{$key}}" aria-expanded="false" aria-controls="dokumen_terkait_{{$key}}">
								<i class="bi bi-book"></i>
								Baca
							</button>
							<a id="link-lampiran" href="{{asset('data_file/'.$id.'/'.$value)}}" target="_blank" class="btn btn-sm btn-outline-success">
								<i class="bi bi-download"></i>
								Unduh
							</a>
							<button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalFlipbook" data-bs-source="{{$value}}">
								<i class="bi bi-arrow-up-right-square-fill"></i>
								Popup
							</button>
						</div>
						<div class="collapse mt-2" id="dokumen_terkait_{{$key}}">
						  <iframe src="{{route('flipbook', ['id' => $id])}}" class="w-100 " style="height: 100vh"></iframe>
						</div>
					@endforeach
				</td>
			</tr>
			@endif
			@if(isset($listlampiran['Hasil Uji Materi']))
			<tr>
				<td>Hasil Uji Materi</td>
				<td colspan="2">
					@foreach($listlampiran['Hasil Uji Materi'] as $key => $value)
						<div class="btn-group">
							<button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#hasil_uji_materi_{{$key}}" aria-expanded="false" aria-controls="hasil_uji_materi_{{$key}}">
								<i class="bi bi-book"></i>
								Baca
							</button>
							<a id="link-lampiran" href="{{asset('data_file/'.$id.'/'.$value)}}" target="_blank" class="btn btn-sm btn-outline-success">
								<i class="bi bi-download"></i>
								Unduh
							</a>
							<button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalFlipbook" data-bs-source="{{$value}}">
								<i class="bi bi-arrow-up-right-square-fill"></i>
								Popup
							</button>
						</div>
						<div class="collapse mt-2" id="hasil_uji_materi_{{$key}}">
						  <iframe src="{{route('flipbook', ['id' => $id])}}" class="w-100 " style="height: 100vh"></iframe>
						</div>
					@endforeach
					
				</td>
			</tr>
			@endif
		@endif
	</table>
	@endif
</div>