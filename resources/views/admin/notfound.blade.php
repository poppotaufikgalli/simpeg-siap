@extends('layouts.admin.master')

@section('title', "Error")

@section('content')
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<div class="container-fluid">

            <!-- 404 Error Text -->
            <div class="text-center">
                <div class="error mx-auto" data-text="404">404</div>
                <p class="lead text-gray-800 mb-5">Error, Halaman Tidak Ditemukan</p>
                <p class="text-gray-500 mb-0">Halaman TIdak Ditemukan / Tidak Sesuai Hak Akses Anda</p>
                <a href="index.html">&larr; Kembali Ke Dashboard</a>
            </div>

        </div>
        <!-- /.container-fluid -->

	</div>
	<!-- /.container-fluid -->
@endsection

@section('js-content')
<script type="text/javascript">
	
</script>
@endsection
	