<div>
    <div class="card-body">
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">OPD</label>
            <div class="col-sm-10">
                <select class="form-select" id="id_opd" wire:model="id_opd">
                    <option value="" selected>Semua</option>
                    @foreach($master_opd as $key => $value)
                        <option value="{{$value->id}}">{{$value->id}} - {{$value->nama}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="15%">Id Jabatan</th>
                        <th width="30%">Nama Jabatan</th>
                        <th>Unit Kerja</th>
                        <th width="15%">Eselon</th>
                        <th width="10%">Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>
                            <input type="search" class="form-control" id="_id" wire:model="_id" placeholder="Cari Kode">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="nama" wire:model="nama" placeholder="Cari Nama Jenis Jabatan">
                        </th>
                        <th>&nbsp;</th>
                        <th>
                            <select class="form-select" id="id_eselon" wire:model="id_eselon">
                                <option value="" selected>Semua Eselon</option>
                                @if($master_eselon)
                                    @foreach($master_eselon as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </th>
                        
                        <th>
                            <select class="form-select" id="status_jabatan" wire:model="status_jabatan">
                                <option value="" selected>Semua Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>        
                        </th>
                        <th>Jumlah Data : {{$master_jabatan->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_jabatan)
                      @foreach($master_jabatan as $key => $value)
                            <tr>
                                <td align="center">{{ $value->id }}</td>
                                <td>{{ $value->nama }}</td>
                                <td>{{ $value->nopd->nama }}</td>
                                <td>{{ $value->neselon->nama ?? '--' }}</td>
                                <td>{{ $value->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('master_jabatan.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('master_jabatan.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Master Jabatan" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="master_jabatan"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_jabatan->links() }}
            </div>
        </div>
    </div>
</div>