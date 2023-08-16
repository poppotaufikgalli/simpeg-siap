<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="10%">ID</th>
                        <th width="35%">Nama</th>
                        <th>Group Jenis</th>
                        <th>Indeks Nama Arsip</th>
                        <th>Riwayat?</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <thead class="table-light">
                    <tr>
                        <th>
                            <input type="search" class="form-control" id="_id" wire:model="_id" placeholder="Cari dengan Kode">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="nama" wire:model="nama" placeholder="Cari dengan Nama">
                        </th>
                        <th>
                            <select class="form-select" id="group_arsip_id" wire:model="group_arsip_id">
                                <option value="" selected>Semua</option>
                                @if($master_group_arsip)
                                    @foreach($master_group_arsip as $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </th>
                        <th>
                            <input type="search" class="form-control" id="jnsdok" wire:model="jnsdok" placeholder="Cari dengan Nama">
                        </th>
                        <th>
                            <select class="form-select" id="riw" wire:model="riw">
                                <option value="" selected>Semua Riwayat</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </th>
                        <th>Jumlah Data : {{$master_jenis_arsip->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_jenis_arsip)
                      @foreach($master_jenis_arsip as $key => $value)
                            <tr>
                                <td align="center">{{ $value->id }}</td>
                                <td>{{ $value->nama }}</td>
                                <td>{{ $value->ngrDok->nama ?? '' }}</td>
                                <td>{{ $value->jnsdok }}</td>
                                <td>{{ $value->riw == 1 ? 'Ya' : '-' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('jenis_arsip.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('jenis_arsip.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Jenis Arsip" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="jenis_arsip"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_jenis_arsip->links() }}
            </div>
        </div>
    </div>
</div>
