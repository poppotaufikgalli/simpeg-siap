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
                <label for="nip" class="col-sm-2 col-form-label">NIP/NRP {{$next}}</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="nip" wire:model="dataset.nip" disabled>
                </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control" wire:model="dataset.nama" disabled>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="kpej" class="col-sm-2 col-form-label text-truncate">Pejabat Penetap</label>
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
                <label for="nstahu" class="col-sm-2 col-form-label text-truncate">No. SK KGB</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="nstahu" wire:model="dataset.nstahu" required>
                </div>
                <label for="tstahu" class="col-sm-2 col-form-label text-truncate">Tgl. SK KGB</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tstahu" wire:model="dataset.tstahu" required>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="tmtngaj" class="col-sm-2 col-form-label text-truncate">TMT Gaji Berkala</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tmtngaj" wire:model="dataset.tmtngaj" required>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="mskerja" class="col-sm-2 col-form-label text-truncate">Masa Kerja Pegawai</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="mskerja" wire:model="dataset.mskerja" placeholder="Thn">
                        <input type="text" class="form-control" id="mskerjabl" wire:model="dataset.mskerjabl" placeholder="Bln">
                    </div>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="gpokkhir" class="col-sm-2 col-form-label text-truncate">Gaji Pokok</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="gpokkhir" wire:model="dataset.gpokkhir">
                </div>
            </div>
            <div class="mb-2 row">
                <label for="nunker" class="col-sm-2 col-form-label text-truncate">Komponen Pembayaran Gaji</label>
                <div class="col-sm-10">
                    <input type="search" class="form-control" list="lsOPD" id="nunker" autocomplete="off" wire:model.debounce.500ms="dataset.nunker" wire:change="changeNunker($event.target.value)">
                    <datalist id="lsOPD">
                         @if($master_opd)
                            @foreach($master_opd as $key => $value)
                                <option value="{{$value->nama}}" data-id="{{$value->id}}">
                            @endforeach
                        @endif
                    </datalist>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2">
                    @if(in_array($method, ['create', 'edit']))
                        <button class="btn btn-sm btn-primary">Simpan</button>
                        <button class="btn btn-sm btn-dark" type="reset">Reset</button>
                    @endif
                </div>
            </div>
        </div>
    </form>
    <script>
        document.addEventListener('livewire:load', function () {
            IMask(
                document.getElementById('gpokkhir'),
                {
                    mask: 'Rp.num',
                    blocks: {
                        num: {
                            // nested masks are available!
                            mask: Number,
                            thousandsSeparator: ','
                        }
                    }
                }
            )
        })
    </script>
</div>
