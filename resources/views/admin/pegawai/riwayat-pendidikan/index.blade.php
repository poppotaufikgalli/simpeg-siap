<div class="card card-body">
    <div class="row">
        <div class="col-sm-3">
            <div class="d-flex flex-column gap-3">
                <div class="list-group">
                    <button type="button" class="list-group-item list-group-item-action" id="pendum-tab" data-bs-toggle="tab" data-bs-target="#pendum" type="button" role="tab" aria-controls="pendum" aria-selected="false">Pendidikan Umum</button>
                    <button type="button" class="list-group-item list-group-item-action" id="cpns-tab" data-bs-toggle="tab" data-bs-target="#cpns" type="button" role="tab" aria-controls="cpns" aria-selected="false">Diklat Struktural</button>
                    <button type="button" class="list-group-item list-group-item-action" id="pns-tab" data-bs-toggle="tab" data-bs-target="#pns" type="button" role="tab" aria-controls="pns" aria-selected="false">Diklat Fungsional</button>
                    <button type="button" class="list-group-item list-group-item-action" id="pangkat-terakhir-tab" data-bs-toggle="tab" data-bs-target="#pangkat-terakhir" type="button" role="tab" aria-controls="pangkat-terakhir" aria-selected="false">Diklat Teknis</button>
                    <button type="button" class="list-group-item list-group-item-action" id="tempat-kerja-tab" data-bs-toggle="tab" data-bs-target="#tempat-kerja" type="button" role="tab" aria-controls="tempat-kerja" aria-selected="false">Penataran</button>
                    <button type="button" class="list-group-item list-group-item-action" id="pendidikan-terakhir-tab" data-bs-toggle="tab" data-bs-target="#pendidikan-terakhir" type="button" role="tab" aria-controls="pendidikan-terakhir" aria-selected="false">Seminar</button>
                    <button type="button" class="list-group-item list-group-item-action" id="jabatan-terakhir-tab" data-bs-toggle="tab" data-bs-target="#jabatan-terakhir" type="button" role="tab" aria-controls="jabatan-terakhir" aria-selected="false">Kursus</button>
                    <button type="button" class="list-group-item list-group-item-action" id="gaji-berkala-tab" data-bs-toggle="tab" data-bs-target="#gaji-berkala" type="button" role="tab" aria-controls="gaji-berkala" aria-selected="false">Diklat Pemerintahan</button>
                    <button type="button" class="list-group-item list-group-item-action" id="pengalaman-kerja-tab" data-bs-toggle="tab" data-bs-target="#pengalaman-kerja" type="button" role="tab" aria-controls="pengalaman-kerja" aria-selected="false">Karya Tulis/Makalah</button>
                    <button type="button" class="list-group-item list-group-item-action" id="pengalaman-kerja-tab" data-bs-toggle="tab" data-bs-target="#pengalaman-kerja" type="button" role="tab" aria-controls="pengalaman-kerja" aria-selected="false">Sertifikasi</button>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="tab-content">
                <div class="tab-pane active" id="pendum" role="tabpanel" aria-labelledby="pendum-tab" tabindex="0">
                    @livewire('pegawai.riwayat-pendidikan.pendum', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                    ])          
                </div>
                <div class="tab-pane" id="cpns" role="tabpanel" aria-labelledby="cpns-tab" tabindex="0">   
                     @livewire('pegawai.data-induk.cpns', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                    ])  
                </div>
                <div class="tab-pane" id="pns" role="tabpanel" aria-labelledby="pns-tab" tabindex="0">
                    @livewire('pegawai.data-induk.pns', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                    ])
                </div>
                <div class="tab-pane" id="pangkat-terakhir" role="tabpanel" aria-labelledby="pangkat-terakhir-tab" tabindex="0">
                    @livewire('pegawai.data-induk.pangkat', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                    ])
                </div>
                <!--<div class="tab-pane" id="pendidikan-terakhir" role="tabpanel" aria-labelledby="pendidikan-terakhir-tab" tabindex="0">...</div>
                <div class="tab-pane" id="tempat-kerja" role="tabpanel" aria-labelledby="tempat-kerja-tab" tabindex="0">...</div>-->
                <div class="tab-pane" id="jabatan-terakhir" role="tabpanel" aria-labelledby="jabatan-terakhir-tab" tabindex="0">
                    @livewire('pegawai.data-induk.jabatan', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                    ])
                </div>
                <div class="tab-pane" id="gaji-berkala" role="tabpanel" aria-labelledby="gaji-berkala-tab" tabindex="0">
                    @livewire('pegawai.data-induk.gaji-berkala', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                    ])
                </div>
                <!--<div class="tab-pane" id="pengalaman-kerja" role="tabpanel" aria-labelledby="pengalaman-kerja-tab" tabindex="0">...</div>-->
            </div>
            
        </div>
    </div>
</div>