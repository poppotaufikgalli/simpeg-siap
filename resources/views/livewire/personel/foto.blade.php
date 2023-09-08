<div>
    <div class="card card-body">
        <img id="profile_picture0" class="img-profile col" style="min-height: 200px" src="{{url($profile_image ?? $photo->temporaryUrl())}}">
        <label class="btn btn-sm btn-primary mt-2 d-flex justify-content-center align-items-center" for="photo">
            <div wire:loading>
                <div class="spinner-grow text-danger" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            Upload / Ganti Gambar
        </label>
        <input type="file" id="photo" wire:model.lazy="photo" accept="image/png,image/jpg" class="d-none">
    </div>
</div>
