<!-- Sidebar -->
	<ul class="navbar-nav bg-gradient sidebar accordion" id="accordionSidebar">
		@php($selRoute = explode('.', Route::currentRouteName())[0])
		<!-- Nav Item - Dashboard -->
		<li class="nav-item {{$selRoute == 'dashboard' ? 'active' : ''}}">
			<a class="nav-link pb-2" href="{{route('dashboard')}}">
				<i class="bi bi-columns-gap"></i>
				<span>Dashboard</span>
			</a>
		</li>
		<li class="nav-item {{ $selRoute == 'pegawai' ? 'active' : ''}}">
			<a class="nav-link pb-2" href="{{route('pegawai')}}">
				<i class="bi bi-columns-gap"></i>
				<span>Pegawai</span>
			</a>
		</li>
        @livewire('side-jns-personel')
        <li class="nav-item {{$selRoute == 'unit_kerja' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('unit_kerja')}}">
				<i class="bi bi-people-fill"></i>
				<span>Unit Kerja / OPD</span>
			</a>
		</li>
        <li class="nav-item {{$selRoute == 'master_jabatan' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('master_jabatan')}}">
				<i class="bi bi-people-fill"></i>
				<span>Formasi Jabatan OPD</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'arsip_elektronik' ? 'active' : ''}}">
			<a class="nav-link" href="{{route('arsip_elektronik')}}">
				<i class="bi bi-columns-gap"></i>
				<span>Arsip Elektronik</span>
			</a>
		</li>
		
		@if(in_array('group', Session::get('menu')) || in_array('user', Session::get('menu')))
			<!-- Divider -->
			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
				Konfigurasi Sistem
			</div>
			
			
			@if(in_array('group', Session::get('menu')))
			<li class="nav-item">
				<a class="nav-link py-2" href="{{route('group')}}">
					<i class="bi bi-people-fill"></i>
					<span>Group dan Hak Akses</span>
				</a>
			</li>
			@endif
			@if(in_array('user', Session::get('menu')))
			<li class="nav-item">
				<a class="nav-link py-2" href="{{route('user')}}">
					<i class="bi bi-people-fill"></i>
					<span>Pengguna</span>
				</a>
			</li>
			@endif
			<li class="nav-item">
				<a class="nav-link py-2 d-flex gap-1" href="{{route('config')}} ">
					<i class="bi bi-gear"></i>
					<span>Pengaturan</span>
				</a>
			</li>
		@endif

		<hr class="sidebar-divider">
		<!-- Heading -->
		<div class="sidebar-heading">
			Konfigurasi Sistem
		</div>
		<li class="nav-item {{$selRoute == 'user' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('user')}}">
				<i class="bi bi-people-fill"></i>
				<span>Pengguna</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'group' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('group')}}">
				<i class="bi bi-people-fill"></i>
				<span>Group dan Hak Akses</span>
			</a>
		</li>

		<hr class="sidebar-divider">
		<!-- Heading -->
		<div class="sidebar-heading">
			Data Referensi
		</div>
		<li class="nav-item {{$selRoute == 'jenis_personel' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('jenis_personel')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jenis Personel</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'jenis_pegawai' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('jenis_pegawai')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jenis Pegawai</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'instansi' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('instansi')}}">
				<i class="bi bi-people-fill"></i>
				<span>Instansi</span>
			</a>
		</li>

		<li class="nav-item {{$selRoute == 'kedudukan_pegawai' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('kedudukan_pegawai')}}">
				<i class="bi bi-people-fill"></i>
				<span>Kedudukan Hukum Pegawai</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'eselon' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('eselon')}}">
				<i class="bi bi-people-fill"></i>
				<span>Eselon</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'agama' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('agama')}}">
				<i class="bi bi-people-fill"></i>
				<span>Agama</span>
			</a>
		</li>
		<hr/>
		<li class="nav-item {{$selRoute == 'pangkat' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('pangkat')}}">
				<i class="bi bi-people-fill"></i>
				<span>Pangkat</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'jenis_kp' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('jenis_kp')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jenis Kenaikan Pangkat</span>
			</a>
		</li>
		<hr/>
		<li class="nav-item {{$selRoute == 'jenis_jabatan' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('jenis_jabatan')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jenis Jabatan</span>
			</a>
		</li>
		@livewire('side-jns-jab')
		<hr />
		<li class="nav-item {{$selRoute == 'jenis_kawin' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('jenis_kawin')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jenis Perkawinan</span>
			</a>
		</li>
		<!--<li class="nav-item {{$selRoute == 'jenis_goldar' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('jenis_goldar')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jenis Golongan Darah</span>
			</a>
		</li>-->
		<li class="nav-item {{$selRoute == 'tingkat_pendidikan' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('tingkat_pendidikan')}}">
				<i class="bi bi-people-fill"></i>
				<span>Tingkat Pendidikan</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'pendidikan' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('pendidikan')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jurusan Pendidikan</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'jenis_profesi' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('jenis_profesi')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jenis Profesi</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'jenis_kursus' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('jenis_kursus')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jenis Kursus</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'diklat' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('diklat')}}">
				<i class="bi bi-people-fill"></i>
				<span>Master Diklat</span>
			</a>
		</li>
		<hr>
		<li class="nav-item {{$selRoute == 'jenis_arsip' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('jenis_arsip')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jenis Arsip</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'group_arsip' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('group_arsip')}}">
				<i class="bi bi-people-fill"></i>
				<span>Group Arsip</span>
			</a>
		</li>
		<hr>
		<li class="nav-item {{$selRoute == 'jenis_hukdis' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('jenis_hukdis')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jenis Hukuman Disiplin</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'jenis_penghargaan' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('jenis_penghargaan')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jenis Penghargaan</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'jenis_pengadaan' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('jenis_pengadaan')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jenis Pengadaan</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'jenis_pemberhentian' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('jenis_pemberhentian')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jenis Pemberhentian</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'jenis_pensiun' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('jenis_pensiun')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jenis Pensiun</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'jenis_kompetensi' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('jenis_kompetensi')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jenis Kompetensi</span>
			</a>
		</li>
		<li class="nav-item {{$selRoute == 'jenis_organisasi' ? 'active' : ''}}">
			<a class="nav-link py-2" href="{{route('jenis_organisasi')}}">
				<i class="bi bi-people-fill"></i>
				<span>Jenis Organisasi</span>
			</a>
		</li>
	</ul>
	<!-- End of Sidebar -->