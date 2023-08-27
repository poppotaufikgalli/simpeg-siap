<div>
    <div class="card card-body mb-2 {{$subPage == 'list' ? 'd-block' : 'd-none'}}" id="list">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-sm btn-primary" id="btnTambah" wire:click="$emitSelf('tambah')">Tambah</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Organisasi</th>
                        <th>Jenis</th>
                        <th>Keanggotaan</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_riwayat_organisasi)
                        @foreach($master_riwayat_organisasi as $key => $value)
                            <tr>
                                <td>{{ $value->norg }}</td>
                                <td>{{ $value->njns->nama }}</td>
                                <td>{{ $value->jborg }}</td>
                                <td align="center">{{ $value->tmulai->format('d-m-Y') }}</td>
                                <td align="center">{{ $value->takhir->format('d-m-Y') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button wire:click="$emitSelf('edit', {{$value}})" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></button>
                                        <button wire:click="$emitSelf('delete', {{$value}})" class="btn btn-xs btn-danger"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>   
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div id="formulir" class="{{$subPage == 'formulir' ? 'd-block' : 'd-none'}}">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <label>Formulir Organisasi</label>
                    <button type="button" wire:click="$emitSelf('tutup')" class="btn btn-sm btn-primary">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="card card-body">
                    <form wire:submit.prevent="{{$next}}">
                        @csrf
                        <div class="mb-2 row">
                            <label for="nip" class="col-sm-2 col-form-label">NIP/NRP</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="nip" wire:model="dataset.nip" disabled>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" wire:model="dataset.nama" disabled>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="jorg" class="col-sm-2 col-form-label text-truncate">Jenis Organisasi</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="jorg" wire:model="dataset.jorg" required>
                                    <option value="">Pilih Jenis Organisasi</option>
                                    @if($master_jenis_organisasi)
                                        @foreach($master_jenis_organisasi as $key => $value)
                                            <option value="{{$value->id}}">{{$value->nama}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="norg" class="col-sm-2 col-form-label text-truncate">Nama Organisasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="norg" wire:model="dataset.norg">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="jborg" class="col-sm-2 col-form-label text-truncate">Keanggotaan Sebagai</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="jborg" wire:model="dataset.jborg">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="tmulai" class="col-sm-2 col-form-label text-truncate">Tanggal Mulai</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tmulai" wire:model="dataset.tmulai" required>
                            </div>
                            <label for="takhir" class="col-sm-2 col-form-label text-truncate">Selesai</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="takhir" wire:model="dataset.takhir" required>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-sm-10 offset-sm-2">
                                <button class="btn btn-sm btn-primary">Simpan {{$next}}</button>
                            </div>
                        </div>
                    </form>
                </div>
                @if($master_jenis_arsip)
                    <div class="card card-body mt-2">
                        <div class="d-flex flex-column">
                            @foreach($master_jenis_arsip as $value)
                                <div class="d-flex justify-content-start align-items-center gap-2">
                                    <button type="button" class="btn btn-block btn-primary d-flex justify-content-between" 
                                        wire:click="$emitTo('modal-upload-arsip', 'openModal','{{route('arsip_elektronik.store', ['page' => $value->nama])}}', '{{$value}}', true, true, 'riw-organisasi')"
                                    >
                                        {{$value->nama}} <i class="bi bi-cloud-upload ms-2"></i> 
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>