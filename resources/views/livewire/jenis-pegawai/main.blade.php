<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="15%">ID Jenis Pegawai</th>
                        <th width="30%">Nama Jenis Pegawai</th>
                        <th width="15%">Status</th>
                        <th>Referensi SIMPEG</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>
                            <input type="search" class="form-control" id="_id" wire:model="_id" placeholder="Cari dengan : ID">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="nama" wire:model="nama" placeholder="Nama Jenis Pegawai">
                        </th>
                        <th>
                            <select class="form-select" id="status" wire:model="status">
                                <option value="" selected>Semua Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </th>
                        <th>
                            <input type="search" class="form-control" id="ref_simpeg" wire:model="ref_simpeg" placeholder="Referensi SIMPEG">
                        </th>
                        <th>Jumlah Data : {{$master_jenis_pegawai->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_jenis_pegawai)
                      @foreach($master_jenis_pegawai as $key => $value)
                            <tr>
                                <td align="center">{{ $value->id }}</td>
                                <td>{{ $value->nama }}</td>
                                <td>{{ $value->status == 1 ? "Aktif" : "Tidak Aktif" }}</td>
                                <td>{{ $value->ref_simpeg }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('jenis_pegawai.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('jenis_pegawai.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Jenis Personel" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="jenis_pegawai"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_jenis_pegawai->links() }}
            </div>
        </div>
    </div>
</div>
