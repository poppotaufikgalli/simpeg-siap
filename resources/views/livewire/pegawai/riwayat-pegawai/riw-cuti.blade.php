<div>
    <div class="card card-body mb-2 {{$subPage == 'list' ? 'd-block' : 'd-none'}}" id="list">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-sm btn-primary" id="btnTambah" wire:click="$emitSelf('tambah')">Tambah</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th>Jenis</th>
                        <th>No SK</th>
                        <th>Tgl SK</th>
                        <th>Mulai</th>
                        <th>Jml Hari</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_riwayat_cuti)
                        @foreach($master_riwayat_cuti as $key => $value)
                            <tr>
                                <td>{{ $value->njns->nama }}</td>
                                <td>{{ $value->nsk }}</td>
                                <td align="center">{{ $value->tsk->format('d-m-Y') }}</td>
                                <td align="center">{{ $value->tmulai->format('d-m-Y') }}</td>
                                <td align="center">{{ $value->jmlhari }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                         <button type="button" class="btn btn-xs btn-success" 
                                            wire:click="callModal('{{$value->njns->nama}}', '{{$value->tmulai}}', '{{$value->nsk}}'), '{{$value->filename}}'"
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
                            <label for="jcuti" class="col-sm-2 col-form-label text-truncate">Jenis Cuti</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="jcuti" wire:model="dataset.jcuti" required>
                                    <option value="">Pilih Jenis Cuti</option>
                                    @if($master_jenis_cuti)
                                        @foreach($master_jenis_cuti as $key => $value)
                                            <option value="{{$value->id}}">{{$value->nama}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="ptetap" class="col-sm-2 col-form-label text-truncate">Pj. Penetap</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="ptetap" wire:model="dataset.ptetap" required>
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
                        <hr>
                        <div class="mb-2 row">
                            <label for="tmulai" class="col-sm-2 col-form-label text-truncate">Tanggal Mulai Cuti</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tmulai" wire:model="dataset.tmulai" required>
                            </div>
                            <label for="takhir" class="col-sm-2 col-form-label text-truncate">Selesai Cuti</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="takhir" wire:model="dataset.takhir" required>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="thn" class="col-sm-2 col-form-label text-truncate">Tahun Cuti</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="thn" wire:model="dataset.thn" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="4" required>
                            </div>
                            <label for="jmlhari" class="col-sm-2 col-form-label text-truncate">Jumlah Hari</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="jmlhari" wire:model="dataset.jmlhari" required>
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