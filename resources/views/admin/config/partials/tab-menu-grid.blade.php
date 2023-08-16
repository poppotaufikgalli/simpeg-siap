<div>
	@php($page="menuGrid")
	<div class="d-flex justify-content-end mb-3">
		<a href="{{route('config.create',['page' => $page, 'ref' => 0])}}" class="btn btn-sm btn-primary">Tambah Menu Grid</a>
	</div>
	<div class="table-responsive">
		<table class="table table-sm small table-bordered" id="tbListData" width="100%" cellspacing="0">
			<thead class="table-dark">
				<tr>
					<th width="5%">No</th>
					<th>Judul Menu</th>
					<th width="5%">Icon</th>
					<th>Jenis</th>
					<th width="30%">Target</th>
					<th width="5%">Tambah Sub</th>
					<th width="10%">Aksi</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>No</th>
					<th>Judul Menu</th>
					<th>Icon</th>
					<th>Jenis</th>
					<th>Target</th>
					<th>Tambah Sub</th>
					<th>Aksi</th>
				</tr>
			</tfoot>
			<tbody>
				@if(isset($menuGrid))
					@php($lvl = 0)
					@foreach($menuGrid['main'] as $key => $value)
						<tr>
							<td class="text-center">{{$key +1}}</td>
							<td class="ms-{{$lvl}}">
								{{ $value->judul }}<br>
								<span class="text-muted fst-italic">{{$value->keterangan}}</span>
							</td>
							<td class="text-center">
								@if(isset($value->guid))
			                        <img class="img-thumbnail glightbox" src="{{asset('images/menuIcon/'.$value->guid)}}" />
			                    @endif
							</td>
							<td class="text-center">
								{{ $value->jns == 1 ? 'Posting' : ($value->jns == 0 ? '#' : ($value->jns == 3 ? 'Pencarian Produk' : ($value->jns == 4 ? 'Pencarian Tipe' :  ($value->jns == 5 ? 'List Halaman' : 'Link') )  )) }}
							</td>
							<td class="text-center">
								{{ $value->jns == 1 ? "[H]".$value->halaman_target->judul : ($value->jns == 3 ? "[C]".$value->jns_hukum_target->nama :  ($value->jns == 4 ? "[CH]".$value->tipe_dok_hukum->nama :  ($value->jns == 5 ? "[CH]". $kontens[$value->target] : $value->target) ) ) }}
							</td>
							<td class="text-center">
								<a href="{{route('config.create',['page' => $page, 'ref' => $value->id])}}" class="btn btn-xs btn-success">
									<i class="bi bi-arrow-down-square-fill"></i>
								</a>
							</td>
							<td>
								<div class="d-flex gap-1">
									<a href="{{route('config.show', ['id' => $value->id, 'page' => $page])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
									<a href="{{route('config.edit', ['id' => $value->id, 'page' => $page])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
									<button class="btn btn-xs btn-danger" 
										data-bs-toggle="modal" 
										data-bs-target="#hapusModal" 
										data-bs-target1={{$page}}
										data-bs-id_tipe_dok_hukum="destroy"
										data-bs-router="config"
										data-bs-id="{{$value->id}}" 
										data-bs-recipient="{{$value->judul}}"
									>
										<i class="bi bi-trash"></i>
									</button>
								</div>
							</td>                    
						</tr>
						@php($id_ref = $value->id)
						@include("admin.config.partials.submenu-table", ['sub' => $menuGrid['sub'], 'id_ref' => $id_ref])
					@endforeach
				@endif
			</tbody>
		</table>
	</div>
</div>