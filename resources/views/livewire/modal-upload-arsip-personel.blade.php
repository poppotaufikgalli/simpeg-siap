<div>
    <div class="modal fade" id="modalUploadArsipPersonel" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="mb-2 d-flex flex-column" id="dropzone-container-a">
                        <label id="ndokUpload" class="col-form-label">Upload Dokumen {{$sid}}</label>
                        <div class="needsclick dropzone" id="document-dropzone-personel"></div>
                    </div>
                    @if($existing_filename != "")
                        <div class="mb-2" id="parentIframe">
                            <div class="card">
                                <div class="card-header">
                                    <div class=" d-flex justify-content-between align-items-center">
                                        <label id="caption-filename">{{$existing_filename}}</label>
                                        <div class="d-flex gap-1">
                                            <a id="donwload-button" href="{{asset('storage/'.str_replace('/', '_',$sid).'/'.$existing_filename)}}" class="btn btn-sm btn-success" download="{{$existing_filename}}"><i class="bi bi-download"></i></a>    
                                            <button class="btn btn-sm btn-danger" id="btnDeleteArsip" wire:click="deleteUploadFile('{{$existing_filename}}')"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="card-body">
                                    <iframe id="fileViewer" src="{{asset('storage/'.str_replace('/', '_',$sid).'/'.$existing_filename)}}"  class="w-100" style="height: 80vh"></iframe>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            var myDropzone;
            var src;

            const modalUploadArsipPersonel = document.getElementById('modalUploadArsipPersonel')

            window.addEventListener('open-modal-file', function(e) {
                const myModalAlternative = new bootstrap.Modal('#modalUploadArsipPersonel', {})
                myModalAlternative.show();

                document.getElementById('dropzone-container-a').classList.add('d-none');
                document.getElementById('btnDeleteArsip').classList.add('d-none');
            })
            
            window.addEventListener('open-modal-personel', function(e) {
                const myModalAlternative = new bootstrap.Modal('#modalUploadArsipPersonel', {})
                myModalAlternative.show();

                const {type, filename, sid, hash} = e.detail;

                myDropzone = new Dropzone("div#document-dropzone-personel", { 
                    url: '{{route("arsip_elektronik.upload")}}',
                    chunking: true,
                    maxFiles: 3,
                    method: "POST",
                    maxFilesize: 40000000000,
                    chunkSize: 1000000,
                    parallelChunkUploads: true,
                    acceptedFiles: ".pdf,.PDF, image/*",
                    dictDefaultMessage: "Klik atau Drag/Drop file untuk mengupload",
                });

                /*myDropzone.on("addedfile", file => {
                    let extension = file.name.split('.').pop();
                    _filenameUpload = filename+"_"+_nfile+"."+extension;
                    file.previewElement.querySelector('[data-dz-name]').textContent = _filenameUpload;
                });*/

                myDropzone.on("sending", function(file, xhr, formData) {
                    formData.append("_token", '{{ csrf_token() }}');
                    formData.append("sid", sid);
                    formData.append("type", type);
                    formData.append("filename", filename);
                });

                myDropzone.on("success", function(file, response) {
                    console.log(response.name)
                    @this.emitSelf('insertArsip', response.name);
                    //console.log(a)
                    @this.set('existing_filename', response.name);
                    //@this.set('arsip', response);

                    myModalAlternative.hide();

                    window.location.hash = hash
                    location.reload();
                });
            });

            modalUploadArsipPersonel.addEventListener('hidden.bs.modal', event => {
                myDropzone.destroy();
            })
        })
    </script>
</div>
