<div wire:init="loadData">
    <li class="nav-item d-none d-md-block mb-0">
        <a class="nav-link pb-2 collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePersonel" aria-expanded="true" aria-controls="collapsePersonel">
            <i class="bi bi-person-square"></i>
            <span>Personel</span>
        </a>
        <div id="collapsePersonel" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-gradient bg-gradient-primary-to-secondary py-2 collapse-inner rounded m-0">
                @foreach($master_jenis_personel as $value)
                    <a class="collapse-item text-wrap text-gradient-light-to-primary" href="{{route('personel', ['id_jenis_personel' => $value->id_jenis_personel])}}">{{$value->nama}}</a>
                @endforeach
            </div>
        </div>
    </li>
</div>
