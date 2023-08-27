<div class="card card-body">
    <div class="row">
        <div class="col-sm-3">
            <div class="d-flex flex-column gap-3">
                <div class="list-group">
                    @if($jenis_keluarga)
                        @foreach($jenis_keluarga as $key => $value)
                            @php($nlist = preg_replace("![^a-z0-9]+!i", "-", strtolower($value->nama)))
                            <button type="button" class="list-group-item list-group-item-action {{$key == 0 ? 'active': ''}}" id="{{$nlist}}-tab" data-bs-toggle="tab" data-bs-target="#{{$nlist}}" type="button" role="tab" aria-controls="{{$nlist}}" aria-selected="false">{{$value->id}}. {{$value->nama}}</button>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="tab-content">
                 @if($jenis_keluarga)
                    @foreach($jenis_keluarga as $key => $value)
                        @php($nlist = preg_replace("![^a-z0-9]+!i", "-", strtolower($value->nama)))
                        <div class="tab-pane {{$key == 0 ? 'active': ''}}" id="{{$nlist}}" role="tabpanel" aria-labelledby="{{$nlist}}-tab" tabindex="{{$key}}">
                            @livewire('pegawai.data-keluarga.keluarga', [
                                'method' => $method, 
                                'next' => $next, 
                                'sid' => $id ?? '',
                                'jkeluarga' => $value->id
                            ])          
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @livewire('modal-upload-arsip', ['sid' => $id ?? ''])
    @include('partials/modalHapus')
</div>