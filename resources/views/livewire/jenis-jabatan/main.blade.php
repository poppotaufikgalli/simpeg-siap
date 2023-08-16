<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="10%">Id</th>
                        <th width="30%">Nama</th>
                        <th>Ref. SIMPEG</th>
                        <th>Ref. SIAP</th>
                        <th>Dengan Angka Kredit</th>
                        <th width="10%">Status</th>
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
                            <input type="search" class="form-control" id="ref_simpeg" wire:model="ref_simpeg" placeholder="Cari Ref SIMPEG">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="ref_siap" wire:model="ref_siap" placeholder="Cari Ref SIAP">
                        </th>
                        <th>
                            <select class="form-select" id="is_ak" wire:model="is_ak">
                                <option value="" selected>Semua</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select> 
                        </th>
                        <th>
                            <select class="form-select" id="status" wire:model="status">
                                <option value="" selected>Semua Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>        
                        </th>
                        <th>Jumlah Data : {{$master_jenis_jabatan->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_jenis_jabatan)
                      @foreach($master_jenis_jabatan as $key => $value)
                            <tr>
                                <td align="center">{{ $value->id }}</td>
                                <td>{{ $value->nama }}</td>
                                <td>{{ $value->ref_simpeg }}</td>
                                <td>{{ $value->ref_siap }}</td>
                                <td>{{ $value->is_ak == 1 ? 'Ya' : 'Tidak' }}</td>
                                <td>{{ $value->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('jenis_jabatan.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('jenis_jabatan.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Jenis Personel" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="jenis_jabatan"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_jenis_jabatan->links() }}
            </div>
        </div>
    </div>
</div>
