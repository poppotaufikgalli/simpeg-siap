<div class="card card-body">
    <div class="row">
        <div class="col-sm-3">
            <div class="d-flex flex-column gap-3">
                @livewire('personel.foto', [
                    'sid' => $id ?? '',
                ])
                <div class="list-group">
                    <button type="button" class="list-group-item list-group-item-action active" id="identitas-personel-tab" data-bs-toggle="tab" data-bs-target="#identitas-personel" type="button" role="tab" aria-controls="identitas-personel" aria-selected="true">Identitas Personel</button>
                    @if($id_jenis_personel == 1)
                    <button type="button" class="list-group-item list-group-item-action" id="cpns-tab" data-bs-toggle="tab" data-bs-target="#cpns" type="button" role="tab" aria-controls="cpns" aria-selected="false">CPNS</button>
                    <button type="button" class="list-group-item list-group-item-action" id="pns-tab" data-bs-toggle="tab" data-bs-target="#pns" type="button" role="tab" aria-controls="pns" aria-selected="false">PNS</button>
                    @endif
                    <button type="button" class="list-group-item list-group-item-action" id="pangkat-terakhir-tab" data-bs-toggle="tab" data-bs-target="#pangkat-terakhir" type="button" role="tab" aria-controls="pangkat-terakhir" aria-selected="false">Pangkat Terakhir</button>
                    <!--<button type="button" class="list-group-item list-group-item-action" id="pendidikan-terakhir-tab" data-bs-toggle="tab" data-bs-target="#pendidikan-terakhir" type="button" role="tab" aria-controls="pendidikan-terakhir" aria-selected="false">Pendidikan Terakhir</button>
                    <button type="button" class="list-group-item list-group-item-action" id="tempat-kerja-tab" data-bs-toggle="tab" data-bs-target="#tempat-kerja" type="button" role="tab" aria-controls="tempat-kerja" aria-selected="false">Tempat Kerja Terakhir</button>-->
                    <button type="button" class="list-group-item list-group-item-action" id="jabatan-terakhir-tab" data-bs-toggle="tab" data-bs-target="#jabatan-terakhir" type="button" role="tab" aria-controls="jabatan-terakhir" aria-selected="false">Jabatan Terakhir</button>
                    <!--<button type="button" class="list-group-item list-group-item-action" id="gaji-berkala-tab" data-bs-toggle="tab" data-bs-target="#gaji-berkala" type="button" role="tab" aria-controls="gaji-berkala" aria-selected="false">Gaji Berkala Terakhir</button>-->
                    <!--<button type="button" class="list-group-item list-group-item-action" id="pengalaman-kerja-tab" data-bs-toggle="tab" data-bs-target="#pengalaman-kerja" type="button" role="tab" aria-controls="pengalaman-kerja" aria-selected="false">Pengalaman Kerja</button>-->
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="identitas-personel" role="tabpanel" aria-labelledby="identitas-personel-tab" tabindex="0">
                    @livewire('personel.data-induk.profil', [
                        'method' => $method, 
                        'next' => $next, 
                        'dataset' => $dataset ?? '',
                        'sid' => $id ?? '',
                        'id_jenis_personel' => $id_jenis_personel,
                    ])          
                </div>
                <div class="tab-pane fade" id="cpns" role="tabpanel" aria-labelledby="cpns-tab" tabindex="0">   
                     @livewire('personel.data-induk.cpns', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                        'id_jenis_personel' => $id_jenis_personel,
                    ])  
                </div>
                <div class="tab-pane fade" id="pns" role="tabpanel" aria-labelledby="pns-tab" tabindex="0">
                    @livewire('personel.data-induk.pns', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                        'id_jenis_personel' => $id_jenis_personel,
                    ])
                </div>
                <div class="tab-pane fade" id="pangkat-terakhir" role="tabpanel" aria-labelledby="pangkat-terakhir-tab" tabindex="0">
                    @livewire('personel.data-induk.pangkat', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                        'akhir' => 1,
                        'id_jenis_personel' => $id_jenis_personel,
                    ])
                </div>
                <!--<div class="tab-pane" id="pendidikan-terakhir" role="tabpanel" aria-labelledby="pendidikan-terakhir-tab" tabindex="0">...</div>
                <div class="tab-pane" id="tempat-kerja" role="tabpanel" aria-labelledby="tempat-kerja-tab" tabindex="0">...</div>-->
                <div class="tab-pane fade" id="jabatan-terakhir" role="tabpanel" aria-labelledby="jabatan-terakhir-tab" tabindex="0">
                    @livewire('personel.data-induk.jabatan', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                        'akhir' => 1,
                        'id_jenis_personel' => $id_jenis_personel,
                    ])
                </div>
                <div class="tab-pane fade" id="gaji-berkala" role="tabpanel" aria-labelledby="gaji-berkala-tab" tabindex="0">
                    @livewire('personel.data-induk.gaji-berkala', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                        'akhir' => 1,
                    ])
                </div>
                <!--<div class="tab-pane" id="pengalaman-kerja" rosle="tabpanel" aria-labelledby="pengalaman-kerja-tab" tabindex="0">...</div>-->
            </div>
            
        </div>
    </div>
    @livewire('modal-upload-arsip', ['sid' => $id ?? ''])
    @livewire('modal-upload-arsip-personel', ['sid' => $id ?? ''])
    @include('partials/modalHapus')
</div>