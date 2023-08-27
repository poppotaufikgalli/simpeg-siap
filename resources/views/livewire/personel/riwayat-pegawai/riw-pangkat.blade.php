<div>
    <div class="card card-body mb-2 {{$subPage == 'list' ? 'd-block' : 'd-none'}}" id="list">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-sm btn-primary" id="btnTambah" wire:click="$emitSelf('tambah')">Tambah</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="20%">Pangkat/Gol</th>
                        <th>TMT</th>
                        <th>No SK</th>
                        <th>Tgl SK</th>
                        <th width="20%">Jenis Kenaikan Pangkat</th>
                        <th>Terakhir?</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_riwayat_pangkat)
                      @foreach($master_riwayat_pangkat as $key => $value)
                            <tr>
                                <td>{{ $value->npangkat->nama_pangkat }} ({{ $value->npangkat->nama }})</td>
                                <td>{{ $value->tmtpang->format('d-m-Y') }}</td>
                                <td>{{ $value->nskpang }}</td>
                                <td>{{ $value->tskpang->format('d-m-Y') }}</td>
                                <td>{{ $value->jnspangkat->nama ?? '' }}</td>
                                <td align="center">{{ $value->akhir == 1 ? 'Ya' : '' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
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
                    <label>Formulir Pangkat</label>
                    <button type="button" wire:click="$emitSelf('tutup')" class="btn btn-sm btn-primary">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </div>
            </div>
            @if($subPage == 'formulir')
                <div class="card-body">
                    @livewire('personel.data-induk.pangkat', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $sid ?? '',
                        'akhir' => 0,
                        'tmtpang' => $tmtpang,
                        'kgolru' => $kgolru,
                        'knpang' => $knpang,
                    ])
                </div>
            @endif
        </div>
    </div>
</div>