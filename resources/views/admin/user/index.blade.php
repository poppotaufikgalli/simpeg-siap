@extends('layouts.admin.master')

@section('title', "Pengguna")

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid mt-n10">
		@include('partials/toast')

		<div class="card shadow mb-4">
			<div class="card-header">
				<div class="d-flex justify-content-between align-items-center">
					@yield('title')
					<div class="d-flex gap-1">
						<a href="{{route('user.create')}}" class="btn btn-sm btn-primary">Tambah User</a>
					</div>
				</div>
			</div>
		  	<div class="card-body">
		  		<div class="card card-body mb-3">
			  		<form method="POST" action="{{route('user')}}">
			  			@csrf
			  			<div class="row g-2">
						    <div class="col-sm-3">
						      	<input type="text" class="form-control" id="name" name="name" placeholder="Cari dengan :UID">
						    </div>
						    <div class="col-sm-3">
						      	<input type="text" class="form-control" id="name" name="name" placeholder="Nama">
						    </div>
						    <div class="col-sm-3">
						      	<input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="NIP">
						    </div>
						    <div class="col-sm-2">
						    	<select class="form-control" id="gid" name="gid">
									<option selected disabled>Pilih Group</option>
									@if($group)
										@foreach($group as $key => $value)
											<option value="{{$value->id}}">{{$value->nama}}</option>
										@endforeach
									@endif
								</select>
						    </div>
							<div class="col-sm-1">
						    	<button class="btn btn-primary">Cari</button>
						    </div>
						</div>	
			  		</form>
			  	</div>
				<div class="table-responsive">
					<table class="table table-sm table-bordered" id="tbListData" width="100%" cellspacing="0">
						<thead class="table-dark">
						  <tr>
								<th>No</th>
								<th>Username</th>
								<th>Email</th>
								<th>Nama</th>
								<th>NIP</th>
								<th>Group</th>
								<th>Tanggal Daftar</th>
								<th>Tanggal Update</th>
								<th>Aksi</th>
						  </tr>
						</thead>
						<tfoot class="table-light">
						  <tr>
								<th>No</th>
								<th>Username</th>
								<th>Email</th>
								<th>Nama</th>
								<th>NIP</th>
								<th>Group</th>
								<th>Tanggal Daftar</th>
								<th>Tanggal Update</th>
								<th>Aksi</th>
						  </tr>
						</tfoot>
						<tbody>
							@if($data)
							  @foreach($data as $key => $value)
									<tr>
										<td>{{$data->firstItem() + $key}}</td>
										<td>{{$value->name}}</td>
										<td>{{$value->email}}</td>
										<td></td>
										<td>{{$value->nip}}</td>
										<td>
											
										</td>
										<td></td>
										<td></td>
										<td>
											<div class="d-flex gap-1">
												<a href="{{route('user.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
												<a href="{{route('user.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
												<button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="User" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->name}}"><i class="bi bi-trash"></i></button>
											</div>
										</td>
									</tr>
							  @endforeach
							@endif
						</tbody>
					</table>
					<div class="float-end">
						{{ $data->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('partials/modalHapus')
@endsection

@section('js-content')
<script type="text/javascript">
	window.onload = (event)=> {
	  let myAlert = document.querySelector('.toast');
	  if(myAlert){
		let bsAlert = new bootstrap.Toast(myAlert);
		bsAlert.show(); 
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
	      modalBodyInput.textContent = `Apakah anda yakin menghapus data Pengguna "${recipient}"" ??`
	      modalID.value = id;
	      modalForm.action = "/user/destroy"
	    })

	    hapusModal.addEventListener('hidden.bs.modal', event => {
	      const modalForm = hapusModal.querySelector('.modal-content form')
	      const modalID = hapusModal.querySelector('.modal-body input')
	      modalID.value = '';
	      modalForm.action = ""
	    })
	  }
	}
</script>
@endsection