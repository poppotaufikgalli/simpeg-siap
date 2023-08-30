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
                        <th>Keterangan</th>
                        <th>Group</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <thead class="table-light">
                    <tr>
                        <th>
                            <input type="search" class="form-control" id="judul" wire:model="judul" placeholder="Cari Nama Item">
                        </th>
                        <th>
                            <input type="search" class="form-control" id="ket" wire:model="ket" placeholder="Cari Nama Keterangan">
                        </th>
                        <th>
                            <select class="form-select" id="group" wire:model="group">
                                <option value="">Semua</option>
                                @if($lsGroup)
                                    @foreach($lsGroup as $key => $value)
                                        <option value="{{$value}}">{{$value}}</option>
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
                            @if($group_arsip_id != $value->group)
                                <tr>
                                    <td colspan="4" class="bg-primary text-light">
                                        {{$value->group}}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td>{{ $value->judul }}</td>
                                <td align="center">{{ $value->ket }}</td>
                                <td align="center">{{ $value->group }}</td>
                                <td>
                                    <div class="d-grid gap-1">
                                        @if($value->filename != "")
                                            <button class="btn btn-sm btn-primary"
                                                wire:click="callModal('{{$value->filename}}')"
                                            ><i class="bi bi-eye me-2"></i> File</button>
                                        @endif
                                    </div>
                                </td>   
                            </tr>
                            @php($group_arsip_id = $value->group)
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @livewire('modal-upload-arsip-personel', ['sid' => $sid ?? ''])
</div>