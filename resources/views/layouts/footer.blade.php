		<!-- Footer-->
        <footer class="footer bg-primary bg-opacity-10 py-5 border-top">
            <div class="container container-jdih">
                <div class="row gy-5">
                    <!--<div class="col-lg-8 h-100 text-center text-lg-start my-auto">
                        <ul class="list-inline mb-2">
                            <li class="list-inline-item"><a href="#!">Tentang</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Kontak Kami</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Perjanjian Penggunaan Aplikasi</a></li>
                            <li class="list-inline-item">⋅</li>
                            <li class="list-inline-item"><a href="#!">Kebijakan Privasi</a></li>
                        </ul>
                        <p class="text-muted small mb-4 mb-lg-0">&copy; JDIH Kota Tanjungpinang 2022. All Rights Reserved.</p>
                    </div>-->
                    <div class="col-lg-6 col-sm-12 h-100">
                        <section class="d-flex flex-column mb-2">
                            <label class="fw-bold  h-title">JDIH Kota Tanjungpinang</label>
                            <label>Bagian Hukum</label>
                            <label class="small">Sekretariat Daerah Kota Tanjungpinang</label>
                        </section>
                        <section class="d-flex flex-column mb-2 gap-1">
                            <div class="d-flex justify-content-start gap-1 small">
                                <i class="bi bi-geo-alt"></i> 
                                <div class="d-flex flex-column justify-content-start">
                                    <label>Jl. Daeng Marewa Senggarang No.1, Tanjungpinang 29115</label>
                                    <label>Kepulauan Riau</label>
                                    <label>Indonesia</label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start gap-1 small">
                                <i class="bi bi-envelope-at"></i>
                                <a class="notranslate" href="mailto:bagianhukum@tanjungpinangkota.go.id">bagianhukum@tanjungpinangkota.go.id</a>
                            </div>
                            <div class="d-flex justify-content-start gap-1 small">
                                <i class="bi bi-calendar2-check"></i>
                                <div class="d-flex flex-column justify-content-start">
                                    <div class="d-flex justify-content-between gap-2">
                                        <label>Senin - Kamis</label>
                                        <label>08.00 s/d 16.00</label>
                                    </div>
                                    <div class="d-flex justify-content-between gap-2">
                                        <label>Jumat</label>
                                        <label>08.00 s/d 15.00</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start gap-1 small mt-2 ps-3">
                                @auth
                                    <a class="btn btn-sm btn-primary" href="{{route('logout')}}">
                                        <i class="bi bi-lock-fill"></i>
                                        Logout
                                    </a>
                                @endauth
                                @guest
                                    <a class="btn btn-sm btn-primary" href="{{route('login.show')}}">
                                        <i class="bi bi-lock-fill"></i>
                                        Login
                                    </a>
                                @endguest
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3 col-sm-12 h-100">
                        <section class="d-flex flex-column mb-2">
                            <label class="fw-bold  h-title">Link Terkait</label>
                        </section>
                        @if(isset($links))
                            <div class="d-flex flex-column">
                                @foreach($links as $key => $value)
                                    @if(isset($value))
                                        <label class="p-0"># {{$key}}</label>
                                        @foreach($value as $k => $v)
                                            <a href="{{$v->isi}}" class="small text-decoration-none">
                                                <span class="hvr-sweep-to-right ps-1 pe-2">
                                                    @if($v->guid)
                                                        <img src="{{asset('images/'.$v->guid)}}" class="rounded" alt="JDIH" height="20">
                                                    @else
                                                        <i class="bi bi-link"></i>
                                                    @endif
                                                    {{$v->judul}}
                                                </span>
                                            </a>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-3 col-sm-12 d-flex flex-column align-items-center">
                        <section class="d-flex mb-2">
                            <label class="fw-bold text-center h-title">Media Sosial Kami</label>
                        </section>
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a class="text-primary" href="https://www.facebook.com/profile.php?id=100088535029457" target="_blank"><i class="bi-facebook fs-3"></i></a>
                            </li>
                            <li class="list-inline-item mx-4">
                                <a class="text-danger" href="#!"><i class="bi-youtube fs-3"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-warning" href="https://www.instagram.com/jdihtanjungpinang/?hl=id" target="_blank"><i class="bi-instagram fs-3"></i></a>
                            </li>
                        </ul>
                        <div class="card small shadow-sm rounded-0 mt-5" >
                             <div class="card-body row">
                                <span class="text-center">Kunjungan</span>
                                <span class="col-6 border-success"><i class="bi bi-circle-fill text-success"></i> Online</span><span class="col-6 text-end">{{ $avisit->online_user }}</span>
                                <span class="col-6">Hari Ini</span><span class="col-6 text-end">{{ $avisit->visit_day }}</span>
                                <span class="col-6">Bulan Ini</span><span class="col-6 text-end">{{ $avisit->visit_month }}</span>
                                <span class="col-6">Tahun Ini</span><span class="col-6 text-end">{{ $avisit->visit_year }}</span>
                                <span class="col-6">Total</span><span class="col-6 text-end">{{ $avisit->visit_total }}</span>
                                <hr class="my-1">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <span class="text-muted fst-italic small">Anda : {{visitor()->ip()}}/{{ visitor()->platform() }}/{{ visitor()->browser() }}</span>
                                    <a class="btn btn-sm btn-success" href="{{route('bukutamu', ['judul' => 'Buku Tamu'])}}"><i class="bi-chat-left-text-fill"></i> Isi Buku Tamu</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer -->
        <footer style="background: #231955;">
            <div class="container">
                <div class="d-flex flex-column text-center text-muted">
                    <span>Copyright &copy; JDIH Tanjungpinang@2022</span>
                    <span class="small">Design & Develop by <img src="{{asset('assets/img/logo-tik.png')}}" height="25"> <a class="link-secondary" href="https://kominfo.tanjungpinangkota.go.id">Diskominfo Tanjungpinang</a>@2022</span>
                    <span class="small">Version 2.0</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </body>
</html>