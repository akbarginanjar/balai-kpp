@php
    use App\Models\Tb_menu;
    use App\Models\Tb_submenu;
    use App\Models\Tb_setting;
    use App\Models\Tb_visitor;
    $visitors = Tb_visitor::count();
    $setting = Tb_setting::find(1);
    $menu = Tb_menu::orderBy('urutan', 'asc')->get();
@endphp

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="footer-newsletter">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <h4>Kontak</h4>
                    <p>Silahkan masukan Email anda untuk Kontak</p>
                    <a href="/m=>kontak" class="btn btn-primary">Hubungi Kami</a>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-sm footer-info">
                    <a href="/" class="logo d-flex align-items-center">
                        {{-- <img src="assets/img/logo.png" alt=""> --}}
                        <span>{{ $setting->judul }}</span>
                    </a>
                    <p>{{ $setting->alamat }}</p>
                    <div class="social-links mt-3">
                        <a href="{{ $setting->facebook }}" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="{{ $setting->instagram }}" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="{{ $setting->twitter }}" class="tiktok"><i class="bi bi-tiktok"></i></a>
                        {{-- <a href="{{ $setting->linkedin }}" class="linkedin"><i class="bi bi-linkedin"></i></a> --}}
                    </div>
                </div>

                <div class="col-sm footer-links">
                    <h4>Menu</h4>
                    <ul>
                        @foreach ($menu as $item)
                            @if ($item->id_konten === 0)
                                <li class="nav-item dropdown">
                                    <i class="bi bi-chevron-right"></i>
                                    <a id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" v-pre style="text-decoration: none;">
                                        {{ $item->nama }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        @php
                                            $submenu = Tb_submenu::where('id_menu', $item->id)->get();
                                        @endphp
                                        @foreach ($submenu as $data)
                                            <a href="/s=>{{ $data->slug }}"
                                                class="dropdown-item {{ Request::is('') ? 'active text-warning' : '' }}">{{ $data->nama }}</a>
                                        @endforeach
                                    </div>
                                </li>
                            @else
                                <li><i class="bi bi-chevron-right"></i> <a
                                        href="/m=>{{ $item->slug }}">{{ $item->nama }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                {{-- <div class="col-lg-2 col-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Graphic Design</a></li>
                    </ul>
                </div> --}}

                <div class="col-sm footer-contact text-center text-md-start">
                    <h4>Kontak Kami</h4>
                    {{-- <p>
                        A108 Adam Street <br>
                        New York, NY 535022<br>
                        United States <br><br> --}}
                    <strong>Phone:</strong> {{ $setting->call_us }}<br>
                    <strong>Email:</strong> {{ $setting->email_us }}<br>
                    </p>
                    <div class="card border-0 shadow" style="border-radius: 13px;">
                        <div class="card-body">
                            <h5>Visitor: <b> {{ number_format($visitors, 0, ',', '.') }} </b></h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>{{ $setting->judul }}</span></strong>. All Rights Reserved
        </div>
        {{-- <div class="credits">
            Designed by <a href="/">Belajar Link</a>
        </div> --}}
    </div>
</footer><!-- End Footer -->

<script type="text/javascript">
    document.querySelector('.refresh-captcha').addEventListener('click', function() {
        var captchaImage = document.querySelector('.captcha-img');
        var captchaSrc = captchaImage.src.split('?')[0];
        captchaImage.src = captchaSrc + '?' + Math.random();
    });
</script>

<!-- Footer Start -->
{{-- @php
      use App\Models\Tb_menu;
      use App\Models\Tb_submenu;
      use App\Models\Tb_setting;
      $setting = Tb_setting::find(1);
      $menu = Tb_menu::all();
  @endphp
  <div class="container-fluid bg-primary text-body footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
      <div class="container py-5">
          <div class="row g-5">
              <div class="col-lg-4 col-md-6">
                  <h5 class="text-light mb-4">Alamat:</h5>
                  <p class="mb-2 text-light"><i class="fa fa-map-marker-alt me-3"></i>{{ $setting->alamat }}
                  </p>
                  <p class="mb-2 text-light"><i class="fa fa-phone-alt me-3"></i>{{ $setting->call_us }}</p>
                  <p class="mb-2 text-light"><i class="fa fa-envelope me-3"></i>{{ $setting->email_us }}</p>
              </div>
              <div class="col-lg-3 col-md-6">
                  <h5 class="text-light mb-4">Menu</h5>
                  <ul class="navbar-nav ms-auto">
                      @foreach ($menu as $item)
                          @if ($item->id_konten === 0)
                              <li class="nav-item dropdown">
                                  <a id="navbarDropdown" class="btn btn-link text-white dropdown-toggle" href="#"
                                      role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                      aria-expanded="false" v-pre>
                                      {{ $item->nama }}
                                  </a>

                                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                      @php
                                          $submenu = Tb_submenu::where('id_menu', $item->id)->get();
                                      @endphp
                                      @foreach ($submenu as $data)
                                          <a href="/s=>{{ $data->slug }}"
                                              class="dropdown-item {{ Request::is('') ? 'active text-warning' : '' }}">{{ $data->nama }}</a>
                                      @endforeach
                                  </div>
                              </li>
                          @else
                              <a href="/m=>{{ $item->slug }}"
                                  class="btn btn-link text-white {{ Request::is('/m=>saha') ? 'active text-warning' : '' }}">{{ $item->nama }}</a>
                          @endif
                      @endforeach
                  </ul>
              </div>
              <div class="col">
                  <h5 class="text-light mb-4">Social Media</h5>
                  <div class="d-flex pt-2">
                      <a class="btn btn-square btn-outline-warning rounded-circle me-1"
                          href="{{ $setting->twitter }}"><i class="fab fa-twitter"></i></a>
                      <a class="btn btn-square btn-outline-warning rounded-circle me-1"
                          href="{{ $setting->facebook }}"><i class="fab fa-facebook-f"></i></a>
                      <a class="btn btn-square btn-outline-warning rounded-circle me-1"
                          href="{{ $setting->instagram }}"><i class="fab fa-instagram"></i></a>
                      <a class="btn btn-square btn-outline-warning rounded-circle me-0"
                          href="{{ $setting->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
                  </div>
              </div>
          </div>
      </div>
      <div class="container-fluid copyright">
          <div class="container">
              <div class="row">
                  <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                      &copy; <a href="#">Damkar JABAR</a>, All Right Reserved.
                  </div>
                  {{-- <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a href="https://htmlcodex.com">DAMKAR</a>
                    <br>Distributed By: <a class="border-bottom" href="https://themewagon.com"
                        target="_blank">DAMKAR</a>
                </div>
  </div>
  </div>
  </div>
  </div> --}}
<!-- Footer End -->
