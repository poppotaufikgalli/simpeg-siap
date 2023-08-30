<div>
    <div wire:ignore.self class="modal fade" id="modalGantiPassword" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header text-bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Ganti Password Anda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="mb-3 row">
                            <label for="passlama" class="col-sm-2 col-form-label">Password lama</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="passlama" wire:model="passlama" required>
                                    <button class="btn btn-outline-secondary" type="button" id="btn1">
                                        <i class="bi bi-eye" id="button-addon1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="passbaru" class="col-sm-2 col-form-label">Password Baru</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="passbaru" wire:model="passbaru" required>
                                    <button class="btn btn-outline-secondary" type="button" id="btn2">
                                        <i class="bi bi-eye" id="button-addon2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="cpassbaru" class="col-sm-2 col-form-label">Ulangi Password Baru</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="cpassbaru" wire:model="cpassbaru" required>
                                    <button class="btn btn-outline-secondary" type="button" id="btn3">
                                        <i class="bi bi-eye" id="button-addon3"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="button"  wire:click.prevent="update">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            window.addEventListener('passwordInfo', function(e) {
                const notyf = new Notyf();
                const {detail} = e;
                console.log(detail);

                notyf.success(detail)
            });

            document.getElementById("btn1").addEventListener('click', function(e){
                var icon = document.getElementById('button-addon1').classList
                if(icon.contains('bi-eye')){
                    icon.remove('bi-eye')
                    icon.add('bi-eye-slash')   
                    document.getElementById('passlama').type = 'text'; 
                }else{
                    icon.remove('bi-eye-slash')
                    icon.add('bi-eye')
                    document.getElementById('passlama').type = 'password'; 
                }
            })

            document.getElementById("btn2").addEventListener('click', function(e){
                var icon = document.getElementById('button-addon2').classList
                if(icon.contains('bi-eye')){
                    icon.remove('bi-eye')
                    icon.add('bi-eye-slash')   
                    document.getElementById('passbaru').type = 'text'; 
                }else{
                    icon.remove('bi-eye-slash')
                    icon.add('bi-eye')
                    document.getElementById('passbaru').type = 'password'; 
                }
            })

            document.getElementById("btn3").addEventListener('click', function(e){
                var icon = document.getElementById('button-addon3').classList
                if(icon.contains('bi-eye')){
                    icon.remove('bi-eye')
                    icon.add('bi-eye-slash')   
                    document.getElementById('cpassbaru').type = 'text'; 
                }else{
                    icon.remove('bi-eye-slash')
                    icon.add('bi-eye')
                    document.getElementById('cpassbaru').type = 'password'; 
                }
            })

            const modalGantiPassword = document.getElementById('modalGantiPassword')

            modalGantiPassword.addEventListener('hidden.bs.modal', event => {
                //myDropzone.destroy();
            })
        })
    </script>
</div>
