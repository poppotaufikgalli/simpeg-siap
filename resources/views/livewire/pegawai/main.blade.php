<div>
    <div class="card-body">
        <div class="card card-body mb-3">
            <div class="row g-2 mb-2">
                <label class="col-sm-2 col-form-label" for="id_opd">Unit Kerja Utama</label>
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
                <label class="col-sm-2 col-form-label" for="id_sub_opd">Sub Unit Kerja</label>  
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
                <label class="col-sm-1 col-form-label" for="id_eselon">Eselon</label>  
                <div class="col-sm-4">
                    <select class="form-select" id="id_eselon" wire:model="id_eselon">
                        <option value="" selected>Semua</option>
                        @if($subeselon)
                            @foreach($subeselon as $value)
                                <option value="{{$value->id_eselon}}">{{$value->nama}}</option>
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
                <label class="col-sm-1 col-form-label" for="nip">NIP</label>
                <div class="col-sm-4">
                    <input type="search" class="form-control" id="nip" wire:model="nip" placeholder="Cari dengan :NIP">
                </div>
            </div>
            <div class="row g-2">
                <div class="col-sm-10 offset-sm-2">
                    <a class="btn btn-info text-truncate" data-bs-toggle="collapse" href="#collapseKriteria" role="button" aria-expanded="false" aria-controls="collapseKriteria">
                        * Status dan Jenis Kepegawaian
                    </a>
                </div>
                <div class="col-sm-10 offset-sm-2">
                    <div class="collapse mb-1" id="collapseKriteria" wire:ignore.self>
                        <div class="row">
                            <div class="col">
                                <ul class="list-group">
                                    <li class="list-group-item bg-info">
                                        <div class="fw-bold">Status</div>
                                    </li>
                                    @if($master_status_pegawai)
                                        @foreach($master_status_pegawai as $value)
                                            <li class="list-group-item d-flex">
                                                <input class="form-check-input me-2" type="checkbox" value="{{$value->kstatus}}" wire:model="kstatus" id="kstatus-{{$value->kstatus}}">
                                                <label class="form-check-label stretched-link" for="kstatus-{{$value->kstatus}}">{{$value->nama}}</label>
                                            </li>        
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="col">
                                <ul class="list-group">
                                    <li class="list-group-item bg-info">
                                        <div class="fw-bold">Jenis Pegawai</div>
                                    </li>
                                    @if($master_jenis_pegawai)
                                        @foreach($master_jenis_pegawai as $value)
                                            <li class="list-group-item d-flex">
                                                <input class="form-check-input me-2" type="checkbox" value="{{$value->id}}" wire:model="kjpeg" id="kjpeg-{{$value->id}}">
                                                <label class="form-check-label stretched-link" for="kjpeg-{{$value->id}}">{{$value->nama}}</label>
                                            </li>        
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10 offset-sm-2">
                    <span> Jumlah Data : {{$pegawai->total()}}</span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Pangkat</th>
                        <th>Jabatan</th>
                        <th>Masa Kerja</th>
                        <th>Pendidikan</th>
                        <th>Usia</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($pegawai)
                      @foreach($pegawai as $key => $value)
                            <tr>
                                <td align="center">{{$key +1}}</td>
                                <td>{{ $value->nip }}</td>
                                <td>
                                    {{ $value->namapeg }}
                                </td>
                                <td align="center">{{ $value->ngolru }}</td>
                                <td>{{ $value->njab }}<br/> {{$value->kode_eselon}}</td>
                                <td>{{$value->masath}} th {{$value->masabl}} bln</td>
                                <td>{{$value->stpu}} {{$value->npdum}}</td>
                                <td>{{$value->usiath}} th</td>
                                <td>
                                    <a href="{{route('pegawai.show', ['id' => $value->nip])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                    <a href="{{route('pegawai.edit', ['id' => $value->nip, 'page' => 'data-induk'])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
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
