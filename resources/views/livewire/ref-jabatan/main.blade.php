<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="10%">ID</th>
                        <th>Nama Jabatan</th>
                        <th>BUP Usia</th>
                        <th>Kode Cepat</th>
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
                            <input type="search" class="form-control" id="bup_usia" wire:model="bup_usia" placeholder="Cari dengan BUP Usia">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="cepat_kode" wire:model="cepat_kode" placeholder="Cari dengan Kode Cepat">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="ref_simpeg" wire:model="ref_simpeg" placeholder="Cari dengan Referensi SIMPEG">
                        </th>
                        <th>Jumlah Data : {{$master_referensi_jabatan->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_referensi_jabatan)
                      @foreach($master_referensi_jabatan as $key => $value)
                            <tr>
                                <td align="center">{{ $value->id }}</td>
                                <td>{{ $value->nama }}</td>
                                <td>{{ $value->bup_usia }}</td>
                                <td>{{ $value->cepat_kode }}</td>
                                <td>{{ $value->ref_simpeg }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('ref_jabatan.show', ['id' => $value->id, 'jenis_jabatan_id' => $jenis_jabatan_id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('ref_jabatan.edit', ['id' => $value->id, 'jenis_jabatan_id' => $jenis_jabatan_id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Jenis Profesi" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="ref_jabatan"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_referensi_jabatan->links() }}
            </div>
        </div>
    </div>
</div>