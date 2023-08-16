<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="10%">Kode</th>
                        <th width="30%">Nama Hukuman Disiplin</th>
                        <th width="30%">Tingkat Hukuman Disiplin</th>
                        <th>Referensi SIMPEG</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <thead class="table-light">
                    <tr>
                        <th>
                            <input type="search" class="form-control" id="_id" wire:model="_id" placeholder="Cari dengan ID">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="nama" wire:model="nama" placeholder="Cari dengan Nama">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="ref_simpeg" wire:model="ref_simpeg" placeholder="Cari dengan Referensi SIMPEG">
                        </th>
                        <th>
                            <select class="form-select" id="jenis_tingkat_hukuman_id" wire:model="jenis_tingkat_hukuman_id">
                                <option value="">Pilih Tingkat Hukuman</option>
                                <option value="R">Ringan</option>
                                <option value="S">Sedang</option>
                                <option value="B">Berat</option>
                            </select>
                        </th>
                        <th>Jumlah Data : {{$master_jenis_hukdis->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_jenis_hukdis)
                      @foreach($master_jenis_hukdis as $key => $value)
                            <tr>
                                <td align="center">{{ $value->id }}</td>
                                <td>{{ $value->nama }}</td>
                                <td align="center">{{ $value->ref_simpeg }}</td>
                                <td>{{ $value->jenis_tingkat_hukuman_id == 'R' ? 'Ringan' : ($value->jenis_tingkat_hukuman_id == 'S' ? 'Sedang' : ($value->jenis_tingkat_hukuman_id == 'B' ? 'Berat' : '')) }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('jenis_hukdis.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('jenis_hukdis.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Jenis Hukuman Disiplin" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="jenis_hukdis"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_jenis_hukdis->links() }}
            </div>
        </div>
    </div>
</div>