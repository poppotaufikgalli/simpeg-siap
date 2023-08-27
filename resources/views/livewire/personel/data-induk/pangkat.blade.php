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
                <label for="kstlud" class="col-sm-2 col-form-label">STLUD</label>
                <div class="col-sm-4">
                    <select class="form-control" id="kstlud" wire:model="dataset.kstlud">
                        @if($master_stlud)
                            @foreach($master_stlud as $key => $value)
                                <option value="{{$value->kstlud}}">{{$value->nstlud}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col">
                    <em>*) Surat Tanda Lulus Ujian Dinas</em>
                </div>
            </div>
            <hr>
            <div class="mb-2 row">
                <label for="ptetap" class="col-sm-2 col-form-label">Pj. Penetap</label>
                <div class="col-sm-10">
                    <select class="form-control" id="ptetap" wire:model="dataset.ptetap">
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
                <label for="nskpang" class="col-sm-2 col-form-label text-truncate">No. SK Pangkat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nskpang" wire:model="dataset.nskpang" required>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="tskpang" class="col-sm-2 col-form-label text-truncate">Tgl. SK Pangkat</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tskpang" wire:model="dataset.tskpang" required>
                </div>
                <label for="tmtpang" class="col-sm-2 col-form-label">TMT Pangkat</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tmtpang" wire:model="dataset.tmtpang" required>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="mskerja" class="col-sm-2 col-form-label text-truncate">Masa Kerja Golongan</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="mskerja" wire:model="dataset.mskerja" placeholder="Thn" required>
                        <span class="input-group-text">th</span>
                        <input type="text" class="form-control" id="blnkerja" wire:model="dataset.blnkerja" placeholder="Bln" required>
                        <span class="input-group-text">bln</span>
                    </div>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="kgolru" class="col-sm-2 col-form-label">Pangkat / Gol</label>
                <div class="col-sm-10">
                    <select class="form-control" id="kgolru" wire:model="dataset.kgolru" required>
                        <option value="">Pilih Pangkat / Gol.</option> 
                        @if($master_pangkat)
                            @foreach($master_pangkat as $key => $value)
                                <option value="{{$value->id}}">{{$value->nama_pangkat}} ({{$value->nama}})</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="knpang" class="col-sm-2 col-form-label text-truncate">Jenis Kenaikan Pangkat</label>
                <div class="col-sm-10">
                    <select class="form-control" id="knpang" wire:model="dataset.knpang" required>
                        <option value="">Pilih Jenis Kenaikan Pangkat</option> 
                        @if($master_naik_pangkat)
                            @foreach($master_naik_pangkat as $key => $value)
                                <option value="{{$value->id}}">{{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="akredit" class="col-sm-2 col-form-label">Angka Kredit</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="akredit" wire:model="dataset.akredit">
                </div>
            </div>
            @if($akhir != 1)
                <div class="mb-2 row">
                    <label for="akhir" class="col-sm-2 col-form-label">Pangkat Akhir</label>
                    <div class="col-sm-4 d-flex align-items-center">
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
            <div class="d-flex flex-column">
                @foreach($master_jenis_arsip as $value)
                    <div class="d-flex justify-content-start align-items-center gap-2">
                        @php($btnColor = in_array($value->kdok, $arsip) ? 'btn-success' : 'btn-primary' )
                        <button type="button" class="btn btn-block {{$btnColor}} d-flex justify-content-between" 
                            wire:click="$emitTo('modal-upload-arsip', 'openModal','{{route('arsip_elektronik.store', ['page' => $value->nama])}}', '{{$value}}', true, true, 'pangkat-terakhir')"
                        >
                            SK {{$value->nama}} <i class="bi bi-cloud-upload ms-2"></i> 
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
