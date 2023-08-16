<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="10%">ID</th>
                        <th width="25%">Nama Jabatan</th>
                        <th>BUP</th>
                        <th width="20%">Kelompok Jabatan</th>
                        <th>Jenjang</th>
                        <th>Status</th>
                        <th>Ref SIMPEG</th>
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
                            <input type="search" class="form-control" id="bup_usia" wire:model="bup_usia" placeholder="Cari BUP">
                        </th>
                        <th>
                            <select class="form-select" id="kel_jabatan_id" wire:model="kel_jabatan_id">
                                <option value="">Semua</option>
                                @if($master_kelompok_jabatan)
                                    @foreach($master_kelompok_jabatan as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </th>
                        <th>
                            <select class="form-select" id="jenjang" wire:model="jenjang">
                                <option value="">Semua</option>
                                @if($master_jenjang_jabfung)
                                    @foreach($master_jenjang_jabfung as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </th>
                        <th>
                            <select class="form-select" id="status" wire:model="status">
                                <option value="">Semua</option>
                                <option value="N">Berlaku</option>
                                <option value="O">Tidak Berlaku</option>
                            </select>
                        </th>
                        <th>
                            <input type="search" class="form-control" id="ref_simpeg" wire:model="ref_simpeg" placeholder="Cari Ref SIMPEG">
                        </th>
                        <th>Jumlah Data : {{$master_jft->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_jft)
                      @foreach($master_jft as $key => $value)
                            <tr>
                                <td align="center" class="text-truncate">{{ $value->id }}</td>
                                <td>{{ $value->nama }}</td>
                                <td align="right">{{ $value->bup_usia }}</td>
                                <td>{{ $value->nkeljab->nama ?? '' }}</td>
                                <td>{{ $value->njenjang->nama ?? '' }}</td>
                                <td align="center">{{ $value->status == 'N' ? 'Berlaku' : "Tidak Berlaku"}}</td>
                                <td align="center">{{ $value->ref_simpeg }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('master_jft.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('master_jft.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Master JFT" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="master_jft"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_jft->links() }}
            </div>
        </div>
    </div>
</div>