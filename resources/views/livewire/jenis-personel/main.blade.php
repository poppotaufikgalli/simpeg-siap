<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="15%">Kode Jenis Personel</th>
                        <th>Nama Jenis Personel</th>
                        <th width="15%">Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>
                            <input type="search" class="form-control" id="kjpeg" wire:model="id_jenis_personel" placeholder="Cari dengan : Kode">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="njpeg" wire:model="nama" placeholder="Jenis Personel">
                        </th>
                        <th>
                            <select class="form-select" id="stts" wire:model="stts">
                                <option value="-1" selected>Semua Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </th>
                        <th>Jumlah Data : {{ $master_jenis_personel->total() }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_jenis_personel)
                      @foreach($master_jenis_personel as $key => $value)
                            <tr>
                                <td align="center">{{ $value->id_jenis_personel }}</td>
                                <td>{{ $value->nama }}</td>
                                <td>{{ $value->stts == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('jenis_personel.show', ['id' => $value->id_jenis_personel])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('jenis_personel.edit', ['id' => $value->id_jenis_personel])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Jenis Personel" data-bs-id="{{$value->id_jenis_personel}}" data-bs-recipient="{{$value->nama}}" data-bs-router="jenis_personel"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_jenis_personel->links() }}
            </div>
        </div>
    </div>
</div>
