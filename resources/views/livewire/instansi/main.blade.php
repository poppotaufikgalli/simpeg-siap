<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="10%">ID</th>
                        <th width="35%">Nama Instansi</th>
                        <th>Pusat/Daerah?</th>
                        <th>Jenis Instansi</th>
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
                            <select class="form-select" id="jenis" wire:model="jenis">
                                <option value="">Semua</option>
                                <option value="P">Pusat</option>
                                <option value="D">Daerah</option>
                            </select>
                        </th>
                        <th>
                            <select class="form-select" id="jenis_instansi_id" wire:model="jenis_instansi_id">
                                <option value="">Semua</option>
                                @if($master_jenis_instansi)
                                    @foreach($master_jenis_instansi as $value)
                                        <option value="{{$value->id}}">{{$value->id}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </th>
                        <th>Jumlah Data : {{$master_instansi->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_instansi)
                      @foreach($master_instansi as $key => $value)
                            <tr>
                                <td align="center">{{ $value->id }}</td>
                                <td>{{ $value->nama }}</td>
                                <td>{{ $value->jenis == 'P' ? 'Pusat' : 'Daerah' }}</td>
                                <td>{{ $value->jenis_instansi_id }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('instansi.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('instansi.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Jenis Profesi" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="instansi"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_instansi->links() }}
            </div>
        </div>
    </div>
</div>