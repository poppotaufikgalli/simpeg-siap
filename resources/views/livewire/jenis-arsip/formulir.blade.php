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
                <label for="group_arsip_id" class="col-sm-2 col-form-label">Group Arsip</label>
                <div class="col-sm-4">
                    <select class="form-select" id="group_arsip_id" wire:model="dataset.group_arsip_id"  {{$sid != '' ? 'disabled' : 'required'}}>
                        <option value="">Pilih Group Arsip</option>
                        @if($master_group_arsip)
                            @foreach($master_group_arsip as $value)
                                <option value="{{$value->id}}">{{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="_id" class="col-sm-2 col-form-label">Kode Arsip</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" maxlength="5" id="_id" wire:model.debounce.500ms="dataset._id" {{$sid != '' ? 'disabled' : 'required'}}>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Arsip</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nama" wire:model.debounce.500ms="dataset.nama">
                </div>
                <label for="jnsdok" class="col-sm-2 col-form-label">Nama Indeks Arsip</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="jnsdok" wire:model.debounce.500ms="dataset.jnsdok">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="riw" class="col-sm-2 col-form-label">Riwayat</label>
                <div class="col-sm-10 d-flex align-items-center">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="riw" wire:model="dataset.riw" wire:change="changeRiw($event.target.checked)">
                        <label class="form-check-label" for="riw" id="lblRiw">{{$lblRiw}}</label>
                    </div>
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