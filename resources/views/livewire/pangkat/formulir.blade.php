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
                <label for="_id" class="col-sm-2 col-form-label">ID Pangkat</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="_id" wire:model.debounce.500ms="dataset._id" {{$sid != '' ? 'disabled' : 'required'}}>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Jenis Pangkat</label>
                <div class="col-sm-3">
                    <select class="form-select" id="id_jenis_personel" wire:model="dataset.id_jenis_personel">
                        <option value="">Pilih Jenis Pangkat</option>
                        @if($master_jenis_personel)
                            @foreach($master_jenis_personel as $key => $value)
                                <option value="{{$value->id_jenis_personel}}">{{$value->nama}}</option>   
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Korps</label>
                <div class="col-sm-3">
                    <select class="form-select" id="id_korps" wire:model="dataset.id_korps">
                        <option value="">Pilih Korps</option>
                        @if($master_korps)
                            @foreach($master_korps as $key => $value)
                                <option value="{{$value->id}}">{{$value->nama}}</option>   
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_pangkat" class="col-sm-2 col-form-label">Nama Pangkat</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="nama_pangkat" wire:model.debounce.500ms="dataset.nama_pangkat" required>
                </div>
                <!--<label for="ref_simpeg" class="col-sm-2 col-form-label">Ref. SIMPEG</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="ref_simpeg" wire:model.debounce.500ms="dataset.ref_simpeg">
                </div>-->
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Golongan Ruang (Singkatan Militer)</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="nama" wire:model.debounce.500ms="dataset.nama">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="pajak" class="col-sm-2 col-form-label">Besar Pengenaan Pajak</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="pajak" wire:model.debounce.500ms="dataset.pajak">
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
