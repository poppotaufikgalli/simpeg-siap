<div>
    <form wire:submit.prevent="{{$next}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-3 {{$method != 'create' ? 'd-none' : ''}}" wire:ignore>
                <div class="card card-body">
                    <img id="profile_picture" class="img-profile col" style="min-height: 200px" src="{{asset($profile_image)}}">
                    <input type="file" id="file_bmp" wire:model="file_bmp" accept="image/png,image/jpg" class="d-none">
                    <label class="btn btn-sm btn-primary mt-2" for="file_bmp">Upload / Ganti Gambar</label>
                </div>
            </div>
            <div class="col">
                <div class="card card-body">
                    <div class="mb-2 row">
                        <div class="col-sm-10 offset-sm-2">
                            <input type="hidden" wire:model="sid" class="form-control">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="nip" class="col-sm-2 col-form-label">NIP/NRP</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="nip" wire:model="dataset.nip" oninput="this.value = this.value.replace(/[^a-zA-Z0-9./]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="18" {{$sid != '' ? 'disabled' : 'required'}}>
                        </div>
                        <div class="col-sm-6">
                            @if(in_array($method, ['edit']))
                                <div class="d-flex align-content-start flex-wrap gap-1">
                                    @if($master_jenis_arsip)
                                        @foreach($master_jenis_arsip as $value)
                                            <button type="button" class="btn btn-sm btn-primary" 
                                                wire:click="$emitTo('modal-upload-arsip', 'openModal','{{route('arsip_elektronik.store', ['page' => $value->nama])}}', '{{$value}}', true, true)"
                                            >
                                                {{$value->nama}} <i class="bi bi-cloud-upload"></i> 
                                            </button>
                                        @endforeach
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    <hr/>
                    <div class="mb-2 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" wire:model="dataset.nama" required>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="gldepan" class="col-sm-2 col-form-label">Gelar</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" class="form-control" id="gldepan" wire:model="dataset.gldepan" placeholder="Depan">
                                <input type="text" class="form-control" id="glblk" wire:model="dataset.glblk" placeholder="Belakang">
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="ktlahir" class="col-sm-2 col-form-label">Lahir</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" class="form-control" id="ktlahir" wire:model="dataset.ktlahir" required placeholder="Tempat Lahir">
                                <input type="date" class="form-control" id="tlahir" wire:model="dataset.tlahir" required placeholder="Tanggal Lahir">
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="kjkel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="kjkel" wire:model="dataset.kjkel">
                                <option value="" selected>Pilih Jenis Kelamin</option>
                                <option value="1">Laki-laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </div>
                        <label for="kagama" class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="kagama" wire:model="dataset.kagama">
                                <option value="" selected>Pilih Agama</option>
                                @if($master_agama)
                                    @foreach($master_agama as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="kgoldar" class="col-sm-2 col-form-label d-none">Gol. Darah</label>
                        <div class="col-sm-4 d-none">
                            <select class="form-control" id="kgoldar" wire:model="dataset.kgoldar">
                                <option value="" selected>Pilih Golongan Darah</option>
                                @if($master_goldar)
                                    @foreach($master_goldar as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <label for="kskawin" class="col-sm-2 col-form-label">Perkawinan</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="kskawin" wire:model="dataset.kskawin">
                                <option value="" selected>Pilih Status Perkawinan</option>
                                @if($master_kawin)
                                    @foreach($master_kawin as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="aljalan" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" id="aljalan" wire:model="dataset.aljalan"></textarea>
                        </div>
                    </div>
                    <div class="mb-2 row gy-2">
                        <label for="aldes" class="col-sm-2 col-form-label">Kelurahan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="aldes" wire:model="dataset.aldes">
                        </div>
                        <label for="alkec" class="col-sm-2 col-form-label">Kecamatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alkec" wire:model="dataset.alkec">
                        </div>
                        <label for="alkab" class="col-sm-2 col-form-label">Kabupaten</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alkab" wire:model="dataset.alkab">
                        </div>
                        <label for="alprop" class="col-sm-2 col-form-label">Provinsi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alprop" wire:model="dataset.alprop">
                        </div>
                    </div>
                    <div class="mb-2 row gy-2">
                        <label for="stts_rumah" class="col-sm-2 col-form-label">Status Rumah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="stts_rumah" wire:model="dataset.stts_rumah" placeholder="Pribadi / Dinas / Kontrak">
                        </div>
                    </div>
                    <div class="mb-2 row gy-2 d-none">
                        <label for="alrt" class="col-sm-2 col-form-label">RT/RW</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="text" class="form-control" id="alrt" wire:model="dataset.alrt" placeholder="RT">
                                <input type="text" class="form-control" id="alrw" wire:model="dataset.alrw" placeholder="RW">
                            </div>
                        </div>
                        <label for="kpos" class="col-sm-2 col-form-label">Kode Pos</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="kpos" wire:model="dataset.kpos">
                        </div>
                        <label for="alkoprop" class="col-sm-2 col-form-label">Provinsi</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="alkoprop" wire:model="dataset.alkoprop" wire:change="changeProv($event.target.value)">
                                <option value="0" selected>Pilih Provinsi</option>
                                @if($master_provinsi)
                                    @foreach($master_provinsi as $key => $value)
                                        <option value="{{$value->kprov}}">[{{$value->kprov}}] {{$value->nwil}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <label for="alkokab" class="col-sm-2 col-form-label">Kab/ Kota</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="alkokab" wire:model="dataset.alkokab" wire:change="changeKab($event.target.value)">
                                <option value="" selected>Pilih Kabupaten/Kota</option>
                                @if($master_kab_kota)
                                    @foreach($master_kab_kota as $key => $value)
                                        <option value="{{$value->kkab}}">[{{$value->kkab}}] {{$value->nwil}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <label for="alkokec" class="col-sm-2 col-form-label">Kecamatan</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="alkokec" wire:model="dataset.alkokec" wire:change="changeKec($event.target.value)">
                                <option value="" selected>Pilih Kecamatan</option>
                                @if($master_kec)
                                    @foreach($master_kec as $key => $value)
                                        <option value="{{$value->kkec}}">[{{$value->kkec}}] {{$value->nwil}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <label for="alkodes" class="col-sm-2 col-form-label text-truncate">Kelurahan/ Desa</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="alkodes" wire:model="dataset.alkodes">
                                <option value="" selected>Pilih Desa/Kelurahan</option>
                                @if($master_kel)
                                    @foreach($master_kel as $key => $value)
                                        @php($kode = $value->tkdesa.$value->kdesa)
                                        <option value="{{$kode}}">[{{$kode}}] {{$value->nwil}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control" id="email" wire:model="dataset.email" placeholder="@">
                        </div>
                        <label for="altelp" class="col-sm-2 col-form-label">Telp</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="altelp" wire:model="dataset.altelp" placeholder="Rumah/HP">
                        </div>
                    </div>
                    <hr/>
                    <div class="mb-2 row">
                        <label for="korps" class="col-sm-2 col-form-label">Korps</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="id_korps" wire:model="dataset.id_korps" wire:change="changeKorps($event.target.value)">
                                <option value="" selected>Pilih Korps</option>
                                @if($master_korps)
                                    @foreach($master_korps as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="kejuruan" class="col-sm-2 col-form-label">Kejuruan</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="id_kejuruan_korps" wire:model="dataset.id_kejuruan_korps">
                                <option value="" selected>Pilih Kejuruan Korps</option>
                                @if($master_kejuruan_korps)
                                    @foreach($master_kejuruan_korps as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}} ({{$value->singkatan}})</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="kduduk" class="col-sm-2 col-form-label">Kedudukan Kepegawaian</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="kduduk" wire:model="dataset.kduduk">
                                <option value="" selected>Pilih Kedudukan Kepegawaian</option>
                                @if($master_kedudukan_pegawai)
                                    @foreach($master_kedudukan_pegawai as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-2 row">
                        <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="nik" wire:model="dataset.nik" maxlength="18">
                        </div>
                        <label for="npwp" class="col-sm-2 col-form-label">NPWP</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="npwp" wire:model="dataset.npwp">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="nkarpeg" class="col-sm-2 col-form-label">No. Karpeg</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="nkarpeg" wire:model="dataset.nkarpeg">
                        </div>
                        <label for="nkaris_su" class="col-sm-2 col-form-label text-truncate">No. Karis/ Karsu</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="nkaris_su" wire:model="dataset.nkaris_su">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="naskes" class="col-sm-2 col-form-label text-truncate">No. BPJS Kesehatan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="naskes" wire:model="dataset.naskes">
                        </div>
                        <label for="ntaspen" class="col-sm-2 col-form-label">No. Taspen</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="ntaspen" wire:model="dataset.ntaspen">
                        </div>
                    </div>
                    <div class="mb-2 row gy-2 d-none">
                        <label for="stat_kpe" class="col-sm-2 col-form-label">Status KPE</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="stat_kpe" wire:model="dataset.stat_kpe">
                                <option value="" selected>Pilih Status KPE</option>
                                @if($master_kpe)
                                    @foreach($master_kpe as $key => $value)
                                        <option value="{{$value->kkpe}}">{{$value->nkpe}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <label for="tgl_kpe" class="col-sm-2 col-form-label">Tanggal KPE</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="tgl_kpe" wire:model="dataset.tgl_kpe">
                        </div>
                        <label for="thn_pendataan" class="col-sm-2 col-form-label">Th. Pendataan KPE</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="thn_pendataan" wire:model="dataset.thn_pendataan">
                        </div>
                    </div>
                </div>
                <div class="my-2">
                    @if(in_array($method, ['create']))
                        <button class="btn btn-sm btn-primary">Simpan</button>
                    @endif
                    @if(in_array($method, ['edit']))
                        <button class="btn btn-sm btn-primary">Update</button>
                    @endif
                </div>
            </div>
        </div>
    </form>
    @if(in_array($method, ['edit']))
        <div class="card card-body mt-2 d-none">
            <div class="row g-2">
                @if($master_jenis_arsip)
                    @foreach($master_jenis_arsip as $value)
                        <div class="col-sm-3 d-grid g-2">
                            <button type="button" class="btn btn-block btn-primary d-flex justify-content-between" 
                                wire:click="$emitTo('modal-upload-arsip', 'openModal','{{route('arsip_elektronik.store', ['page' => $value->nama])}}', '{{$value}}', true, true)"
                            >
                                {{$value->nama}} <i class="bi bi-cloud-upload"></i> 
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endif
    <script>
        document.addEventListener('livewire:load', function () {
            var profile_picture = document.getElementById('profile_picture');
            document.getElementById('file_bmp').addEventListener('change', function(e){
                const file = e.target.files[0];
                if (file) {
                    profile_picture.src = URL.createObjectURL(file)
                }
            })
        });
    </script>
</div>