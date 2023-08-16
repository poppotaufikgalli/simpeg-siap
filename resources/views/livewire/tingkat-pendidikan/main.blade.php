<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="10%">ID</th>
                        <th>Nama Tingkat Pendidikan</th>
                        <th>Nama Group Tingkat Pendidikan</th>
                        <th>Maksimal Pangkat</th>
                        <th>Ref SIMPEG</th>
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
                            <input type="search" class="form-control" id="group_tk_pend_nm" wire:model="group_tk_pend_nm" placeholder="Cari dengan Group">
                        </th>
                        <th>
                            <select class="form-select" id="maxkgolru" wire:model="maxkgolru">
                                <option value="">Semua Pangkat</option>
                                @if($master_pangkat)
                                    @foreach($master_pangkat as $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </th>
                        <th>
                            <input type="search" class="form-control" id="ref_simpeg" wire:model="ref_simpeg" placeholder="Cari Ref SIMPEG">
                        </th>
                        <th>Jumlah Data : {{$master_tingkat_pendidikan->total()}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_tingkat_pendidikan)
                      @foreach($master_tingkat_pendidikan as $key => $value)
                            <tr>
                                <td align="center">{{ $value->id }}</td>
                                <td>{{ $value->nama }}</td>
                                <td>{{ $value->group_tk_pend_nm }}</td>
                                <td>{{ $value->ngolru->nama ?? '' }}</td>
                                <td>{{ $value->ref_simpeg }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{route('tingkat_pendidikan.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                        <a href="{{route('tingkat_pendidikan.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Referensi Tingkat Pendidikan" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}" data-bs-router="tingkat_pendidikan"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $master_tingkat_pendidikan->links() }}
            </div>
        </div>
    </div>
</div>