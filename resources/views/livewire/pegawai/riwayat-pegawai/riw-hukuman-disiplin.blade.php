<div>
    <div class="card card-body mb-2 {{$subPage == 'list' ? 'd-block' : 'd-none'}}" id="list">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-sm btn-primary" id="btnTambah" wire:click="$emitSelf('tambah')">Tambah</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="20%">Jenis Hukuman</th>
                        <th width="40%">Uraian</th>
                        <th>No SK</th>
                        <th>TMT</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_riwayat_hukdis)
                        @foreach($master_riwayat_hukdis as $key => $value)
                            <tr>
                                <td>{{ $value->njns->nama }}</td>
                                <td>{{ $value->deshukum }}</td>
                                <td>{{ $value->nsk }}</td>
                                <td align="center">{{ $value->tmt->format('d-m-Y') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                         <button type="button" class="btn btn-xs btn-success" 
                                            wire:click="callModal('{{$value->njns->nama}}', '{{$value->jhukum}}', '{{$value->tmt}}'), '{{$value->filename}}'"
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
                    <label>Formulir Hukuman Disiplin</label>
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
                            <label for="jhukum" class="col-sm-2 col-form-label text-truncate">Jenis Hukuman</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="jhukum" wire:model="dataset.jhukum" required>
                                    <option value="">Pilih Jenis Hukuman</option>
                                    @if($master_jenis_hukdis)
                                        @foreach($master_jenis_hukdis as $key => $value)
                                            <option value="{{$value->id}}">{{$value->nama}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="deshukum" class="col-sm-2 col-form-label text-truncate">Uraian</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="deshukum" wire:model="dataset.deshukum" required></textarea>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="kpej" class="col-sm-2 col-form-label text-truncate">Pj. Penetap</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="kpej" wire:model="dataset.kpej" required>
                                    <option value="">Pilih Pejabat Penetap</option>
                                    @if($master_pejabat)
                                        @foreach($master_pejabat as $key => $value)
                                            <option value="{{$value->kpej}}">{{$value->npej}}</option>
                                        @endforeach
                                    @endif
                                </select>
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
                        </div>
                        <div class="mb-2 row">
                            <label for="tmt" class="col-sm-2 col-form-label text-truncate">TMT</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tmt" wire:model="dataset.tmt" required>
                            </div>
                            <label for="selesai" class="col-sm-2 col-form-label text-truncate">Selesai</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="selesai" wire:model="dataset.selesai">
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