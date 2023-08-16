<!-- Topbar -->
	<nav class="navbar navbar-expand navbar-light bg-white fixed-top topbar shadow">
		<!-- Sidebar Toggle (Topbar) -->
		<button id="sidebarToggleTop" class="btn btn-link rounded-circle mx-3">
			<i class="bi bi-list"></i>
		</button>
		<!-- Sidebar - Brand -->
		<a class="navbar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
			<img src="{{env('APP_LOGO')}}" alt="JDIH" height="30" class="pe-2">
			<div class="navbar-brand-text d-none d-md-block">{{env('APP_TITLE')}}</div>
			<div class="navbar-brand-text d-block d-sm-none">{{env('APP_NAME')}}</div>
		</a>

		<div class="d-flex justify-content-end w-100">
			<!-- Topbar Navbar -->
			<ul class="navbar-nav ml-auto align-items-center">

				<!-- Nav Item - Search Dropdown (Visible Only XS) -->
				<li class="nav-item dropdown no-arrow d-sm-none">
					<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="bi bi-search"></i>
					</a>
					<!-- Dropdown - Messages -->
					<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown" style="left: auto;">
						<form class="form-inline mr-auto w-100 navbar-search">
							<div class="input-group">
								<input type="text" class="form-control bg-light border-0" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
								<div class="input-group-append">
									<button class="btn btn-primary" type="button">
										<i class="bi bi-search"></i>
									</button>
								</div>
							</div>
						</form>
					</div>
				</li>

				<!-- Nav Item - Alerts -->
				<li class="nav-item dropdown no-arrow mx-1 d-none d-md-block">
					<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="bi bi-bell-fill"></i>
						<!-- Counter - Alerts -->
						<span class="badge bg-danger badge-counter">3+</span>
					</a>
					<!-- Dropdown - Alerts -->
					<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="left: auto;">
						<h6 class="dropdown-header">
							Alerts Center
						</h6>
						<a class="dropdown-item d-flex align-items-center" href="#">
							<div class="mr-3">
								<div class="icon-circle bg-primary">
									<i class="fas fa-file-alt text-white"></i>
								</div>
							</div>
							<div>
								<div class="text-gray-500">December 12, 2019</div>
								<span class="font-weight-bold">A new monthly report is ready to download!</span>
							</div>
						</a>
						<a class="dropdown-item d-flex align-items-center" href="#">
							<div class="mr-3">
								<div class="icon-circle bg-success">
									<i class="fas fa-donate text-white"></i>
								</div>
							</div>
							<div>
								<div class="text-gray-500">December 7, 2019</div>
								$290.29 has been deposited into your account!
							</div>
						</a>
						<a class="dropdown-item d-flex align-items-center" href="#">
							<div class="mr-3">
								<div class="icon-circle bg-warning">
									<i class="fas fa-exclamation-triangle text-white"></i>
								</div>
							</div>
							<div>
								<div class="text-gray-500">December 2, 2019</div>
								Spending Alert: We've noticed unusually high spending for your account.
							</div>
						</a>
						<a class="dropdown-item text-center text-gray-500" href="#">Show All Alerts</a>
					</div>
				</li>

				<!-- Nav Item - Messages -->
				<li class="nav-item dropdown no-arrow mx-1 d-none d-md-block">
					<a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="bi bi-envelope-fill"></i>
						<!-- Counter - Messages -->
						<span class="badge bg-danger badge-counter">7</span>
					</a>
					<!-- Dropdown - Messages -->
					<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown" style="left: auto;">
						<h6 class="dropdown-header">
							Message Center
						</h6>
						<a class="dropdown-item d-flex align-items-center" href="#">
							<div class="dropdown-list-image mr-3">
								<img class="rounded-circle" src="/assets/img/undraw_profile_1.svg" alt="...">
								<div class="status-indicator bg-success"></div>
							</div>
							<div class="font-weight-bold">
								<div class="text-truncate">Hi there! I am wondering if you can help me with a
									problem I've been having.</div>
								<div class="small text-gray-500">Emily Fowler · 58m</div>
							</div>
						</a>
						<a class="dropdown-item d-flex align-items-center" href="#">
							<div class="dropdown-list-image mr-3">
								<img class="rounded-circle" src="/assets/img/undraw_profile_2.svg" alt="...">
								<div class="status-indicator"></div>
							</div>
							<div>
								<div class="text-truncate">I have the photos that you ordered last month, how
									would you like them sent to you?</div>
								<div class="small text-gray-500">Jae Chun · 1d</div>
							</div>
						</a>
						<a class="dropdown-item d-flex align-items-center" href="#">
							<div class="dropdown-list-image mr-3">
								<img class="rounded-circle" src="/assets/img/undraw_profile_3.svg" alt="...">
								<div class="status-indicator bg-warning"></div>
							</div>
							<div>
								<div class="text-truncate">Last month's report looks great, I am very happy with
									the progress so far, keep up the good work!</div>
								<div class="small text-gray-500">Morgan Alvarez · 2d</div>
							</div>
						</a>
						<a class="dropdown-item d-flex align-items-center" href="#">
							<div class="dropdown-list-image mr-3">
								<img class="rounded-circle" src="/assets/img/undraw_profile_3.svg" alt="...">
								<div class="status-indicator bg-success"></div>
							</div>
							<div>
								<div class="text-truncate">Am I a good boy? The reason I ask is because someone
									told me that people say this to all dogs, even if they aren't good...</div>
								<div class="small text-gray-500">Chicken the Dog · 2w</div>
							</div>
						</a>
						<a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
					</div>
				</li>

				<div class="topbar-divider d-none d-sm-block"></div>

				<!-- Nav Item - User Information -->
				<li class="nav-item dropdown no-arrow mx-3">
					<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Session::get('nama')}}</span>
						<img class="img-profile rounded-circle" src="/assets/img/undraw_profile.svg">
					</a>
					<!-- Dropdown - User Information -->
					<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="left: auto;">
						<a class="dropdown-item" href="#">
							<i class="bi bi-person-badge mr-2 text-gray-400"></i>
							Profile
						</a>
						<a class="dropdown-item" href="#">
							<i class="bi bi-gear-fill mr-2 text-gray-400"></i>
							Settings
						</a>
						<a class="dropdown-item" href="#">
							<i class="bi bi-activity mr-2 text-gray-400"></i>
							Activity Log
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
							<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
							Logout
						</a>
					</div>
				</li>

			</ul>
		</div>
	</nav>
	<!-- End of Topbar -->