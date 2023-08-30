<div>
     <div class="card card-body mb-2 {{$subPage == 'list' ? 'd-block' : 'd-none'}}" id="list">
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-sm btn-primary" id="btnTambah" wire:click="$emitSelf('tambah')">Tambah</button>
        </div>
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="20%">Nama Jabatan</th>
                        <th>Satker</th>
                        <th>TMT</th>
                        <th>No SK</th>
                        <th>Tgl SK</th>
                        <th>Eselon</th>
                        <th>Terakhir?</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_riwayat_jabatan)
                      @foreach($master_riwayat_jabatan as $key => $value)
                            <tr>
                                <td>{{ $value->njab }}</td>
                                <td>{{ $value->nopd->nama }}</td>
                                <td>{{ $value->tmtjab->format('d-m-Y') }}</td>
                                <td>{{ $value->nskjabat }}</td>
                                <td>{{ $value->tskjabat->format('d-m-Y') }}</td>
                                <td align="center">{{ $value->neselon->nama }}</td>
                                <td align="center">{{ $value->akhir == 1 ? 'Ya' : '' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn btn-xs btn-success" 
                                            wire:click="callModal('{{$value->njab}}', '{{$value->kjab}}', '{{$value->tmtjab}}'), '{{$value->filename}}'"
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
                    <label>Formulir Jabatan</label>
                    <button type="button" wire:click="$emitSelf('tutup')" class="btn btn-sm btn-primary">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </div>
            </div>
            @if($subPage == 'formulir')
                <div class="card-body">
                    @livewire('personel.data-induk.jabatan', [
                        'method' => $method, 
                        'next' => $next, 
                        'sid' => $sid ?? '',
                        'akhir' => 0,
                        'tmtjab' => $tmtjab,
                        'kjab' => $kjab,
                        'keselon' => $keselon,
                    ])
                </div>
            @endif
        </div>
    </div>
</div>