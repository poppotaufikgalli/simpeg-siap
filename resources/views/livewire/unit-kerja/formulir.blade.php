<div>
    <div class="card-body">
        <form wire:submit.prevent={{$next}} method="POST">
            @csrf
            <div class="mb-3 row">
                <div class="col-sm-10 offset-sm-2">
                    <input type="hidden" wire:model="sid" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="parent_opd" class="col-sm-2 col-form-label">Unit Kerja Induk</label>
                <div class="col-sm-10">
                    <select class="form-select" id="parent_opd" wire:model="dataset.parent_opd" wire:change="changeParent($event.target.value)" {{$method == 'create' ? '' : 'disabled'}}>
                        <option value="">Pilih Unit Induk</option>
                        @if($opd_utama)
                            @foreach($opd_utama as $key => $value)
                                <option value="{{$value->id}}" {{$value->status != 1 ? 'disabled' : '' }}>{{$value->id}} - {{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <hr />
            <div class="mb-3 row">
                <label for="_id" class="col-sm-2 col-form-label">Kode Unit Kerja</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" maxlength="15" id="_id" wire:model.debounce.500ms="dataset._id" {{$method == 'create' ? 'required' : 'disabled'}}>
                </div>
                <label for="status" class="col-sm-2 col-form-label">Aktif</label>
                <div class="col-sm-3 d-flex align-items-center">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="status" wire:model="dataset.status" wire:change="changeStts($event.target.checked)">
                        <label class="form-check-label" for="status" id="lblStts">{{$lblStts}}</label>
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Unit Kerja</label>
                <div class="col-sm-5">
                    <textarea class="form-control" id="nama" wire:model.debounce.500ms="dataset.nama" required></textarea>
                </div>
                <label for="disingkat" class="col-sm-2 col-form-label">Singkatan</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="disingkat" wire:model.debounce.500ms="dataset.disingkat" placeholder="Kosongkan jika tidak ada">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="id_eselon" class="col-sm-2 col-form-label">Eselon</label>
                <div class="col-sm-5">
                    <select class="form-select" id="id_eselon" wire:model="dataset.id_eselon">
                        @if($master_eselon)
                            <option value="">Pilih Eseon</option>
                            <option value="99">Non</option>
                            @foreach($master_eselon as $key => $value)
                                <option value="{{$value->id}}">{{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <label for="sfilter" class="col-sm-2 col-form-label">Unit Kerja Utama</label>
                <div class="col-sm-3 d-flex align-items-center">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="sfilter" wire:model="dataset.sfilter" wire:change="changeSfilter($event.target.checked)">
                        <label class="form-check-label" for="sfilter" id="lblSfilter">{{$lblSfilter}}</label>
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="alamat" wire:model.debounce.500ms="dataset.alamat"></textarea>
                </div>
            </div>
            <hr>
            <div class="mb-3 row">
                <label for="nama_jabatan_kepala" class="col-sm-2 col-form-label">Nama Jabatan Kepala</label>
                <div class="col-sm-10">
                    <input type="search" class="form-control" id="nama_jabatan_kepala" wire:model.debounce.500ms="dataset.nama_jabatan_kepala" placeholder="Kosongkan jika tidak ada">
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
        </form>
    </div>
    <script>
        window.addEventListener('errors', function(e) {
            const notyf = new Notyf();
            const {detail} = e;

            var lserror = Object.values(detail);
            console.log(lserror)
            if(lserror.length > 0){
                for (var i = lserror.length - 1; i >= 0; i--) {
                    notyf.error(lserror[i][0])
                }
            }
        });
    </script>
</div>