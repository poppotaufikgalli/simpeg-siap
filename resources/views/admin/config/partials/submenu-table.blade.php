@if(isset($sub[$id_ref]))
	@php($lvl = $lvl +1)
	@php($items = $sub[$id_ref])
	@foreach($items as $item)
		<tr>
			<td class="text-center">&nbsp;</td>
			<td>
				<div class="d-flex justify-content-start">
					@for($l = 0; $l < $lvl; $l++)
						&nbsp;&nbsp;&nbsp;
					@endfor
					@for($l = 0; $l < $lvl; $l++)
						-
					@endfor
					&nbsp;
					<span>
						{{ $item->judul }}
						@if($item->keterangan != '')
							<br><span class="text-muted fst-italic">{{$item->keterangan}}</span>
						@endif
					</span>
				</div>
			</td>
			@if($page != 'menu')
			<td class="text-center">
				@if(isset($item->guid))
                    <img class="img-thumbnail glightbox" src="{{asset('images/menuIcon/'.$item->guid)}}" />
                @endif
			</td>
			@endif
			<td class="text-center">
				{{ $item->jns == 1 ? 'Posting' : ($item->jns == 0 ? '#' : ($item->jns == 3 ? 'Pencarian Produk' : ($item->jns == 4 ? 'Pencarian Tipe' :  ($item->jns == 5 ? 'List Konten' :  'Link'  )   )  )) }}
			</td>
			<td class="text-center">
				{{ $item->jns == 1 ? (isset($item->halaman_target->judul) ? "[H]".$item->halaman_target->judul : '-??-') : ($item->jns == 3 ? (isset($item->jns_hukum_target->nama) ? "[C]".$item->jns_hukum_target->nama : '-??-') :  ($item->jns == 4 ? "[CH]".$item->tipe_dok_hukum->nama :  ($item->jns == 5 ? $kontens[$item->target] : $item->target) ) ) }}
			</td>
			<td class="text-center">
				<a href="{{route('config.create',['page' => $page, 'ref' => $item->id])}}" class="btn btn-xs btn-success">
					<i class="bi bi-arrow-down-square-fill"></i>
				</a>
			</td>
			<td>
				<div class="d-flex gap-1">
					<a href="{{route('config.show', ['id' => $item->id, 'page' => $page])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
					<a href="{{route('config.edit', ['id' => $item->id, 'page' => $page])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
					<button class="btn btn-xs btn-danger" 
						data-bs-toggle="modal" 
						data-bs-target="#hapusModal" 
						data-bs-target1={{$page}}
						data-bs-id_tipe_dok_hukum="destroy"
						data-bs-router="config"
						data-bs-id="{{$item->id}}" 
						data-bs-recipient="{{$item->judul}}"
					>
						<i class="bi bi-trash"></i>
					</button>
				</div>
			</td>                    
		</tr>
		@php($id_ref = $item->id)
		@include("admin.config.partials.submenu-table", ['id_ref' => $id_ref])
	@endforeach
@endif