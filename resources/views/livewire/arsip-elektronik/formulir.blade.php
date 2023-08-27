<div>
    <div class="card-body">
        <div class="mb-3 row">
            <div class="col-sm-10 offset-sm-2">
                <input type="hidden" wire:model="sid" class="form-control">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nip" class="col-sm-2 col-form-label">NIP</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" maxlength="32" id="nip" wire:model.debounce.500ms="dataset.nip" {{$sid != '' ? 'disabled' : 'required'}}>
            </div>
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="nama" wire:model.debounce.500ms="dataset.nama">
            </div>
        </div>
        <hr>
        <div class="mb-3">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th>Item</th>
                        <th>Jenis</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <thead class="table-light">
                    <tr>
                        <th>
                            <input type="search" class="form-control" id="nama" wire:model="nama" placeholder="Cari Nama Item">
                        </th>
                        <th>
                            <select class="form-select" id="group_arsip_id" wire:model="group_arsip_id">
                                <option value="">Semua</option>
                                @if($master_group_arsip)
                                    @foreach($master_group_arsip as $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($lsArsip)
                        @php($group_arsip_id = "")
                        @foreach($lsArsip as $key => $value)
                            @if($group_arsip_id != $value->group_arsip_id)
                                <tr>
                                    <td colspan="3" class="bg-primary text-light">
                                        {{$value->ngrDok->nama}}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td>{{ $value->nama }}</td>
                                <td align="center">{{ $value->ngrDok->nama }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-primary">File</button>
                                        <button class="btn btn-sm btn-info">Lampiran</button>
                                        <button class="btn btn-sm btn-warning">BA</button>
                                        <button class="btn btn-sm btn-secondary">PP</button>
                                    </div>
                                </td>   
                            </tr>
                            @php($group_arsip_id = $value->group_arsip_id)
                        @endforeach
                    @endif
                </tbody>
            </table>
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
</div>