<div>
    <form wire:submit.prevent="submit">
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
            <div class="mb-2 row">
                <label for="nstlud" class="col-sm-2 col-form-label">No. STLUD</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="nstlud" wire:model="dataset.nstlud">
                </div>
                <label for="tstlud" class="col-sm-2 col-form-label">Tgl. STLUD</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tstlud" wire:model="dataset.tstlud">
                </div>
            </div>
            <hr>
            <div class="mb-2 row">
                <label for="nntbakn" class="col-sm-2 col-form-label">Nota BKN</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nntbakn" wire:model="dataset.nntbakn">
                </div>
            </div>
            <div class="mb-2 row">
                <label for="tntbakn" class="col-sm-2 col-form-label">Tgl. Nota BKN</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tntbakn" wire:model="dataset.tntbakn">
                </div>
            </div>
            <hr>
            <div class="mb-2 row">
                <label for="ptetap" class="col-sm-2 col-form-label">Pj. Penetap</label>
                <div class="col-sm-10">
                    <select class="form-control" id="ptetap" wire:model="dataset.ptetap">
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
                        <input type="text" class="form-control" id="mskerja" wire:model="dataset.mskerja" placeholder="Thn">
                        <span class="input-group-text">th</span>
                        <input type="text" class="form-control" id="blnkerja" wire:model="dataset.blnkerja" placeholder="Bln">
                        <span class="input-group-text">bln</span>
                    </div>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="kgolru" class="col-sm-2 col-form-label">Pangkat / Gol</label>
                <div class="col-sm-10">
                    <select class="form-control" id="kgolru" wire:model="dataset.kgolru">
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
                    <select class="form-control" id="knpang" wire:model="dataset.knpang">
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
            <div class="mb-2 row">
                <div class="col-sm-10 offset-sm-2">
                    <button class="btn btn-sm btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
    @if(in_array($method, ['edit']))
        <div class="card card-body mt-2">
            <div class="d-flex flex-column">
                @if($master_jenis_arsip)
                    @foreach($master_jenis_arsip as $value)
                        <div class="d-flex justify-content-start align-items-center gap-2">
                            @php($btnColor = in_array($value->kdok, $arsip) ? 'btn-success' : 'btn-primary' )
                            <label>{{$value->nama}}</label>
                            <button type="button" class="btn btn-block {{$btnColor}} d-flex justify-content-between" 
                                wire:click="$emitTo('modal-upload-arsip', 'openModal','{{route('pegawai_arsip.store', ['page' => $value->nama])}}', '{{$value}}', true, true, 'pangkat-terakhir')"
                            >
                                SK Pangkat <i class="bi bi-cloud-upload ms-2"></i> 
                            </button>
                            @php($value->jnsdok = "lamp_".$value->jnsdok)
                            @php($value->nama = "Lampiran ".$value->nama)
                            <button type="button" class="btn btn-block {{$btnColor}} d-flex justify-content-between" 
                                wire:click="$emitTo('modal-upload-arsip', 'openModal','{{route('pegawai_arsip.store', ['page' => $value->nama])}}', '{{$value}}', true, true, 'pangkat-terakhir')"
                            >
                                Lampiran (*jika ada) <i class="bi bi-cloud-upload ms-2"></i> 
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endif
</div>
