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
                <label for="_id" class="col-sm-2 col-form-label">ID Jenis Hukuman Disiplin</label>
                <div class="col-sm-1">
                    <input type="text" class="form-control" maxlength="2" id="_id" wire:model.debounce.500ms="dataset._id" {{$sid != '' ? 'disabled' : 'required'}}>
                </div>
                <label for="ref_simpeg" class="offset-sm-4 col-sm-2 col-form-label">Ref SIMPEG Lama</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" maxlength="2"  id="ref_simpeg" wire:model.debounce.500ms="dataset.ref_simpeg">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Jenis Hukuman Disiplin</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" wire:model.debounce.500ms="dataset.nama" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jenis_tingkat_hukuman_id" class="col-sm-2 col-form-label">Tingkat Hukuman Disiplin</label>
                <div class="col-sm-10">
                    <select class="form-select" id="jenis_tingkat_hukuman_id" wire:model="dataset.jenis_tingkat_hukuman_id">
                        <option value="">Pilih Tingkat Hukuman</option>
                        <option value="R">Ringan</option>
                        <option value="S">Sedang</option>
                        <option value="B">Berat</option>
                    </select>
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
