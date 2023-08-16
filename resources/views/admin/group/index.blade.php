@extends('layouts.admin.master')

@section('title', "Group dan Hak Akses")

@section('content')
	<!-- Begin Page Content -->
  <div class="container-fluid mt-n10">
    @include('partials/toast')
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header">
        <div class="d-flex justify-content-end align-items-end">
          <a href="{{route('group.create')}}" class="btn btn-sm btn-primary">Tambah Group dan Hak Akses</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-bordered" id="tbListData" width="100%" cellspacing="0">
            <thead class="table-dark">
              <tr>
                <th>No</th>
                <th width="20%">Nama Group</th>
                <th>Jumlah User</th>
                <th width="40%">Hak Akses</th>
                <th>Tanggal Daftar</th>
                <th>Tanggal Update</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Nama Group</th>
                <th>Jumlah User</th>
                <th>Hak Akses</th>
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
                    <td>{{ $value->nama }}</td>
                    <td class="text-center">{{ count($value->nakses) }}</td>
                    <td class="text-start">
                      @if($value->lsakses)
                        @php($lsAkses = json_decode($value->lsakses))
                        @foreach($lsAkses as $el => $akses)
                          @php($llAkses = json_decode($akses))
                          @if($llAkses)
                            <span class="d-block btn-primary">{{$el}}</span>
                            <ul class="list-unstyled"> 
                              @foreach($llAkses as $ee => $ll)
                              <li>{{$ee}} : {{json_encode($ll)}}</li>
                              @endforeach
                            </ul>
                          @endif
                        @endforeach
                        
                      @endif
                    </td>
                    <td class="text-center">{{ $value->created_at->format('d-m-Y H:i:s') }}</td>
                    <td class="text-center">{{ $value->updated_at->format('d-m-Y H:i:s') }}</td>
                    <td>
                      <div class="d-flex gap-1">
                        <a href="{{route('group.show', ['id' => $value->id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                        <a href="{{route('group.edit', ['id' => $value->id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                        <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="Akses" data-bs-id="{{$value->id}}" data-bs-recipient="{{$value->nama}}"><i class="bi bi-trash"></i></button>
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
</script>
@endsection