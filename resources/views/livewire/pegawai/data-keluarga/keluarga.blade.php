<div>
    <div class="card card-body mb-2 {{$subPage == 'list' ? 'd-block' : 'd-none'}}" id="list">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-sm btn-primary" id="btnTambah" wire:click="$emitSelf('tambah')">Tambah</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="20%">Nama {{$master_jenis_keluarga->nama}}</th>
                        <th width="20%">Tempat/Tgl. Lahir</th>
                        @if($jkeluarga == 1)
                        <th>Tgl. Nikah</th>
                        @elseif($jkeluarga == 2)
                        <th>Jenis Kelamin</th>
                        @endif
                        <th>Pekerjaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_riwayat_keluarga)
                        @foreach($master_riwayat_keluarga as $key => $value)
                            <tr>
                                <td>{{ $value->nama_kel }}</td>
                                <td>{{ $value->ktlahir }}, {{ $value->tlahir->format('d-m-Y') ?? '' }}</td>
                                @if($jkeluarga == 1)
                                <td align="center">{{ $value->tkawin->format('d-m-Y') }}</td>
                                @elseif($jkeluarga == 2)
                                <td align="center">{{ $value->kjkel == 1 ? 'Laki-laki' : 'Perempuan' }}</td>
                                @endif
                                <td align="center">{{ $value->nkerja->nama ?? '' }}</td>
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
                    <label>Formulir {{$master_jenis_keluarga->nama}}</label>
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
                            <label for="nama_kel" class="col-sm-2 col-form-label">Nama {{$master_jenis_keluarga->nama}}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_kel" wire:model="dataset.nama_kel" required>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="ktlahir" class="col-sm-2 col-form-label text-truncate">Tempat Lahir</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="ktlahir" wire:model="dataset.ktlahir">
                            </div>
                            <label for="tlahir" class="col-sm-2 col-form-label text-truncate">Tgl. Lahir</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="tlahir" wire:model="dataset.tlahir" required>
                            </div>
                        </div>
                        @if(in_array($jkeluarga, [1]))
                        <div class="mb-2 row">
                            <label for="tkawin" class="col-sm-2 col-form-label text-truncate">Tgl. Menikah</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" id="tkawin" wire:model="dataset.tkawin" required>
                            </div>
                            <label for="akhir" class="col-sm-2 col-form-label">{{$master_jenis_keluarga->nama}} Terakhir</label>
                            <div class="col-sm-3 d-flex align-items-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="akhir" wire:model="dataset.akhir" wire:change="changeStts($event.target.checked)">
                                    <label class="form-check-label" for="akhir" id="lblStts">{{$lblStts}}</label>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(in_array($jkeluarga, [1,2]))
                        <div class="mb-2 row">
                            <label for="tijazah" class="col-sm-2 col-form-label text-truncate">Tingkat Pendidikan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tijazah" wire:model="dataset.tijazah" required>
                            </div>
                        </div>
                        @endif
                        @if(in_array($jkeluarga, [2]))
                        <div class="mb-2 row">
                            <label for="kjkel" class="col-sm-2 col-form-label text-truncate">Jenis Kelamin</label>
                            <div class="col-sm-4">
                                <select class="form-select" id="kjkel" wire:model="dataset.kjkel" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="1">Laki-laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>
                            <label for="hubkel" class="col-sm-2 col-form-label text-truncate">Hubungan Keluarga</label>
                            <div class="col-sm-4">
                                <select class="form-select" id="hubkel" wire:model="dataset.hubkel" required>
                                    <option value="">Pilih Hubungan Keluarga</option>
                                    <option value="K">Kandung</option>
                                    <option value="T">Tiri</option>
                                    <option value="A">Angkat</option>
                                </select>
                            </div>
                        </div>
                        @endif
                        @if(in_array($jkeluarga, [1,2]))
                        <div class="mb-2 row">
                            <label for="stunj" class="col-sm-2 col-form-label text-truncate">Status Tunjangan</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="stunj" wire:model="dataset.stunj" required>
                                    <option value="">Pilih Status Tunjangan</option>
                                    <option value="D">Dapat</option>
                                    <option value="T">Tidak Dapat</option>
                                </select>
                            </div>
                        </div>
                        @else
                        <div class="mb-2 row gy-2">
                            <label for="aljalan" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="aljalan" wire:model="dataset.aljalan"></textarea>
                            </div>
                            <label for="alrt" class="col-sm-2 col-form-label text-truncate">RT</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="alrt" wire:model="dataset.alrt">
                            </div>
                            <label for="alrw" class="col-sm-2 col-form-label text-truncate">RW</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="alrw" wire:model="dataset.alrw">
                            </div>
                            <label for="kodepos" class="col-sm-2 col-form-label text-truncate">Kode Pos</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="kodepos" wire:model="dataset.kodepos">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="wil" class="col-sm-2 col-form-label text-truncate">Kec./Kab./Provinsi</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" id="wil" wire:model="dataset.wil"></textarea>
                            </div>
                            <label for="notelp" class="col-sm-2 col-form-label text-truncate">Telepon</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="notelp" wire:model="dataset.notelp">
                            </div>
                        </div>
                        @endif
                        <hr>
                        <div class="mb-2 row">
                            <label for="jam" class="col-sm-2 col-form-label text-truncate">Pekerjaan</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="kkerja" wire:model="dataset.kkerja" required>
                                    <option value="">Pilih Pekerjaan</option>
                                    @if($master_pekerjaan)
                                        @foreach($master_pekerjaan as $key => $value)
                                            <option value="{{$value->id}}">{{$value->nama}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @if(in_array($jkeluarga, [1]))
                        <div class="mb-2 row gy-2">
                            <label for="instansi" class="col-sm-2 col-form-label text-truncate">Instansi (Khusus PNS)</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="instansi" wire:model="dataset.instansi"></textarea>
                            </div>
                            <label for="nip_kel" class="col-sm-2 col-form-label text-truncate">NIP {{$master_jenis_keluarga->nama}} (Khusus PNS)</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="nip_kel" wire:model="dataset.nip_kel">
                            </div>
                        </div>
                        @endif
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
                                        wire:click="$emitTo('modal-upload-arsip', 'openModal','{{route('arsip_elektronik.store', ['page' => $value->nama])}}', '{{$value}}', true, true, 'riw-pendum')"
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