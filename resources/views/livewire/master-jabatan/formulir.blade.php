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
                <label for="id_opd" class="col-sm-2 col-form-label">ID OPD</label>
                <div class="col-sm-10">
                    <select class="form-select" id="id_opd" wire:model="dataset.id_opd" wire:change="changeOPD($event.target.value)">
                        @if($master_opd)
                            <option value="" selected>Pilih OPD</option>
                            @foreach($master_opd as $key => $value)
                                <option value="{{$value->id}}">{{$value->id}} - {{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="parent_id" class="col-sm-2 col-form-label">Pejabat Atasan</label>
                <div class="col-sm-10">
                    <select class="form-select" id="parent_id" wire:model="dataset.parent_id" autocomplete="off">
                        @if($master_atasan)
                            <option value="" selected>Pilih Pejabat Atasan</option>
                            @foreach($master_atasan as $key => $value)
                                <option value="{{$value->id}}">{{$value->id}} - {{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="id_jenis_jabatan" class="col-sm-2 col-form-label">Jenis Jabatan</label>
                <div class="col-sm-3">
                    <select class="form-select" id="id_jenis_jabatan" wire:model="dataset.id_jenis_jabatan" wire:change="changeJnsJab($event.target.value)">
                        @if($master_jenis_jabatan)
                            <option value="" selected>Pilih Jenis Jabatan</option>
                            @foreach($master_jenis_jabatan as $key => $value)
                                <option value="{{$value->id}}" data-tableName="{{$value->table_name}}">{{$value->id}} - {{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <label for="id_eselon" class="col-sm-2 col-form-label">Eselon</label>
                <div class="col-sm-5">
                    <select class="form-select" id="id_eselon" wire:model="dataset.id_eselon" wire:change="changeEselon($event.target.value)" {{$selectEselon == true ? '' : 'disabled'}}>
                        @if($master_eselon)
                            <option value="" selected>Pilih Eselon</option>
                            @foreach($master_eselon as $key => $value)
                                <option value="{{$value->id}}">{{$value->id}} - {{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <hr>
            <div class="mb-3 row">
                <label for="_id" class="col-sm-2 col-form-label">ID Jabatan</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" id="_id" wire:model="dataset._id" {{$sid != '' ? 'disabled' : 'required'}}>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Jabatan</label>
                <div class="col-sm-8">
                    <input type="text" id="nama" wire:model="dataset.nama" oninput='onInput()' class="form-control" list="jabatan_list" autocomplete="off">
                    <datalist id="jabatan_list">
                        @if($master_jabatan)
                            @foreach($master_jabatan as $key => $value)
                                <option value="{{$value->nama}}" data-id="{{$value->id}}">
                            @endforeach
                        @endif
                    </datalist>
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="ref_jabatan_id" wire:model="dataset.ref_jabatan_id" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="kelas_jabatan" class="col-sm-2 col-form-label">Kelas Jabatan</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" id="kelas_jabatan" wire:model="dataset.kelas_jabatan" required>
                </div>
                <label for="nilai_jabatan" class="col-sm-2 col-form-label">Nilai Jabatan</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" id="nilai_jabatan" wire:model="dataset.nilai_jabatan" required>
                </div>
                <label for="indeks_jabatan" class="col-sm-2 col-form-label">Indeks Jabatan</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" id="indeks_jabatan" wire:model="dataset.indeks_jabatan" required>
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
        @livewire('modal-cari-jabatan')
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

        //document.getElementById('id_jenis_jabatan')

        /*document.getElementById('id_jab').addEventListener('change', function(e){
            console.log(e.target.selectedOptions[0].text)

            //@this.emit('changeJabatan',e.target.value)

            @this.set('kd_jab', e.target.value);
            @this.set('dataset.nama', e.target.selectedOptions[0].text);
        })*/

        /*document.getElementById('btnRefJabatan').addEventListener('click', function(e){
            var id_jenis_jabatan = document.getElementById('id_jenis_jabatan').value;
            @this.emitTo('modal-cari-jabatan', 'openModal', id_jenis_jabatan)
        })*/

        function onInput() {
            var val = document.getElementById("nama").value;
            var opts = document.getElementById('jabatan_list').childNodes;
            for (var i = 0; i < opts.length; i++) {
                if (opts[i].value === val) {
                    // An item was selected from the list!
                    // yourCallbackHere()
                    console.log(opts[i].dataset.id);
                    @this.set('dataset.ref_jabatan_id', opts[i].dataset.id)
                    break;
                }
            }
        }

        document.getElementById('parent_id').addEventListener('change', function(e){
            var parent_id = e.target.value
            @this.set('dataset._id', e.target.value)
        })

        /*document.getElementById('id_jenis_jabatan').addEventListener('change', function(e){
            const {tablename} = event.target.options[event.target.selectedIndex].dataset;
            @this.set('jab_table_name', tablename);
        })*/
    </script>
</div>