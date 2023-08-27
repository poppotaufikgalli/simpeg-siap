<div>
    <div class="card card-body mb-2 {{$subPage == 'list' ? 'd-block' : 'd-none'}}" id="list">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-sm btn-primary" id="btnTambah" wire:click="$emitSelf('tambah')">Tambah</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="10%">Tahun</th>
                        <th width="20%">Pejabat Penetap</th>
                        <th width="20%">Tingkat Pendidikan/Jurusan</th>
                        <th width="15%">Gelar</th>
                        <th width="15%">No SK</th>
                        <th width="15%">Tgl SK</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_riwayat_tumlar)
                      @foreach($master_riwayat_tumlar as $key => $value)
                            <tr>
                                <td align="center">{{ $value->tsk->format('Y') }}</td>
                                <td>{{ $value->npej->npej }}</td>
                                <td>{{ $value->ntpu->nama }} - {{$value->njur->nama}}</td>
                                <td align="center">{{ $value->gldepan." " }}{{ " ".$value->glblk }}</td>
                                <td>{{ $value->nsk }}</td>
                                <td align="center">{{ $value->tsk->format('d-m-Y') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
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
                    <label>Formulir Pencantuman Gelar</label>
                    <button type="button" wire:click="$emitSelf('tutup')" class="btn btn-sm btn-primary">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </div>
            </div>
            @if($subPage == 'formulir')
                <div class="card-body">
                    <form wire:submit.prevent="{{$next}}">
                        @csrf
                        <div class="card card-body">
                            <div class="mb-2 row">
                                <div class="col-sm-10 offset-sm-2">
                                    <input type="hidden" wire:model="sid" class="form-control">
                                </div>
                            </div>
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
                                <label for="ptetap" class="col-sm-2 col-form-label">Pj. Penetap</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="ptetap" wire:model="dataset.ptetap" required>
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
                                    <input type="date" class="form-control" id="tsk" wire:model="dataset.tsk" required>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <label for="ktpu" class="col-sm-2 col-form-label text-truncate">Tingkat Pendidikan</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="ktpu" wire:model="dataset.ktpu" wire:change="changeJur($event.target.value)" required>
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
                                    <select class="form-control" id="kjur" wire:model="dataset.kjur" required>
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
                                <label for="gldepan" class="col-sm-2 col-form-label text-truncate">Pencantuman Gelar</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="gldepan" wire:model="dataset.gldepan" placeholder="Gelar Depan">
                                        <input type="text" class="form-control" id="glblk" wire:model="dataset.glblk" placeholder="Gelar Belakang">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button class="btn btn-sm btn-primary">Simpan {{$next}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>