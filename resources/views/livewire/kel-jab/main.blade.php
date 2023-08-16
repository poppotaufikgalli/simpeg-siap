<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="10%">ID</th>
                        <th width="25%">Nama Kelompok Jabatan</th>
                        <th>Jenis Jabatan</th>
                        <th>Rumpun</th>
                        <th>Instansi Pembina</th>
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
                            <select class="form-select" id="jenis_jabatan_id" wire:model="jenis_jabatan_id">
                                <option value="">Semua</option>
                                @if($master_jenis_jabatan_umum)
                                    @foreach($master_jenis_jabatan_umum as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </th>
                        <th>
                            <select class="form-select" id="rumpun_jabatan_id" wire:model="rumpun_jabatan_id">
                                <option value="">Semua</option>
                                @if($master_rumpun_jabfung)
                                    @foreach($master_rumpun_jabfung as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </th>
                        <th>
                             <select class="form-select" id="pembina_id" wire:model="pembina_id">
                                <option value="">Semua</option>
                                @if($master_instansi)
                                    @foreach($master_instansi as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </th>
                        <th>Jumlah Data : {{$master_kel_jab->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_kel_jab)
                      @foreach($master_kel_jab as $key => $value)
                            <tr>
                                <td align="center">{{ $value->id }}</td>
                                <td>{{ $value->nama }}</td>
                                <td align="center">{{ $value->njnsJabUmum->nama ?? '' }}</td>
                                <td align="center">{{ $value->nrumpun->nama ?? '' }}</td>
                                <td align="center">{{ $value->npembina->nama ?? '' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('kel_jab.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('kel_jab.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Master JFT" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="kel_jab"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_kel_jab->links() }}
            </div>
        </div>
    </div>
</div>