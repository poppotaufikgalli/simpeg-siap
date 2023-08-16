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
                <label for="_id" class="col-sm-2 col-form-label">ID</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" maxlength="2" id="_id" wire:model.debounce.500ms="dataset._id" {{$sid != '' ? 'disabled' : 'required'}}>
                </div>
                <label for="ref_simpeg" class="offset-sm-4 col-sm-2 col-form-label">Ref SIMPEG</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="ref_simpeg" wire:model.debounce.500ms="dataset.ref_simpeg">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Tingkat Pendidikan</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" maxlength="30" id="nama" wire:model.debounce.500ms="dataset.nama">
                </div>
                <label for="group_tk_pend_nm" class="col-sm-2 col-form-label">Nama Group Tingkat Pendidikan</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" maxlength="30" id="group_tk_pend_nm" wire:model.debounce.500ms="dataset.group_tk_pend_nm">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="maxkgolru" class="col-sm-2 col-form-label">Maksimal Pangkat</label>
                <div class="col-sm-2">
                    <select class="form-select" id="maxkgolru" wire:model.debounce.500ms="dataset.maxkgolru">
                        <option value="">Pilih Maksimal Pangkat</option>
                        @if($master_pangkat)
                            @foreach($master_pangkat as $value)
                                <option value="{{$value->id}}">{{$value->nama}}</option>
                            @endforeach
                        @endif
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