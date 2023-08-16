<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="15%">Kode Unit Kerja</th>
                        <th>Nama Unit Kerja</th>
                        <th width="15%">Utama</th>
                        <th>Eselon</th>
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
                            <input type="search" class="form-control" id="nama" wire:model="nama" placeholder="Cari Nama">
                        </th>
                        <th>
                            <select class="form-select" id="sfilter" wire:model="sfilter">
                                <option value="" selected>Semua</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </th>
                        <th>
                            <select class="form-select" id="id_eselon" wire:model="id_eselon">
                                <option value="" selected>Semua</option>
                                @if($master_eselon)
                                    @foreach($master_eselon as $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </th>
                        <th>
                            <select class="form-select" id="status" wire:model="status">
                                <option value="" selected>Semua Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </th>
                        <th>Jumlah Data : {{$master_opd->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_opd)
                      @foreach($master_opd as $key => $value)
                            <tr class="sfilter-{{$value->sfilter}}">
                                <td>{{ $value->id }} <br><span class="badge bg-info">{{$value->kunker}}</span></td>
                                <td>{{ $value->nama }}</td>
                                <td>{{ $value->sfilter == 1 ? 'Ya' : '-' }}</td>
                                <td align="center">{{ $value->neselon->nama ?? '' }}</td>
                                <td>{{ $value->status == 1 ? 'Aktif' : "Tidak Aktif" }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('unit_kerja.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('unit_kerja.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Unit Kerja" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="unit_kerja"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_opd->links() }}
            </div>
        </div>
    </div>
</div>
