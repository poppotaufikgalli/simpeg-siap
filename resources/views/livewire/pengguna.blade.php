<div>
    <div class="table-responsive">
        <table class="table table-sm table-bordered" id="tbListData" width="100%" cellspacing="0">
            <thead class="table-dark">
              <tr>
                    <th>No</th>
                    <th>NIP / UID</th>
                    <th>Nama</th>
                    <th>Nama Group</th>
                    <th>Tanggal Daftar</th>
                    <th>Tanggal Update</th>
                    <th>Aksi</th>
              </tr>
            </thead>
            <tfoot class="table-light">
              <tr>
                    <th>No</th>
                    <th>NIP / UID</th>
                    <th>Nama</th>
                    <th>Nama Group</th>
                    <th>Tanggal Daftar</th>
                    <th>Tanggal Update</th>
                    <th>Aksi</th>
              </tr>
            </tfoot>
            <tbody>
                @if($data)
                  @foreach($data as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value->nip}}</td>
                            <td>{{$value->nama}}</td>
                            <td>{{$value->groups->nama}}</td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{route('user.show', ['id' => $value->user_id])}}" class="btn btn-xs btn-info text-white"><i class="bi bi-eye"></i></a>
                                    <a href="{{route('user.edit', ['id' => $value->user_id])}}" class="btn btn-xs btn-primary"><i class="bi bi-pencil"></i></a>
                                    <button class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal" data-bs-target1="User" data-bs-id="{{$value->user_id}}" data-bs-recipient="{{$value->nama}}"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                  @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
