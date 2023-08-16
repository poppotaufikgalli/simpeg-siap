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
                <label for="_id" class="col-sm-2 col-form-label">ID Kedudukan Hukum Pegawai</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" maxlength="2" id="_id" wire:model="dataset._id" {{$sid != '' ? 'disabled' : 'required'}}>
                </div>
                <label for="ref_simpeg" class="col-sm-2 col-form-label">Referensi SIMPEG</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="ref_simpeg" wire:model="dataset.ref_simpeg">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Kedudukan Hukum Pegawai</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" wire:model="dataset.nama" required>
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
