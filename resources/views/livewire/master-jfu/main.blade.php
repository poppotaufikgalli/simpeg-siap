<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="15%">Kode Jabatan</th>
                        <th width="50%">Nama Jabatan</th>
                        <th>Kode Cepat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>
                            <input type="search" class="form-control" id="_id" wire:model="_id" placeholder="Cari ID">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="nama" wire:model="nama" placeholder="Cari Nama Jenis Jabatan">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="cepat_kode" wire:model="cepat_kode" placeholder="Cari Kode Cepat">
                        </th>
                        <th>
                            <select class="form-select" id="status" wire:model="status">
                                <option value="" selected>Semua Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </th>
                        <th>Jumlah Data : {{$master_jfu->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_jfu)
                      @foreach($master_jfu as $key => $value)
                            <tr>
                                <td align="center">{{ $value->id }}</td>
                                <td>{{ $value->nama }}</td>
                                <td align="center">{{ $value->cepat_kode }}</td>
                                <td align="center">{{ $value->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('master_jfu.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('master_jfu.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Master JFU" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="master_jfu"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_jfu->links() }}
            </div>
        </div>
    </div>
</div>