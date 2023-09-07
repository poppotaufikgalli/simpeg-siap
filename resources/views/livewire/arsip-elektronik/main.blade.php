<div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm display" id="tbListData" width="100%" cellspacing="0">
                <thead class="table-dark">
                    <tr>
                        <th width="20%">NIP</th>
                        <th>Nama</th>
                        <th width="5%">Jumlah Referensi</th>
                        <th width="5%">Jumlah Terupload</th>
                        <th>%</th>
                        <th width="30%">Progress</th>
                        <th width="5%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($master_pegawai)
                      @foreach($master_pegawai as $key => $value)
                            <tr>
                                <td align="center">{{ $value->nip }}</td>
                                <td>{{ $value->namapeg }}</td>
                                @php($jmlRef = $value->jml1 + $value->jml3)
                                <td align="center">{{$value->jml1 + $value->jml3}}</td>
                                @php($jmlArsip = $value->jml2 + $value->jml4)
                                <td align="center">{{$value->jml2 + $value->jml4}}</td>
                                @php($progres = ($jmlArsip / $jmlRef) *100)
                                <td align="center" width="5%">
                                    {{ $progres > 0 ? number_format($progres, 2) : $progres }} %
                                </td>
                                <td>
                                    <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-bar-striped" style="width: {{$progres}}%"></div>
                                    </div>
                                </td>
                                <td align="center">
                                    @php($nip = str_replace('/', '-', $value->nip))
                                    <a href="{{route('arsip_elektronik.show', ['id' => $nip, 'id_jenis_personel' => $id_jenis_personel])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                </td>   
                            </tr>
                      @endforeach
                    @endif
                </tbody>
            </table>
            
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            var ndatatable = document.getElementById("tbListData")
            if(ndatatable){
                const table = new DataTable('#tbListData', {
                    order: [[4, 'desc']],
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
                //table.context[0].nTHead.classList.add('d-none')
                //search by agolia
            }
        });
    </script>
</div>