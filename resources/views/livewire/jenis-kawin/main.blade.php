<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="10%">Kode</th>
                        <th>Nama Agama</th>
                        <th>Referensi SIMPEG</th>
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
                            <input type="search" class="form-control" id="ref_simpeg" wire:model="ref_simpeg" placeholder="Cari dengan Ref SIMPEG">
                        </th>
                        <th>Jumlah Data : {{$master_jenis_kawin->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_jenis_kawin)
                      @foreach($master_jenis_kawin as $key => $value)
                            <tr>
                                <td align="center">{{ $value->id }}</td>
                                <td>{{ $value->nama }}</td>
                                <td>{{ $value->ref_simpeg }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('jenis_kawin.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('jenis_kawin.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Jenis Kawin" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="jenis_kawin"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_jenis_kawin->links() }}
            </div>
        </div>
    </div>
</div>