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
                <label for="_id" class="col-sm-2 col-form-label">ID Kelompok Jabatan</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" maxlength="32" id="_id" wire:model.debounce.500ms="dataset._id" {{$sid != '' ? 'disabled' : 'required'}}>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Kelompok Jabatan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" wire:model.debounce.500ms="dataset.nama" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jenis_jabatan_id" class="col-sm-2 col-form-label">Jenis Jabatan</label>
                <div class="col-sm-10">
                    <select class="form-select" id="jenis_jabatan_id" wire:model="dataset.jenis_jabatan_id">
                        <option value="">Pilih Jenis Jabatan</option>
                        @if($master_jenis_jabatan_umum)
                            @foreach($master_jenis_jabatan_umum as $key => $value)
                                <option value="{{$value->id}}">{{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="rumpun_jabatan_id" class="col-sm-2 col-form-label">Rumpun Jabatan</label>
                <div class="col-sm-10">
                    <select class="form-select" id="rumpun_jabatan_id" wire:model="dataset.rumpun_jabatan_id">
                        <option value="">Pilih Jenis Jabatan</option>
                        @if($master_rumpun_jabfung)
                            @foreach($master_rumpun_jabfung as $key => $value)
                                <option value="{{$value->id}}">{{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="pembina_id" class="col-sm-2 col-form-label">Instansi Pembina</label>
                <div class="col-sm-10">
                    <select class="form-select" id="pembina_id" wire:model="dataset.pembina_id">
                        <option value="">Pilih Instansi Pembina</option>
                        @if($master_instansi)
                            @foreach($master_instansi as $key => $value)
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
