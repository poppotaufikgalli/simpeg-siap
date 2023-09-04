<div class="card card-body">
    <div class="row">
        <div class="col-sm-3">
            <div class="d-flex flex-column gap-3">
                <div class="list-group">
                    <button type="button" class="list-group-item list-group-item-action active" id="pendum-tab" data-bs-toggle="tab" data-bs-target="#pendum" type="button" role="tab" aria-controls="pendum" aria-selected="false">Pendidikan Umum</button>
                    @if($jenis_diklat)
                        @foreach($jenis_diklat as $key => $value)
                            @php($nlist = preg_replace("![^a-z0-9]+!i", "-", strtolower($value->nama)))
                            <button type="button" class="list-group-item list-group-item-action" id="{{$nlist}}-tab" data-bs-toggle="tab" data-bs-target="#{{$nlist}}" type="button" role="tab" aria-controls="{{$nlist}}" aria-selected="false">{{$value->id}}. {{$value->nama}}</button>
                        @endforeach
                    @endif
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
                @if($jenis_diklat)
                    @foreach($jenis_diklat as $key => $value)
                        @php($nlist = preg_replace("![^a-z0-9]+!i", "-", strtolower($value->nama)))
                        <div class="tab-pane" id="{{$nlist}}" role="tabpanel" aria-labelledby="{{$nlist}}-tab" tabindex="0">   
                             @livewire('pegawai.riwayat-pendidikan.diklat', [
                                'method' => $method, 
                                'next' => $next, 
                                'sid' => $id ?? '',
                                'jdiklat' => $value->id,
                            ])  
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @livewire('modal-upload-arsip', ['sid' => $id ?? ''])
    @livewire('modal-upload-arsip-personel', ['sid' => $id ?? ''])
    @include('partials/modalHapus')
    <script>
        document.addEventListener('tomSelectActive', function () {
            document.querySelectorAll('.select').forEach((el)=>{
                let settings = {};
                new TomSelect(el,settings);
            });
        });
    </script>
</div>