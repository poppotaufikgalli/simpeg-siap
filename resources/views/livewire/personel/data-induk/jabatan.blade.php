<div>
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
                <label for="nskjabat" class="col-sm-2 col-form-label text-truncate">No. SK Jabatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nskjabat" wire:model="dataset.nskjabat" required>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="tskjabat" class="col-sm-2 col-form-label">Tgl. SK</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tskjabat" wire:model="dataset.tskjabat" required>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="id_opd" class="col-sm-2 col-form-label text-truncate">Satker</label>
                <div class="col-sm-10">
                    <select class="form-control" id="id_opd" wire:model="dataset.id_opd" wire:change="searchJabatan()" required>
                        <option value="">Pilih OPD</option> 
                        @if($master_opd)
                            @foreach($master_opd as $key => $value)
                                <option value="{{$value->id}}">{{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="jnsjab" class="col-sm-2 col-form-label text-truncate">Jenis Jabatan</label>
                <div class="col-sm-4">
                    <select class="form-control" id="jnsjab" wire:model="dataset.jnsjab" wire:change="changeJnsJab($event.target.value)" required>
                        <option value="">Pilih Jenis Jabatan</option>
                        @if($master_jenis_jabatan)
                            @foreach($master_jenis_jabatan as $key => $value)
                                <option value="{{$value->id}}">{{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <label for="keselon" class="col-sm-2 col-form-label">Eselon</label>
                <div class="col-sm-4">
                    <select class="form-control" id="keselon" wire:model="dataset.keselon" wire:change="searchJabatan()" required>
                        <option value="">Pilih Eselon</option> 
                        @if($master_eselon)
                            @foreach($master_eselon as $key => $value)
                                <option value="{{$value->id}}">{{$value->nama}}</option>
                            @endforeach
                        @else
                            <option value="99">--</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-2 row d-none">
                <label for="kjab" class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-10">
                    <select class="form-control" id="kjab" wire:model="dataset.kjab" wire:change="checkJabatan($event.target.value)">
                        <option value="">Pilih Jabatan</option> 
                        @if($master_jabatan)
                            @foreach($master_jabatan as $key => $value)
                                <option value="{{$value->id}}">{{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="njab" class="col-sm-2 col-form-label">Nama Jabatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="njab" list="listJab" wire:model="dataset.njab" required>
                    <datalist id="listJab">
                        @if($master_jabatan)
                            @foreach($master_jabatan as $key => $value)
                                <option value="{{$value->nama}}" />
                            @endforeach
                        @endif
                    </datalist>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="tmtjab" class="col-sm-2 col-form-label">TMT Jabatan</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tmtjab" wire:model="dataset.tmtjab">
                </div>
            </div>
            <div class="mb-2 row gy-2 d-none">
                <label for="nlantik" class="col-sm-2 col-form-label text-truncate">No. SK Pelantikan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nlantik" wire:model="dataset.nlantik">
                </div>
                <label for="tlantik" class="col-sm-2 col-form-label">Tgl. Pelantikan</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tlantik" wire:model="dataset.tlantik">
                </div>
            </div>
            @if($akhir != 1)
                <div class="mb-2 row">
                    <label for="akhir" class="col-sm-2 col-form-label">Jabatan Akhir</label>
                    <div class="col-sm-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="akhir" wire:model="dataset.akhir" wire:change="changeStts($event.target.checked)">
                            <label class="form-check-label" for="akhir" id="lblAkhir">{{$lblAkhir}}</label>
                        </div>
                    </div>
                </div>
            @endif
            <div class="mb-2 row">
                <div class="col-sm-10 offset-sm-2">
                    <button class="btn btn-sm btn-primary">Simpan {{$next}}</button>
                </div>
            </div>
        </div>
    </form>
    @if($master_jenis_arsip)
        <div class="card card-body mt-2">
            @foreach($master_jenis_arsip as $value)
                <div class="d-flex justify-content-start align-items-center gap-2">
                    <button type="button" class="btn btn-block btn-primary" 
                        wire:click="$emitTo('modal-upload-arsip', 'openModal','{{route('arsip_elektronik.store', ['page' => $value->nama])}}', '{{$value}}', true, true, 'jabatan-terakhir')"
                    >
                        SK Jabatan <i class="bi bi-cloud-upload ms-2"></i> 
                    </button>
                </div>
            @endforeach
        </div>
    @endif
</div>
