<div>
    <div class="card card-body mb-2 {{$subPage == 'list' ? 'd-block' : 'd-none'}}" id="list">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-sm btn-primary" id="btnTambah" wire:click="$emitSelf('tambah')">Tambah</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="20%">Tahun</th>
                        <th>Priode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_riwayat_dp3)
                        @foreach($master_riwayat_dp3 as $key => $value)
                            <tr>
                                <td align="center">{{ $value->thnilai }}</td>
                                <td align="center">{{ $value->mulai->format('d-m-Y') }} s/d {{ $value->selesai->format('d-m-Y') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn btn-xs btn-success" 
                                            wire:click="callModal('{{$value->thnilai}}', '{{$value->mulai}}', '{{$value->selesai}}'), '{{$value->filename}}'"
                                        >
                                            <i class="bi bi-cloud-upload"></i> 
                                        </button>
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
                    <label>Formulir DP3 / P2KP</label>
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
                        <div class="mb-2 row">
                            <label for="thnilai" class="col-sm-2 col-form-label text-truncate">Tahun Penilaian</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="thnilai" wire:model="dataset.thnilai" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="4" required>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <label for="mulai" class="col-sm-2 col-form-label text-truncate">Priode Penilaian</label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input type="date" class="form-control" id="mulai" wire:model="dataset.mulai" required>
                                    <span class="input-group-text">Sampai</span>
                                    <input type="date" class="form-control" id="selesai" wire:model="dataset.selesai" required>
                                </div>
                            </div>
                            <label for="ntotal" class="col-sm-2 offset-sm-1 col-form-label text-truncate">Total Nilai (Angka)</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="ntotal" wire:model="dataset.ntotal" placeholder="jika ada" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                            </div>
                        </div>
                        <hr>
                        <div class="mb-2 row gy-2">
                            <label for="capaian_kinerja_org" class="col-sm-2 col-form-label">Capaian Kinerja Organisasi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="capaian_kinerja_org" wire:model="dataset.capaian_kinerja_org"></textarea>
                            </div>
                            <label for="prediket_kinerja_peg" class="col-sm-2 col-form-label">Predikat Kinerja Pegawai</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="prediket_kinerja_peg" wire:model="dataset.prediket_kinerja_peg"></textarea>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-sm-10 offset-sm-2">
                                <button class="btn btn-sm btn-primary">Simpan {{$next}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>