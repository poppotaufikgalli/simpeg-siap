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
                <label for="_id" class="col-sm-2 col-form-label">ID Pendidikan</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="32" class="form-control" id="_id" wire:model="dataset._id">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="ref_bkn" class="col-sm-2 col-form-label">Referensi BKN</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="32" class="form-control" id="ref_bkn" wire:model="dataset.ref_bkn">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tk_pendidikan_id" class="col-sm-2 col-form-label">Tingkat Pendidikan</label>
                <div class="col-sm-3">
                    <select class="form-select" id="tk_pendidikan_id" wire:model="dataset.tk_pendidikan_id">
                        <option value="-1">Pilih Tingkat Pendidikan</option>
                        @if($master_tingkat_pendidikan)
                            @foreach($master_tingkat_pendidikan as $value)
                                <option value="{{$value->id}}">{{$value->id}} - {{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Pendidikan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" wire:model="dataset.nama" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10 d-flex align-items-center">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="status" wire:model="dataset.status" wire:change="changeStts($event.target.checked)">
                        <label class="form-check-label" for="status" id="lblStts">{{$lblStts}}</label>
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
