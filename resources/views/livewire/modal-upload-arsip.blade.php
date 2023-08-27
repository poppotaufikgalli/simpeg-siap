<div>
    <div class="modal fade" id="modalUploadArsip" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="mb-2 d-flex flex-column">
                        <label id="ndokUpload" class="col-form-label">Upload Dokumen</label>
                        <div class="needsclick dropzone" id="document-dropzone"></div>
                    </div>
                    @if($dataset)
                        <div class="mb-2 row" id="parentIframe">
                            <label class="col-sm-2 col-form-label">Daftar Dokumen</label>
                            <div class="col-sm-10">
                                @foreach($dataset as $value)
                                    <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$value->id}}" aria-expanded="false" aria-controls="collapse_{{$value->id}}">
                                        {{$value->jnsdok}}
                                    </button>
                                @endforeach
                            </div>
                            @foreach($dataset as $key => $value)
                                <div class="col-sm-12 pt-2 collapse {{$key == 0 ? 'show' : ''}} collapseIframe" id="collapse_{{$value->id}}" data-bs-parent="#parentIframe">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <label id="caption-filename">{{$value->filename}}</label>
                                            <div class="gap-2">
                                                <a id="donwload-button" href="{{asset('storage/'.$sid.'/'.$value->filename)}}" class="btn btn-sm btn-success" download="{{$value->filename}}">
                                                    <i class="bi bi-download"></i>
                                                </a>
                                                <button 
                                                    class="btn btn-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#hapusModal" 
                                                    data-bs-target1="Arsip Pegawai" 
                                                    data-bs-hash="{{$hash}}"
                                                    data-bs-id="{{$value->id}}" 
                                                    data-bs-recipient="{{$value->filename}}" 
                                                    data-bs-router="arsip_elektronik"
                                                >
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <iframe id="fileViewer" src="{{asset('storage/'.$sid.'/'.$value->filename)}}"  class="w-100" style="height: 80vh"></iframe>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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

            const modalUploadArsip = document.getElementById('modalUploadArsip')
            
            window.addEventListener('open-modal', function(e) {
                const myModalAlternative = new bootstrap.Modal('#modalUploadArsip', {})
                myModalAlternative.show();

                const {route, data, sid, isArsip, isUpload, hash} = e.detail;
                var filename = sid+"_"+data['jnsdok'];
                //console.log(filename)
                var _nfile = 1;
                var _filenameUpload = "";
                document.getElementById('ndokUpload').innerHTML = "Upload Dokumen "+data['nama']

                myDropzone = new Dropzone("div#document-dropzone", { 
                    url: route,
                    chunking: true,
                    maxFiles: 3,
                    method: "POST",
                    maxFilesize: 40000000000,
                    chunkSize: 1000000,
                    parallelChunkUploads: true,
                    acceptedFiles: ".pdf,.PDF, image/*",
                    dictDefaultMessage: "Klik atau Drag/Drop file untuk mengupload",
                });

                myDropzone.on("addedfile", file => {
                    let extension = file.name.split('.').pop();
                    _filenameUpload = filename+"_"+_nfile+"."+extension;
                    file.previewElement.querySelector('[data-dz-name]').textContent = _filenameUpload;
                });

                myDropzone.on("sending", function(file, xhr, formData) {
                    formData.append("_token", '{{ csrf_token() }}');
                    //formData.append("filename", _filenameUpload);
                    formData.append("sid", sid);
                    formData.append("jnsdok", data['jnsdok']);
                    formData.append("ndok", data['nama']);
                    formData.append("isArsip", isArsip);
                    formData.append("isUpload", isUpload);
                    formData.append('page_id', _nfile)
                });

                myDropzone.on("success", function(file, response) {
                    //console.log(response)
                    @this.set('arsip', data['id']);
                    _nfile = _nfile +1;

                    myModalAlternative.hide();

                    window.location.hash = hash
                    location.reload();
                });
            });

            modalUploadArsip.addEventListener('hidden.bs.modal', event => {
                myDropzone.destroy();
            })
        })
    </script>
</div>
