@include('layouts.admin.header')
	@include('partials.topbar')
	<div id="wrapper" style="margin-top: 70px;">
		@include('partials.sidebar')
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">
				<!-- Begin Page Content -->
				<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-8">
					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between p-4 mb-4">
						<h1 class="h3 mb-0 text-light">@yield('title')</h1>
					</div>
				</header>
				@yield('content')
			</div>

			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-2">
						<span>Copyright &copy; Simpers Koarmada I @2023</span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->
		</div>
	</div>
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="bi bi-arrow-up-circle-fill"></i>
	</a>

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="{{route('logout')}}">Logout</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Logout Modal-->
	@livewire('modal-ganti-password')
@yield('js-content')
@include('layouts.admin.footer')