<div>
     <div class="card card-body mb-2 {{$subPage == 'list' ? 'd-block' : 'd-none'}}" id="list">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-sm btn-primary" id="btnTambah" wire:click="$emit('tambah')">Tambah</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="30%">Nama Jabatan</th>
                        <th>TMT</th>
                        <th>No SK</th>
                        <th>Tgl SK</th>
                        <th>Eselon</th>
                        <th>Terakhir?</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_riwayat_jabatan)
                      @foreach($master_riwayat_jabatan as $key => $value)
                            <tr>
                                <td>{{ $value->njab }}</td>
                                <td>{{ $value->tmtjab->format('d-m-Y') }}</td>
                                <td>{{ $value->nskjabat }}</td>
                                <td>{{ $value->tskjabat->format('d-m-Y') }}</td>
                                <td align="center">{{ $value->neselon->nama }}</td>
                                <td align="center">{{ $value->akhir == 1 ? 'Ya' : '' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button wire:click="$emitSelf('edit', {{$value->kjab}}, '{{$value->tmtjab}}')" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></button>
                                        <button wire:click="$emitSelf('delete', {{$value->kjab}}, '{{$value->tmtjab}}')" class="btn btn-xs btn-danger"><i class="bi bi-trash"></i></button>
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
                    <label>Formulir Jabatan</label>
                    <button type="button" wire:click="$emit('tutup')" class="btn btn-sm btn-primary">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
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
                        <label for="kpej" class="col-sm-2 col-form-label text-truncate">Pj. Penetap</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="kpej" wire:model="dataset.kpej">
                                @if($master_pejabat)
                                    @foreach($master_pejabat as $key => $value)
                                        <option value="{{$value->kpej}}">{{$value->npej}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="nskjabat" class="col-sm-2 col-form-label text-truncate">No. SK Jabatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nskjabat" wire:model="dataset.nskjabat" required>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="tskjabat" class="col-sm-2 col-form-label">Tgl. SK</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="tskjabat" wire:model="dataset.tskjabat">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="id_opd" class="col-sm-2 col-form-label text-truncate">Unit Kerja</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="id_opd" wire:model="dataset.id_opd" wire:change="searchJabatan()">
                                <option value="">Pilih OPD</option> 
                                @if($master_opd)
                                    @foreach($master_opd as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="jnsjab" class="col-sm-2 col-form-label text-truncate">Jenis Jabatan</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="jnsjab" wire:model="dataset.jnsjab" wire:change="changeJnsJab($event.target.value)">
                                <option value="">Pilih Jenis Jabatan</option>
                                @if($master_jenis_jabatan)
                                    @foreach($master_jenis_jabatan as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <label for="keselon" class="col-sm-2 col-form-label">Eselon</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="keselon" wire:model="dataset.keselon" wire:change="searchJabatan()">
                                <option value="">Pilih Eselon</option> 
                                @if($master_eselon)
                                    @foreach($master_eselon as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @else
                                    <option value="99">--</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="kjab" class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="kjab" wire:model="dataset.kjab" wire:change="checkJabatan($event.target.value)">
                                <option value="">Pilih Jabatan</option> 
                                @if($master_jabatan)
                                    @foreach($master_jabatan as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="tmtjab" class="col-sm-2 col-form-label">TMT Jabatan</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="tmtjab" wire:model="dataset.tmtjab">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="nlantik" class="col-sm-2 col-form-label text-truncate">No. SK Pelantikan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nlantik" wire:model="dataset.nlantik" required>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="tlantik" class="col-sm-2 col-form-label">Tgl. Pelantikan</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="tlantik" wire:model="dataset.tlantik">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-sm-10 offset-sm-2">
                            <button class="btn btn-sm btn-primary">{{ucwords($next)}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @if(in_array($method, ['edit']))
            <div class="card card-body mt-2">
                <div class="d-flex flex-column">
                    @if($master_jenis_arsip)
                        @foreach($master_jenis_arsip as $value)
                            <div class="d-flex justify-content-start align-items-center gap-2">
                                @php($btnColor = in_array($value->kdok, $arsip) ? 'btn-success' : 'btn-primary' )
                                <label>{{$value->nama}}</label>
                                <button type="button" class="btn btn-block {{$btnColor}} d-flex justify-content-between" 
                                    wire:click="$emitTo('modal-upload-arsip', 'openModal','{{route('arsip_elektronik.store', ['page' => $value->nama])}}', '{{$value}}', true, true, 'pangkat-terakhir')"
                                >
                                    SK Pangkat <i class="bi bi-cloud-upload ms-2"></i> 
                                </button>
                                @php($value->jnsdok = "lamp_".$value->jnsdok)
                                @php($value->nama = "Lampiran ".$value->nama)
                                <button type="button" class="btn btn-block {{$btnColor}} d-flex justify-content-between" 
                                    wire:click="$emitTo('modal-upload-arsip', 'openModal','{{route('arsip_elektronik.store', ['page' => $value->nama])}}', '{{$value}}', true, true, 'pangkat-terakhir')"
                                >
                                    Lampiran (*jika ada) <i class="bi bi-cloud-upload ms-2"></i> 
                                </button>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>