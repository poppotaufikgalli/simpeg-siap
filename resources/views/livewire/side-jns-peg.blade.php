<div>
    <div id="collapsePersonel" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-gradient bg-gradient-primary-to-secondary py-2 collapse-inner rounded m-0">
            @foreach($data as $value)
                <a class="collapse-item text-wrap text-gradient-light-to-primary" href="{{route('pegawai', ['kjpeg' => $value->kjpeg])}}">{{$value->njpeg}}</a>
            @endforeach
        </div>
    </div>
</div>
