<div>
    <div class="modal fade" id="modalCariJabatan" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Cari Jabatan</h5>
                </div>
                <div class="modal-body">
                    <table class="table table-sm display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Jabatan</th>
                            </tr>
                        </thead>
                        @if($dataset)
                            <tbody>
                                @foreach($dataset as $key => $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->nama}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            var myDropzone;
            var src;

            const modalCariJabatan = document.getElementById('modalCariJabatan')
            
            window.addEventListener('open-modal', function(e) {
                const myModalAlternative = new bootstrap.Modal('#modalCariJabatan', {})
                myModalAlternative.show();
            });

            modalCariJabatan.addEventListener('hidden.bs.modal', event => {
                //myDropzone.destroy();
            })
        })
    </script>
</div>