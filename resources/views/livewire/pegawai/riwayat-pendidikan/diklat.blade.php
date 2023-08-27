<div>
    <div class="card card-body mb-2 {{$subPage == 'list' ? 'd-block' : 'd-none'}}" id="list">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-sm btn-primary" id="btnTambah" wire:click="$emitSelf('tambah')">Tambah</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        @if(in_array($jdiklat, [8]))
                        <th width="20%">Nama Seminar</th>
                        <th width="20%">Peran Sebagai</th>
                        <th width="20%">Tempat</th>
                        <th>Waktu Pelaksanaan</th>
                        @elseif(in_array($jdiklat, [9]))
                        <th width="40%">Judul Buku/Karya Tulis/Makalah</th>
                        <th width="20%">Tempat Pembuatan/Terbit</th>
                        <th width="20%">Tgl Pembuatan</th>
                        @elseif(in_array($jdiklat, [10]))
                        <th width="20%">Nama {{$master_jenis_diklat->nama}}</th>
                        <th width="20%">Tempat</th>
                        <th>Penyelenggara</th>
                        <th>Tanggal Ujian</th>
                        <th>Berlaku Sampai</th>
                        <th>Status</th>
                        @else
                        <th width="20%">Nama {{$master_jenis_diklat->nama}}</th>
                        <th width="20%">Tempat</th>
                        <th>Panitia</th>
                        <th>Waktu Pelaksanaan</th>
                        <th>Akhir</th>
                        @endif
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_riwayat_diklat)
                        @foreach($master_riwayat_diklat as $key => $value)
                            <tr>
                                @if(in_array($jdiklat, [8]))
                                <td>{{ $value->ndiklat }}</td>
                                <td>{{ $value->sebagai }}</td>
                                <td>{{ $value->tempat }}</td>
                                <td align="center">{{ $value->tmulai->format('d-m-Y') }}<br>{{ $value->takhir->format('d-m-Y') }}</td>
                                @elseif(in_array($jdiklat, [9]))
                                <td>{{ $value->ndiklat }}</td>
                                <td>{{ $value->tempat }}</td>
                                <td align="center">{{ $value->tmulai->format('d-m-Y') }}</td>
                                @elseif(in_array($jdiklat, [10]))
                                <td>{{ $value->ndiklat }}</td>
                                <td>{{ $value->tempat }}</td>
                                <td>{{ $value->pan }}</td>
                                <td align="center">{{ $value->tmulai->format('d-m-Y') }}</td>
                                <td align="center">{{ $value->takhir->format('d-m-Y') }}</td>
                                <td align="center">
                                    @if($value->takhir->format('d-m-Y') >= date("d-m-Y"))
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                    @else
                                        <i class="bi bi-x-circle-fill text-danger"></i>
                                    @endif
                                </td>
                                @else
                                <td>{{ $value->ndiklat }}</td>
                                <td>{{ $value->tempat }}</td>
                                <td>{{ $value->pan }}</td>
                                <td align="center">{{ $value->tmulai->format('d-m-Y') }}<br>{{ $value->takhir->format('d-m-Y') }}</td>
                                <td align="center">{{ $value->akhir == 1 ? 'Ya' : '' }}</td>
                                @endif
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
                    <label>Formulir {{$master_jenis_diklat->nama}}</label>
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
                        @if(in_array($jdiklat, [1,2,3,10]))
                        <div class="mb-2 row">
                            <label for="kdiklat" class="col-sm-2 col-form-label text-truncate">Jenis {{$master_jenis_diklat->nama}}</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="kdiklat" wire:model="dataset.kdiklat" wire:change="setndiklat($event.target.value)" required>
                                    <option value="">Pilih Jenis {{$master_jenis_diklat->nama}}</option>
                                    @if($master_diklat)
                                        @php($opt = "")
                                        @foreach($master_diklat as $key => $value)
                                            @if($opt != $value->ket_group)
                                                <option value="" disabled>{{$value->ket_group}}</option>
                                                @php($opt = $value->ket_group)
                                            @endif
                                            <option value="{{$value->id}}">{{$value->nama}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @elseif(in_array($jdiklat, [8]))
                        <div class="mb-2 row">
                            <label for="ndiklat" class="col-sm-2 col-form-label">Nama Seminar</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="ndiklat" wire:model="dataset.ndiklat"></textarea>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="sebagai" class="col-sm-2 col-form-label text-truncate">Peran Sebagai</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="sebagai" wire:model="dataset.sebagai">
                            </div>
                        </div>
                        @else
                        <div class="mb-2 row">
                            <label for="ndiklat" class="col-sm-2 col-form-label">Nama {{in_array($jdiklat, [9]) ? 'Buku' : ''}} {{$master_jenis_diklat->nama}}</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="ndiklat" wire:model="dataset.ndiklat"></textarea>
                            </div>
                        </div>
                        @endif
                        <div class="mb-2 row">
                            <label for="tempat" class="col-sm-2 col-form-label text-truncate">Tempat {{in_array($jdiklat, [9]) ? 'Pembuatan/Terbit' : (in_array($jdiklat, [10]) ? 'Ujian'  :'') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tempat" wire:model="dataset.tempat">
                            </div>
                        </div>
                        @if(in_array($jdiklat, [1,2,3,4,5,6,7]))
                        <div class="mb-2 row">
                            <label for="pan" class="col-sm-2 col-form-label text-truncate">Panitia</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="pan" wire:model="dataset.pan">
                            </div>
                        </div>
                        @elseif(in_array($jdiklat, [10]))
                        <div class="mb-2 row">
                            <label for="pan" class="col-sm-2 col-form-label text-truncate">Penyelenggara</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="pan" wire:model="dataset.pan">
                            </div>
                        </div>
                        @endif
                        @if(in_array($jdiklat, [1,2,3]))
                        <div class="mb-2 row">
                            <label for="angkatan" class="col-sm-2 col-form-label text-truncate">Angkatan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="angkatan" wire:model="dataset.angkatan">
                            </div>
                        </div>
                        @endif
                        @if(in_array($jdiklat, [1,2,3,4,5,6,7,8]))
                        <div class="mb-2 row">
                            <label for="tmulai" class="col-sm-2 col-form-label text-truncate">Tgl Mulai</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tmulai" wire:model="dataset.tmulai">
                            </div>
                            <label for="takhir" class="col-sm-2 col-form-label text-truncate">Tgl Selesai</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="takhir" wire:model="dataset.takhir">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="jam" class="col-sm-2 col-form-label text-truncate">Jumlah Jam</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="jam" wire:model="dataset.jam">
                            </div>
                        </div>
                        <hr>
                        <div class="mb-2 row">
                            <label for="nsttpp" class="col-sm-2 col-form-label text-truncate">No {{in_array($jdiklat, [5,6,8]) ? 'Piagam' : 'STTPP'}}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nsttpp" wire:model="dataset.nsttpp">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="tsttpp" class="col-sm-2 col-form-label text-truncate">Tgl {{in_array($jdiklat, [5,6,8]) ? 'Piagam' : 'STTPP'}}</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tsttpp" wire:model="dataset.tsttpp">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="akhir" class="col-sm-2 col-form-label">Akhir</label>
                            <div class="col-sm-4 d-flex align-items-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="akhir" wire:model="dataset.akhir" wire:change="changeStts($event.target.checked)">
                                    <label class="form-check-label" for="akhir" id="lblStts">{{$lblStts}}</label>
                                </div>
                            </div>
                        </div>
                        @elseif(in_array($jdiklat, [9]))
                        <div class="mb-2 row">
                            <label for="tmulai" class="col-sm-2 col-form-label">Tanggal Pembuatan</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tmulai" wire:model="dataset.tmulai">
                            </div>
                        </div>
                        @elseif(in_array($jdiklat, [10]))
                        <div class="mb-2 row">
                            <label for="tmulai" class="col-sm-2 col-form-label text-truncate">Tanggal Ujian</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tmulai" wire:model="dataset.tmulai">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="takhir" class="col-sm-2 col-form-label text-truncate">Berlaku Sampai</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="takhir" wire:model="dataset.takhir">
                            </div>
                        </div>
                        <hr>
                        <div class="mb-2 row">
                            <label for="nsttpp" class="col-sm-2 col-form-label text-truncate">No Sertifikat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nsttpp" wire:model="dataset.nsttpp">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="tsttpp" class="col-sm-2 col-form-label text-truncate">Tgl Sertifikat</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tsttpp" wire:model="dataset.tsttpp">
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