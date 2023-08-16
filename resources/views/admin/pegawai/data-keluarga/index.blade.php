<div class="card card-body">
    <div class="row">
        <div class="col-sm-3">
            <div class="d-flex flex-column gap-3">
                <div class="list-group">
                    <a href="#identitas-personel" class="list-group-item list-group-item-action active" id="identitas-personel-tab" data-bs-toggle="tab" data-bs-target="#identitas-personel" type="button" role="tab" aria-controls="identitas-personel" aria-selected="true">Suami / Istri</a>
                    <button type="button" class="list-group-item list-group-item-action" id="cpns-tab" data-bs-toggle="tab" data-bs-target="#cpns" type="button" role="tab" aria-controls="cpns" aria-selected="false">Anak</button>
                    <button type="button" class="list-group-item list-group-item-action" id="pns-tab" data-bs-toggle="tab" data-bs-target="#pns" type="button" role="tab" aria-controls="pns" aria-selected="false">Ayah</button>
                    <button type="button" class="list-group-item list-group-item-action" id="pangkat-terakhir-tab" data-bs-toggle="tab" data-bs-target="#pangkat-terakhir" type="button" role="tab" aria-controls="pangkat-terakhir" aria-selected="false">Ibu</button>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="tab-content">
                <div class="tab-pane active" id="identitas-personel" role="tabpanel" aria-labelledby="identitas-personel-tab" tabindex="0">
                    @livewire('pegawai.data-induk.identitas-pegawai', [
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