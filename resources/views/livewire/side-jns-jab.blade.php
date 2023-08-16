<div>
    @if($ref_jabatan)
        @php($selRoute = explode('.', Route::currentRouteName())[0])
        @php($idRoute = request()->route('jenis_jabatan_id'))
        @foreach($ref_jabatan as $value)
            <li class="nav-item {{$selRoute == 'ref_jabatan' && $idRoute == $value->id ? 'active' : ''}}">
                <a class="nav-link py-2" href="{{route('ref_jabatan', ['jenis_jabatan_id' => $value->id])}}">
                    <i class="bi bi-people-fill"></i>
                    <span>{{$value->nama}}</span>
                </a>
            </li>
        @endforeach
    @endif
</div>
