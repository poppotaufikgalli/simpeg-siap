<div wire:init="loadData">
    <li class="nav-item d-none d-md-block mb-0">
        <a class="nav-link pb-2 collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseArsipElektronik" aria-expanded="true" aria-controls="collapseArsipElektronik">
            <i class="bi bi-columns-gap"></i>
            <span>Arsip Elektronik</span>
        </a>
        
        <div id="collapseArsipElektronik" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-gradient bg-gradient-primary-to-secondary py-2 collapse-inner rounded m-0">
                @foreach($master_jenis_personel as $value)
                    @php($link =$value->nama)
                    @if(in_array($link, Session::get('konakses')))
                        <a class="collapse-item text-wrap text-gradient-light-to-primary" href="{{route('arsip_elektronik', ['id_jenis_personel' => $value->id_jenis_personel])}}">{{$value->nama}}</a>
                    @endif
                @endforeach
            </div>
        </div>
    </li>
</div>
