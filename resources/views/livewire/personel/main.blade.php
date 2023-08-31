<div>
    <div class="card-body">
        <div class="card card-body mb-3">
            <div class="row g-2 mb-2">
                <label class="col-sm-2 col-form-label" for="id_opd">Satuan Kerja</label>
                <div class="col-sm-10">
                    <select class="form-select" id="id_opd" wire:model="id_opd" wire:change="changeParent($event.target.value)">
                        <option value="" selected>Semua</option>
                        @if($master_opd)
                            @foreach($master_opd as $value)
                                <option value="{{$value->id}}">{{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>                
            </div>
            <div class="row g-2 mb-2">
                <label class="col-sm-2 col-form-label" for="id_sub_opd">Sub Satuan Kerja</label>  
                <div class="col-sm-10">
                    <select class="form-select" id="id_sub_opd" wire:model="id_sub_opd">
                        <option value="" selected>Semua</option>
                        @if($subopd)
                            @foreach($subopd as $value)
                                <option value="{{$value->id}}">{{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>                
            </div>
            <div class="row g-2 mb-2">
                <label class="col-sm-2 col-form-label" for="id_jenis_jabatan">Jenis Jabatan</label>
                <div class="col-sm-5">
                    <select class="form-select" id="id_jenis_jabatan" wire:model="id_jenis_jabatan" wire:change="changeJnsJab($event.target.value)">
                        <option value="" selected>Semua</option>
                        @if($master_jenis_jabatan)
                            @foreach($master_jenis_jabatan as $value)
                                <option value="{{$value->id}}">{{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>                
                <label class="col-sm-1 col-form-label" for="keselon">Eselon</label>  
                <div class="col-sm-4">
                    <select class="form-select" id="keselon" wire:model="keselon">
                        <option value="" selected>Semua</option>
                        @if($subeselon)
                            @foreach($subeselon as $value)
                                <option value="{{$value->id}}">{{$value->nama}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <hr/>
            <div class="row g-2 mb-2">  
                <label class="col-sm-2 col-form-label" for="namapeg">Nama</label>
                <div class="col-sm-5">
                    <input type="search" class="form-control" id="namapeg" wire:model="namapeg" placeholder="Cari dengan :Nama">
                </div>
                <label class="col-sm-1 col-form-label" for="nip">NIP/NRP</label>
                <div class="col-sm-4">
                    <input type="search" class="form-control" id="nip" wire:model="nip" placeholder="Cari dengan :NIP/NRP">
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Nama</th>
                        <th width="10%">Pangkat</th>
                        <th width="10%">NIP/Korps/Kejuruan</th>
                        <th width="20%">Jabatan</th>
                        <th width="20%">Pendidikan</th>
                        <th width="10%">Usia</th>
                        <th width="5%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($pegawai)
                      @foreach($pegawai as $key => $value)
                            <tr>
                                <td align="center">{{$key +1}}</td>
                                <td>{{ $value->namapeg }}</td>
                                <td align="center">{{ $value->golongan_ruang }}<br>{{$value->nama_pangkat != "" ? "(".$value->nama_pangkat.")" : ""}}</td>
                                <td>
                                    {{ $value->nip }}
                                    @if($value->id_korps != "")
                                        <br>{{$value->nama_korps}}
                                    @endif 
                                    @if($value->id_kejuruan_korps != "")
                                        - {{$value->singkatan_kejuruan_korps}}
                                    @endif
                                </td>
                                <td>
                                    {{ $value->njab }} - {{$value->tmtjab != "" ? $value->tmtjab->format('d-m-Y') : ""}}
                                    @if($value->keselon != '99')
                                        <br/>{{$value->kode_eselon}}
                                    @endif
                                </td>
                                <td>{{ $value->stpu }} - {{ $value->npdum }} - {{ $value->thpendum }}</td>
                                <td align="center">{{$value->usiath}} th</td>
                                <td>
                                    <a target="_blank" href="{{route('personel.show', ['id_jenis_personel' => $id_jenis_personel, 'id' => str_replace('/','-',$value->nip)])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                    <a href="{{route('personel.edit', ['id_jenis_personel' => $id_jenis_personel, 'id' => str_replace('/','-',$value->nip), 'page' => 'data-induk'])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                    <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Akses" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            <div class="float-end">
                {{ $pegawai->links() }}
            </div>
        </div>
    </div>
</div>
