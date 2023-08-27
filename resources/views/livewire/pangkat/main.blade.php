<div>
    <div class="card-body">
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Jenis Pangkat</label>
            <div class="col-sm-3">
                <select class="form-select" id="id_jenis_personel" wire:model="id_jenis_personel">
                    <option value="">Pilih Jenis Pangkat</option>
                    <option value="1">PNS</option>
                    <option value="2">Militer</option>
                </select>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="10%">Id Pangkat</th>
                        <th width="15%">Nama Pangkat</th>
                        <th>Golongan Ruang</th>
                        <th width="10%">Ref SIMPEG</th>
                        <th width="10%">Pajak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>
                            <input type="search" class="form-control" id="_id" wire:model="_id" placeholder="Cari ID Pangkat">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="nama" wire:model="nama" placeholder="Cari Nama">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="nama_pangkat" wire:model="nama_pangkat" placeholder="Cari Nama Pangkat">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="ref_simpeg" wire:model="ref_simpeg" placeholder="Cari Ref SIMPEG">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="pajak" wire:model="pajak" placeholder="Cari Besar Pajak">
                        </th>
                        <th>Jumlah Data : {{$master_pangkat->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_pangkat)
                      @foreach($master_pangkat as $key => $value)
                            <tr>
                                <td align="center">{{ $value->id }}</td>
                                <td>{{ $value->nama}}</td>
                                <td>{{ $value->nama_pangkat }}</td>
                                <td>{{ $value->ref_simpeg }}</td>
                                <td>{{ $value->pajak}}%</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('pangkat.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('pangkat.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Pangkat" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="pangkat"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_pangkat->links() }}
            </div>
        </div>
    </div>
</div>
