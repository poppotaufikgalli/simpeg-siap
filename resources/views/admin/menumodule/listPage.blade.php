@extends('layouts.admin.master')

@section('title', "List User")

@section('content')
	<!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    @include('partials/toast')
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
          <h1 class="h3 mb-2 text-gray-800">{{$title}}</h1>
          <a href="{{route('menumodule.tambah')}}" class="btn btn-sm btn-primary">Tambah</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table small table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Menu / Module</th>
                <th>Nama Controller</th>
                <th>Tanggal Daftar</th>
                <th>Tanggal Update</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Nama Menu / Module</th>
                <th>Nama Controller</th>
                <th>Tanggal Daftar</th>
                <th>Tanggal Update</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
            <tbody>
          		@if($data)
                @foreach($data as $key => $value)
                  <tr>
                    <td>{{$key +1}}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->controller_name }}</td>
                    <td class="text-center">{{ $value->created_at }}</td>
                    <td class="text-center">{{ $value->updated_at }}</td>
                    <td>
                      <div class="d-flex justify-content-evenly gap-1">
                        <a href="{{ route('menumodule.ubah', ['id' => $value->id]) }}" class="btn btn-sm btn-primary">
                          <i class="bi bi-pencil-square"></i>
                        </a>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-id="{{$value->id}}" data-bs-target1="{{$title}}" data-bs-recipient="{{$value->name .'/'. $value->controller_name}}" class="btn btn-sm btn-danger">
                          <i class="bi bi-trash3-fill"></i>
                        </button>
                      </div>
                    </td>                    
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @include('partials.modalHapus')
  </div>
  <!-- /.container-fluid -->
@endsection

@section('js-content')
<script type="text/javascript">
  window.onload = (event)=> {
  let myAlert = document.querySelector('.toast');
  if(myAlert){
    let bsAlert = new bootstrap.Toast(myAlert);
    bsAlert.show(); 
  }
}

const hapusModal = document.getElementById('hapusModal')
  if(hapusModal){
    hapusModal.addEventListener('show.bs.modal', e => {
      // Button that triggered the modal
      const button = e.relatedTarget
      // Extract info from data-bs-* attributes
      const target1 = button.getAttribute('data-bs-target1')
      const id = button.getAttribute('data-bs-id')
      const recipient = button.getAttribute('data-bs-recipient')
      // If necessary, you could initiate an AJAX request here
      // and then do the updating in a callback.
      //
      // Update the modal's content.
      const modalTitle = hapusModal.querySelector('.modal-title')
      const modalBodyInput = hapusModal.querySelector('.modal-body p')
      const modalID = hapusModal.querySelector('.modal-body input')
      const modalForm = hapusModal.querySelector('.modal-content form')

      modalTitle.textContent = `Menghapus Data ${target1}`
      modalBodyInput.textContent = `Apakah anda yakin menghapus data Menu Module "${recipient}"" ??`
      modalID.value = id;
      modalForm.action = "/menumodule/perform/Hapus"
    })

    hapusModal.addEventListener('hidden.bs.modal', event => {
      const modalForm = hapusModal.querySelector('.modal-content form')
      const modalID = hapusModal.querySelector('.modal-body input')
      modalID.value = '';
      modalForm.action = ""
    })
  }
</script>
@endsection