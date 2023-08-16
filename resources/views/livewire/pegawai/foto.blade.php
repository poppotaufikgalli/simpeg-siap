<div>
    <div class="d-flex flex-column">
        @if($displayPhoto)
            <img class="img-profile col" style="min-height: 200px" src="{{url('storage/photo/'.$displayPhoto.'?'.rand())}}">
        @else
            <img class="img-profile col" style="min-height: 200px" src="{{asset('assets/img/undraw_profile.svg')}}">
        @endif

        @if($sid)
            <label class="btn btn-sm btn-primary mt-2" for="photo">Upload / Ganti Gambar</label>
        @else
            <label class="btn btn-sm btn-secondary mt-2">Silahkan Masukkan data terlebih dahulu</label>
        @endif
        <input type="file" id="photo" wire:model.lazy="photo" accept="image/png,image/jpg" class="d-none">
    </div>
</div>
