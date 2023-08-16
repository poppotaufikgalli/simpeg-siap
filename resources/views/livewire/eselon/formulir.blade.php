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
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="_id" wire:model.debounce.500ms="dataset._id" {{$sid != '' ? 'disabled' : 'required'}}>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="id_jenis_jabatan" class="col-sm-2 col-form-label">Jenis Jabatan</label>
                <div class="col-sm-4">
                    <select class="form-select" id="id_jenis_jabatan" wire:model="dataset.id_jenis_jabatan" wire:change="changeJnsJab($event.target.value)">
                        <option value="">Pilih Jenis Jabatan</option>
                        @if($master_jenis_jabatan)
                            @foreach($master_jenis_jabatan as $value)
                                <option value="{{$value->id}}">{{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <label for="nama" class="col-sm-2 col-form-label">Nama Eselon</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="nama" wire:model.debounce.500ms="dataset.nama" placeholder="I.a / IV.a / ..." {{$disabled}}>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jabatan_asn" class="col-sm-2 col-form-label">Jabatan ASN</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="jabatan_asn" wire:model.debounce.500ms="dataset.jabatan_asn">
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