<div wire:init="selectSubOpd">
    <div class="row g-2 mb-2">
        <label class="col-sm-2 col-form-label" for="id_opd">Unit Kerja Utama</label>
        <div class="col-sm-10">
            <select class="form-select" id="id_opd" name="id_opd" wire:model="filter.id_opd" wire:change="change($event.target.value)">
                <option value="" selected>Semua</option>
                @if($data)
                    @foreach($data as $value)
                        @if(isset($filter['id_opd']) && $value->id_opd == $filter['id_opd'])
                            <option value="{{$value->id_opd}}" selected>{{$value->nama}}</option>
                        @else
                            <option value="{{$value->id_opd}}">{{$value->nama}}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>                
    </div>
    <div class="row g-2 mb-2">
        <label class="col-sm-2 col-form-label" for="id_sub_opd">Sub Unit Kerja</label>  
        <div class="col-sm-10">
            <select class="form-select" id="id_sub_opd" name="id_sub_opd" wire:model="filter.id_sub_opd">
                <option value="" selected>Semua</option>
                @if($subdata)
                    @foreach($subdata as $value)
                        @if(isset($filter['id_sub_opd']) &&$value->id_opd == $filter['id_sub_opd'])
                            <option value="{{$value->id_opd}}" selected>{{$value->nama}}</option>
                        @else
                            <option value="{{$value->id_opd}}">{{$value->nama}}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>                
    </div>
    <div class="row g-2 mb-2">
        <label class="col-sm-2 col-form-label" for="id_jenis_jabatan">Jenis Jabatan</label>
        <div class="col-sm-5">
            <select class="form-select" id="id_jenis_jabatan" name="id_jenis_jabatan" wire:model="filter.id_jenis_jabatan" wire:change="changeJnsJab($event.target.value)">
                <option value="" selected>Semua</option>
                @if($master_jenis_jabatan)
                    @foreach($master_jenis_jabatan as $value)
                        @if(isset($filter['id_jenis_jabatan']) && $value->id_jenis_jabatan == $filter['id_jenis_jabatan'])
                            <option value="{{$value->id_jenis_jabatan}}" selected>{{$value->nama_jenis_jabatan}}</option>
                        @else
                            <option value="{{$value->id_jenis_jabatan}}">{{$value->nama_jenis_jabatan}}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>                
        <label class="col-sm-1 col-form-label" for="id_eselon">Eselon</label>  
        <div class="col-sm-4">
            <select class="form-select" id="id_eselon" name="id_eselon" wire:model="filter.id_eselon">
                <option value="" selected>Semua</option>
                @if($subdataeselon)
                    @foreach($subdataeselon as $value)
                        @if(isset($filter['id_eselon']) && $value->id_eselon == $filter['id_eselon'])
                            <option value="{{$value->id_eselon}}" selected>{{$value->nama}}</option>
                        @else
                            <option value="{{$value->id_eselon}}">{{$value->nama}}</option>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <hr/>
    <div class="row g-2 mb-2">  
        <label class="col-sm-2 col-form-label" for="nama">Nama</label>
        <div class="col-sm-5">
            <input type="search" class="form-control" id="nama" name="nama" placeholder="Cari dengan :Nama" wire:model="filter.nama">
        </div>
        <label class="col-sm-1 col-form-label" for="nip">NIP</label>
        <div class="col-sm-4">
            <input type="search" class="form-control" id="nip" name="nip" placeholder="Cari dengan :NIP" wire:model="filter.nip">
        </div>
    </div>
    <div class="row g-2">
        <div class="col-sm-10 offset-sm-2">
            <a class="btn btn-info text-truncate" data-bs-toggle="collapse" href="#collapseKriteria" role="button" aria-expanded="false" aria-controls="collapseKriteria">
                * Status dan Jenis Kepegawaian
            </a>
        </div>
        <div class="col-sm-10 offset-sm-2">
            <div class="collapse mb-1" id="collapseKriteria">
                <div class="row">
                    <div class="col">
                        <ul class="list-group small">
                            <li class="list-group-item bg-info">
                                <div class="fw-bold">Status</div>
                            </li>
                            @if($master_status_pegawai)
                                @foreach($master_status_pegawai as $value)
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="{{$value->kstatus}}" wire:model="kstatus.{{$value->kstatus}}" id="kstatus-{{$value->kstatus}}">
                                        <label class="form-check-label stretched-link" for="kstatus-{{$value->kstatus}}">{{$value->nama}}</label>
                                    </li>        
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="col">
                        @if($filter['kjpeg'] == 0)
                        <ul class="list-group small">
                            <li class="list-group-item bg-info">
                                <div class="fw-bold">Jenis Personel</div>
                            </li>
                            @if($master_jenis_pegawai)
                                @foreach($master_jenis_pegawai as $value)
                                    @php($checked = ($filter['kjpeg'] == 0 || $filter['kjpeg'] == $value->kjpeg) ? 'checked' : '' )
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="{{$value->kjpeg}}" name="kjpeg[]" id="kjpeg-{{$value->kjpeg}}" {{$checked}}>
                                        <label class="form-check-label stretched-link" for="kjpeg-{{$value->kjpeg}}">{{$value->njpeg}}</label>
                                    </li>        
                                @endforeach
                            @endif
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-10 offset-sm-2">
            <div class="d-flex justify-content-start align-items-center">
                <div class="btn-group me-3">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
                <span> Jumlah Data : {{$total}}</span>
            </div>
        </div>
    </div>
</div>
