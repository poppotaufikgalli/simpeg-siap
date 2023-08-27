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
                <label for="kpej" class="col-sm-2 col-form-label">Pj. Penetap</label>
                <div class="col-sm-10">
                    <select class="form-control" id="kpej" wire:model="dataset.kpej">
                        @if($master_pejabat)
                            @foreach($master_pejabat as $key => $value)
                                <option value="{{$value->kpej}}">{{$value->npej}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="skpns" class="col-sm-2 col-form-label">No. SK PNS</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="skpns" wire:model="dataset.skpns" required>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="tskpns" class="col-sm-2 col-form-label">Tgl. SK PNS</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tskpns" wire:model="dataset.tskpns" required>
                </div>
                <label for="tmtpns" class="col-sm-2 col-form-label">TMT PNS</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tmtpns" wire:model="dataset.tmtpns" required>
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
                <label for="kjpns" class="col-sm-2 col-form-label">Sudah Sumpah PNS</label>
                <div class="col-sm-10 d-flex align-items-center">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="kjpns" wire:model="dataset.kjpns" wire:change="changeStts($event.target.checked)">
                        <label class="form-check-label" for="kjpns" id="lblStts">{{$lblSumpah}}</label>
                    </div>
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
            <div class="row g-2">
                @if($master_jenis_arsip)
                    @foreach($master_jenis_arsip as $value)
                        <div class="col-sm-3 d-grid g-2">
                            @php($btnColor = in_array($value->kdok, $arsip) ? 'btn-success' : 'btn-primary' )
                            <button type="button" class="btn btn-block {{$btnColor}} d-flex justify-content-between" 
                                wire:click="$emitTo('modal-upload-arsip', 'openModal','{{route('arsip_elektronik.store', ['page' => $value->nama])}}', '{{$value}}', true, true, 'pns')"
                            >
                                {{$value->nama}} <i class="bi bi-cloud-upload"></i> 
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endif
</div>
