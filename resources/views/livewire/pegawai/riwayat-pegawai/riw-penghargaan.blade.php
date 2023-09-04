<div>
    <div class="card card-body mb-2 {{$subPage == 'list' ? 'd-block' : 'd-none'}}" id="list">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-sm btn-primary" id="btnTambah" wire:click="$emitSelf('tambah')">Tambah</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="20%">Nama Penghargaan</th>
                        <th>Jenis</th>
                        <th>Asal Perolehan</th>
                        <th>No SK</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_riwayat_penghargaan)
                        @foreach($master_riwayat_penghargaan as $key => $value)
                            <tr>
                                <td>{{ $value->nbintang }}</td>
                                <td>{{ $value->njns->nama }}</td>
                                <td>{{ $value->aoleh }}</td>
                                <td>{{ $value->nsk }}</td>
                                <td align="center">{{ $value->thn }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn btn-xs btn-success" 
                                            wire:click="callModal('{{$value->nbintang}}', '{{$value->njns->nama}}', '{{$value->nsk}}'), '{{$value->filename}}'"
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
                    <label>Formulir Penghargaan</label>
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
                            <label for="id_jenis_penghargaan" class="col-sm-2 col-form-label text-truncate">Jenis Penghargaan</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="id_jenis_penghargaan" wire:model="dataset.id_jenis_penghargaan" required>
                                    <option value="">Pilih Jenis Penghargaan</option>
                                    @if($master_jenis_penghargaan)
                                        @foreach($master_jenis_penghargaan as $key => $value)
                                            <option value="{{$value->id}}">{{$value->nama}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="nbintang" class="col-sm-2 col-form-label text-truncate">Nama Penghargaan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nbintang" wire:model="dataset.nbintang" required>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="aoleh" class="col-sm-2 col-form-label text-truncate">Asal Perolehan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="aoleh" list="lsPej" wire:model="dataset.aoleh" autocomplete="off">
                                <datalist id="lsPej">
                                    @if($master_pejabat)
                                        @foreach($master_pejabat as $key => $value)
                                            <option value="{{$value->npej}}">
                                        @endforeach
                                    @endif
                                </datalist>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="nsk" class="col-sm-2 col-form-label text-truncate">No. SK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nsk" wire:model="dataset.nsk">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="tsk" class="col-sm-2 col-form-label text-truncate">Tgl. SK</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tsk" wire:model="dataset.tsk">
                            </div>
                            <label for="thn" class="col-sm-2 col-form-label text-truncate">Tahun Perolehan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="thn" wire:model="dataset.thn" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="4" required>
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