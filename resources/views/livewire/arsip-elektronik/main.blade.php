<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="10%">NIP</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <thead class="table-light">
                    <tr>
                        <th>
                            <input type="search" class="form-control" id="nip" wire:model="nip" placeholder="Cari dengan NIP">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="namapeg" wire:model="namapeg" placeholder="Cari dengan Nama">
                        </th>
                        <th>Jumlah Data : {{$master_pegawai->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_pegawai)
                      @foreach($master_pegawai as $key => $value)
                            <tr>
                                <td align="center">{{ $value->nip }}</td>
                                <td>{{ $value->namapeg }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('arsip_elektronik.show', ['id' => $value->nip])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('arsip_elektronik.edit', ['id' => $value->nip])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Jenis Profesi" data-bs-id="{{$value->nip}}" data-bs-recipient="{{$value->namapeg}}" data-bs-router="arsip_elektronik"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_pegawai->links() }}
            </div>
        </div>
    </div>
</div>