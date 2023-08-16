<div>
    <form wire:submit.prevent={{$next}} method="POST">
        @csrf
        <div class="mb-3 row">
            <div class="col-sm-10 offset-sm-2">
                <input type="hidden" wire:model="sid" class="form-control">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="id_jenis_personel" class="col-sm-2 col-form-label">Kode Jenis Personel</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" id="id_jenis_personel" wire:model="dataset.id_jenis_personel" {{$sid > 0 ? 'disabled' : 'required'}}>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama Jenis Personel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" wire:model="dataset.nama" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="stts" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10 d-flex align-items-center">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="stts" wire:model="dataset.stts"  wire:change="changeStts($event.target.checked)">
                    <label class="form-check-label" for="stts" id="lblStts">{{$lblStts}}</label>
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