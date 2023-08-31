<div class="card card-body">
    <div class="row">
        <div class="col-sm-3">
            <div class="d-flex flex-column gap-3">
                <div class="list-group">
                    <button type="button" class="list-group-item list-group-item-action active" id="riw-pangkat-tab" data-bs-toggle="tab" data-bs-target="#riw-pangkat" type="button" role="tab" aria-controls="riw-pangkat" aria-selected="true">Pangkat</button>
                    <button type="button" class="list-group-item list-group-item-action" id="riw-jabatan-tab" data-bs-toggle="tab" data-bs-target="#riw-jabatan" type="button" role="tab" aria-controls="riw-jabatan" aria-selected="false">Jabatan</button>
                    <button type="button" class="list-group-item list-group-item-action" id="riw-penghargaan-tab" data-bs-toggle="tab" data-bs-target="#riw-penghargaan" type="button" role="tab" aria-controls="riw-penghargaan" aria-selected="false">Penghargaan/ Tanda Jasa</button>
                    <button type="button" class="list-group-item list-group-item-action" id="riw-dp3-tab" data-bs-toggle="tab" data-bs-target="#riw-dp3" type="button" role="tab" aria-controls="riw-dp3" aria-selected="false">DP3 / P2KP / SKP</button>
                    <button type="button" class="list-group-item list-group-item-action" id="riw-tumlar-tab" data-bs-toggle="tab" data-bs-target="#riw-tumlar" type="button" role="tab" aria-controls="riw-tumlar" aria-selected="false">Pencantuman Gelar</button>
                    <button type="button" class="list-group-item list-group-item-action" id="riw-hukuman-disiplin-tab" data-bs-toggle="tab" data-bs-target="#riw-hukuman-disiplin" type="button" role="tab" aria-controls="riw-hukuman-disiplin" aria-selected="false">Hukuman Disiplin</button>
                    <button type="button" class="list-group-item list-group-item-action" id="riw-cuti-tab" data-bs-toggle="tab" data-bs-target="#riw-cuti" type="button" role="tab" aria-controls="riw-cuti" aria-selected="false">Cuti</button>
                    <button type="button" class="list-group-item list-group-item-action" id="riw-organisasi-tab" data-bs-toggle="tab" data-bs-target="#riw-organisasi" type="button" role="tab" aria-controls="riw-organisasi" aria-selected="false">Organisasi</button>
                    <!--<button type="button" class="list-group-item list-group-item-action" id="riw-kgb-tab" data-bs-toggle="tab" data-bs-target="#riw-kgb" type="button" role="tab" aria-controls="riw-kgb" aria-selected="false">Kenaikan Gaji Berkala</button>-->
                    <!--<button type="button" class="list-group-item list-group-item-action" id="gaji-berkala-tab" data-bs-toggle="tab" data-bs-target="#gaji-berkala" type="button" role="tab" aria-controls="gaji-berkala" aria-selected="false">Tugas Luar Negeri</button>
                    <button type="button" class="list-group-item list-group-item-action" id="pengalaman-kerja-tab" data-bs-toggle="tab" data-bs-target="#pengalaman-kerja" type="button" role="tab" aria-controls="pengalaman-kerja" aria-selected="false">Bahasa</button>
                    <button type="button" class="list-group-item list-group-item-action" id="pengalaman-kerja-tab" data-bs-toggle="tab" data-bs-target="#pengalaman-kerja" type="button" role="tab" aria-controls="pengalaman-kerja" aria-selected="false">Pindah Instansi</button>-->
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="tab-content">
                <div class="tab-pane active" id="riw-pangkat" role="tabpanel" aria-labelledby="riw-pangkat-tab" tabindex="0">
                    @livewire('personel.riwayat-pegawai.riw-pangkat', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                        'id_jenis_personel' => $id_jenis_personel,
                        'id_korps' => $id_korps,
                    ])          
                </div>
                <div class="tab-pane" id="riw-jabatan" role="tabpanel" aria-labelledby="riw-jabatan-tab" tabindex="0">   
                     @livewire('personel.riwayat-pegawai.riw-jabatan', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                    ])  
                </div>
                <div class="tab-pane" id="riw-penghargaan" role="tabpanel" aria-labelledby="riw-penghargaan-tab" tabindex="0">
                    @livewire('pegawai.riwayat-pegawai.riw-penghargaan', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                    ])
                </div>
                <div class="tab-pane" id="riw-dp3" role="tabpanel" aria-labelledby="riw-dp3-tab" tabindex="0">
                    @livewire('pegawai.riwayat-pegawai.riw-dp3', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                    ])
                </div>
                <div class="tab-pane" id="riw-tumlar" role="tabpanel" aria-labelledby="riw-tumlar-tab" tabindex="0">
                    @livewire('pegawai.riwayat-pegawai.riw-tumlar', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                    ])
                </div>
                <div class="tab-pane" id="riw-hukuman-disiplin" role="tabpanel" aria-labelledby="riw-hukuman-disiplin-tab" tabindex="0">
                    @livewire('pegawai.riwayat-pegawai.riw-hukuman-disiplin', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                    ])
                </div>
                <div class="tab-pane" id="riw-cuti" role="tabpanel" aria-labelledby="riw-cuti-tab" tabindex="0">
                    @livewire('pegawai.riwayat-pegawai.riw-cuti', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                    ])
                </div>
                <div class="tab-pane" id="riw-organisasi" role="tabpanel" aria-labelledby="riw-organisasi-tab" tabindex="0">
                    @livewire('pegawai.riwayat-pegawai.riw-organisasi', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                    ])
                </div>
                <div class="tab-pane" id="riw-kgb" role="tabpanel" aria-labelledby="riw-kgb-tab" tabindex="0">
                    @livewire('personel.riwayat-pegawai.riw-kgb', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $id ?? '',
                    ])
                </div>
                <!--<div class="tab-pane" id="pengalaman-kerja" role="tabpanel" aria-labelledby="pengalaman-kerja-tab" tabindex="0">...</div>-->
            </div>
        </div>
    </div>
    @livewire('modal-upload-arsip', ['sid' => $id ?? ''])
    @livewire('modal-upload-arsip-personel', ['sid' => $id ?? ''])
    @include('partials/modalHapus')
</div>