<div id="detailprodukhukum">
	@if(isset($listfield))
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
							<a id="link-lampiran" href="{{asset('data_file/'.$id.'/'.$value->nama_file)}}" target="_blank" class="btn btn-sm btn-outline-success">
								<i class="bi bi-download"></i>
								Unduh
							</a>
						</div>
						<div class="collapse show mt-2" id="lampiran_{{$key}}">
						  <iframe src="{{route('flipbook', ['id' => $value->id])}}" class="w-100 " style="height: 100vh"></iframe>
						</div>
					@endforeach
				</td>
			</tr>
			@endif
		@endif
	</table>
	@endif
</div>