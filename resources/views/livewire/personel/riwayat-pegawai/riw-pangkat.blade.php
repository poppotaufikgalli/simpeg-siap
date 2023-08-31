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
                                <td>
                                    {{ $value->npangkat->nama_pangkat }}
                                    @if($value->npangkat->nama != "")
                                        ({{ $value->npangkat->nama }})
                                    @endif
                                </td>
                                <td>{{ $value->tmtpang->format('d-m-Y') }}</td>
                                <td>{{ $value->nskpang }}</td>
                                <td>{{ $value->tskpang->format('d-m-Y') }}</td>
                                <td>{{ $value->jnspangkat->nama ?? '' }}</td>
                                <td align="center">{{ $value->akhir == 1 ? 'Ya' : '' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn btn-xs btn-success" 
                                            wire:click="callModal('{{$value->npangkat->nama}}', '{{$value->kgolru}}', '{{$value->tmtpang}}'), '{{$value->filename}}'"
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
                    @if($master_pns)
                         <tr>
                            <td>
                                PNS - {{ $master_pns->npangkat->nama_pangkat }}
                                @if($master_pns->npangkat->nama != "")
                                    ({{ $master_pns->npangkat->nama }})
                                @endif
                            </td>
                            <td>{{ $master_pns->tmtpns->format('d-m-Y') }}</td>
                            <td>{{ $master_pns->skpns }}</td>
                            <td>{{ $master_pns->tskpns->format('d-m-Y') }}</td>
                            <td>Pengangkatan PNS</td>
                            <td align="center">&nbsp;</td>
                            <td>&nbsp;</td>   
                        </tr>
                    @endif
                    @if($master_cpns)
                         <tr>
                            <td>
                                CPNS -
                                @if($master_cpns->npangkat->nama != "")
                                    ({{ $master_cpns->npangkat->nama }})
                                @endif
                            </td>
                            <td>{{ $master_cpns->tmtcpns->format('d-m-Y') }}</td>
                            <td>{{ $master_cpns->skcpns }}</td>
                            <td>{{ $master_cpns->tskcpns->format('d-m-Y') }}</td>
                            <td>Pengangkatan CPNS</td>
                            <td align="center">&nbsp;</td>
                            <td>&nbsp;</td>   
                        </tr>
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
                        'id_jenis_personel' => $id_jenis_personel,
                        'id_korps' => $id_korps,
                    ])
                </div>
            @endif
        </div>
    </div>
</div>