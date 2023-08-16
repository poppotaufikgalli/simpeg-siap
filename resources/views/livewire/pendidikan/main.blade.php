<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="15%">ID</th>
                        <th width="15%">Ref BKN</th>
                        <th width="25%">Nama Pendidikan</th>
                        <th width="15%">Tingkat Pendidikan</th>
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
                            <input type="search" class="form-control" id="ref_bkn" wire:model="ref_bkn" placeholder="Cari Referensi BKN">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="nama" wire:model="nama" placeholder="Cari Nama Pendidikan">
                        </th>
                        <th>
                            <select class="form-select" id="tk_pendidikan_id" wire:model="tk_pendidikan_id">
                                <option value="" selected>Semua</option>
                                @if($master_tingkat_pendidikan)
                                    @foreach($master_tingkat_pendidikan as $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select> 
                        </th>
                        <th>
                            <select class="form-select" id="status" wire:model="status">
                                <option value="">Semua Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">-</option>
                            </select>
                        </th>
                        <th>Jumlah Data : {{$master_pendidikan->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_pendidikan)
                      @foreach($master_pendidikan as $key => $value)
                            <tr>
                                <td align="center" class="text-truncate">{{ $value->id }}</td>
                                <td class="text-truncate">{{ $value->ref_bkn }}</td>
                                <td>{{ $value->nama }}</td>
                                <td>{{ $value->tk_pendidikan_id }} - {{ $value->ntpu->nama ?? '' }}</td>
                                <td>{{ $value->status == 1 ? 'Aktif' : '-' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('pendidikan.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('pendidikan.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Data Jurusan Pendidikan" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="pendidikan"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_pendidikan->links() }}
            </div>
        </div>
    </div>
</div>
