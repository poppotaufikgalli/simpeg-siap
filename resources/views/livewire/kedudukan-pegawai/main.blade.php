<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="15%">Kode Kedudukan Kepegawaian</th>
                        <th>Nama</th>
                        <th>Referensi SIMPEG</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>
                            <input type="search" class="form-control" id="_id" wire:model="_id" placeholder="Cari ID">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="nama" wire:model="nama" placeholder="Cari Nama Kedudukan Hukum Pegawai">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="ref_simpeg" wire:model="ref_simpeg" placeholder="Cari Nama Kedudukan Hukum Pegawai">
                        </th>
                        <th>Jumlah Data : {{$master_kedudukan_pegawai->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_kedudukan_pegawai)
                      @foreach($master_kedudukan_pegawai as $key => $value)
                            <tr>
                                <td align="center">{{ $value->id }}</td>
                                <td>{{ $value->nama }}</td>
                                <td>{{ $value->ref_simpeg }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('kedudukan_pegawai.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('kedudukan_pegawai.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Kedudukan Kepegawaian" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="kedudukan_pegawai"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_kedudukan_pegawai->links() }}
            </div>
        </div>
    </div>
</div>