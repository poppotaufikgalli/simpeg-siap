<div>
    <div class="card card-body mb-2 {{$subPage == 'list' ? 'd-block' : 'd-none'}}" id="list">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-sm btn-primary" id="btnTambah" wire:click="$emitSelf('tambah')">Tambah</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th>Tingkat Pendidikan</th>
                        <th>Jurusan</th>
                        <th>Nama Sekolah</th>
                        <th>Tempat</th>
                        <th>Akhir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_riwayat_pendum)
                        @foreach($master_riwayat_pendum as $key => $value)
                            <tr>
                                <td>{{ $value->ntpu->group_tk_pend_nm }}</td>
                                <td>{{ $value->njur->nama }}</td>
                                <td>{{ $value->nsek }}</td>
                                <td>{{ $value->tempat }}</td>
                                <td>{{ $value->akhir == 1 ? 'Ya' : '' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn btn-xs btn-success" 
                                            wire:click="callModal('pendum', '{{$value->ktpu}}', '{{$value->kjur}}')"
                                        >
                                            <i class="bi bi-cloud-upload"></i> 
                                        </button>
                                        <button wire:click="$emitSelf('edit', {{$value}})" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></button>
                                        <button wire:click="$emitSelf('delete', {{$value}})" class="btn btn-xs btn-danger"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div id="formulir" class="{{$subPage == 'formulir' ? 'd-block' : 'd-none'}}">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <label>Formulir Pendidikan Umum</label>
                    <button type="button" wire:click="$emitSelf('tutup')" class="btn btn-sm btn-primary">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="card card-body">
                    <form wire:submit.prevent="{{$next}}">
                        @csrf
                        <div class="mb-2 row">
                            <label for="nip" class="col-sm-2 col-form-label">NIP/NRP</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="nip" wire:model="dataset.nip" disabled>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" wire:model="dataset.nama" disabled>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="ktpu" class="col-sm-2 col-form-label text-truncate">Tingkat Pendidikan</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="ktpu" wire:model="dataset.ktpu" wire:change="changeJur($event.target.value)" required>
                                    <option value="">Pilih Tingkat Pendidikan</option>
                                    @if($master_tingkat_pendidikan)
                                        @foreach($master_tingkat_pendidikan as $key => $value)
                                            <option value="{{$value->id}}">{{$value->nama}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="kjur" class="col-sm-2 col-form-label text-truncate">Jurusan Pendidikan</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="kjur" wire:model="dataset.kjur" required>
                                    <option value="">Pilih Jurusan Pendidikan</option>
                                    @if($master_pendidikan)
                                        @foreach($master_pendidikan as $key => $value)
                                            <option value="{{$value->id}}">{{$value->nama}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="nsek" class="col-sm-2 col-form-label text-truncate">Nama Sekolah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nsek" wire:model="dataset.nsek">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="tempat" class="col-sm-2 col-form-label text-truncate">Tempat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tempat" wire:model="dataset.tempat">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="negara" class="col-sm-2 col-form-label text-truncate">Negara</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="negara" wire:model="dataset.negara">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="nkepsek" class="col-sm-2 col-form-label text-truncate">Nama Kepsek / Direktur / Rektor</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nkepsek" wire:model="dataset.nkepsek">
                            </div>
                        </div>
                        <hr>
                        <div class="mb-2 row">
                            <label for="nsttb" class="col-sm-2 col-form-label text-truncate">No STTB</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nsttb" wire:model="dataset.nsttb">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="tsttb" class="col-sm-2 col-form-label text-truncate">Tgl STTB</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tsttb" wire:model="dataset.tsttb">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="akhir" class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
                            <div class="col-sm-4 d-flex align-items-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="akhir" wire:model="dataset.akhir" wire:change="changeStts($event.target.checked)">
                                    <label class="form-check-label" for="akhir" id="lblStts">{{$lblStts}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-sm-10 offset-sm-2">
                                <button class="btn btn-sm btn-primary">Simpan {{$next}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>