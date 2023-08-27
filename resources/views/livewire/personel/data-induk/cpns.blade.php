<div>
    <form wire:submit.prevent="submit">
        @csrf
        <div class="card card-body">
            <div class="mb-2 row">
                <div class="col-sm-10 offset-sm-2">
                    <input type="hidden" wire:model="sid" id="sid" class="form-control">
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
                <label for="ntbakn" class="col-sm-2 col-form-label">Nota BKN</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ntbakn" wire:model="dataset.ntbakn">
                </div>
            </div>
            <div class="mb-2 row">
                <label for="tntbakn" class="col-sm-2 col-form-label">Tgl. Nota BKN</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tntbakn" wire:model="dataset.tntbakn">
                </div>
            </div>
            <div class="mb-2 row">
                <label for="kpej" class="col-sm-2 col-form-label">Pj. Penetap</label>
                <div class="col-sm-10">
                    <select class="form-control" id="kpej" wire:model="dataset.kpej" required>
                        <option value="" selected>Pilih Pejabat Penetap</option>
                        @if($master_pejabat)
                            @foreach($master_pejabat as $key => $value)
                                <option value="{{$value->kpej}}">{{$value->npej}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="skcpns" class="col-sm-2 col-form-label">No. SK CPNS</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="skcpns" wire:model="dataset.skcpns" required>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="tskcpns" class="col-sm-2 col-form-label">Tgl. SK CPNS</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tskcpns" wire:model="dataset.tskcpns" required>
                </div>
                <label for="tmtcpns" class="col-sm-2 col-form-label">TMT CPNS</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tmtcpns" wire:model="dataset.tmtcpns" required>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="kgolru" class="col-sm-2 col-form-label">Pangkat / Gol</label>
                <div class="col-sm-10">
                    <select class="form-control" id="kgolru" wire:model="dataset.kgolru" required>
                        <option value="" selected>Pilih Golongan Ruang</option>
                        @if($master_pangkat)
                            @foreach($master_pangkat as $key => $value)
                                <option value="{{$value->id}}">{{$value->nama_pangkat}} ({{$value->nama}})</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="mskerjabl" class="col-sm-2 col-form-label">Masa Kerja CPNS</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="mskerjath" wire:model="dataset.mskerjath" placeholder="Thn" required>
                        <span class="input-group-text">th</span>
                        <input type="text" class="form-control" id="mskerjabl" wire:model="dataset.mskerjabl" placeholder="Bln" required>
                        <span class="input-group-text">Bl</span>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="mb-2 row">
                <label for="nsttpp" class="col-sm-2 col-form-label">No. STTPP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nsttpp" wire:model="dataset.nsttpp">
                </div>
            </div>
            <div class="mb-2 row">
                <label for="tsttpp" class="col-sm-2 col-form-label">Tgl. STTPP</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tsttpp" wire:model="dataset.tsttpp">
                </div>
                <label for="tmtlgas" class="col-sm-2 col-form-label">Tgl. Melaksanakan Tugas</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tmtlgas" wire:model="dataset.tmtlgas">
                </div>
            </div>
            <div class="mb-2 row">
                <label for="srtsehatno" class="col-sm-2 col-form-label">No. Surat Kesehatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="srtsehatno" wire:model="dataset.srtsehatno">
                </div>
            </div>
            <div class="mb-2 row">
                <label for="srtsehattgl" class="col-sm-2 col-form-label">Tgl. Surat</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="srtsehattgl" wire:model="dataset.srtsehattgl">
                </div>
            </div>
            <div class="mb-2 row">
                <div class="col-sm-10 offset-sm-2">
                    <button class="btn btn-sm btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>

    @if($master_jenis_arsip)
        <div class="card card-body mt-2">
            <div class="row g-2">
                @foreach($master_jenis_arsip as $value)
                    <div class="col-sm-3 d-grid g-2">
                        <button type="button" class="btn btn-block btn-primary d-flex justify-content-between" 
                            wire:click="$emitTo('modal-upload-arsip', 'openModal','{{route('arsip_elektronik.store', ['page' => $value->nama])}}', '{{$value}}', true, true, 'cpns')"
                        >
                            {{$value->nama}} <i class="bi bi-cloud-upload"></i> 
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
