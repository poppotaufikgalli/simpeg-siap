<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="10%">Id</th>
                        <th width="10%">Nama</th>
                        <th width="35%">Jabatan ASN</th>
                        <th>Jenis Jabatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>
                            <input type="search" class="form-control" id="_id" wire:model="_id" placeholder="Cari ID Eselon">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="nama" wire:model="nama" placeholder="Cari Nama Eselon">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="jabatan_asn" wire:model="jabatan_asn" placeholder="Cari Jabatan ASN">
                        </th>
                        <th>
                            <select class="form-select" id="id_jenis_jabatan" wire:model="id_jenis_jabatan">
                                <option value="" selected>Semua</option>
                                @if($master_jenis_jabatan)
                                    @foreach($master_jenis_jabatan as $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select> 
                        </th>
                        <th>
                            <select class="form-select" id="status" wire:model="status">
                                <option value="" selected>Semua</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select> 
                        </th>
                        <th>Jumlah Data : {{$master_eselon->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_eselon)
                      @foreach($master_eselon as $key => $value)
                            <tr>
                                <td align="center">{{ $value->id }}</td>
                                <td align="center">{{ $value->nama }}</td>
                                <td>{{ $value->jabatan_asn }}</td>
                                <td>{{ $value->jnsjab->nama }}</td>
                                <td>{{ $value->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('eselon.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('eselon.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Eselon" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="eselon"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_eselon->links() }}
            </div>
        </div>
    </div>
</div>
