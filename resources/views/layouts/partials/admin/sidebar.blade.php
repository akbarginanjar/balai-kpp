<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            {{-- <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('assets/admin/img/profile.jpg') }}" alt="..."
                        class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            Hizrian
                            <span class="user-level">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> --}}
            <ul class="nav nav-primary">
                <li class="nav-item {{ Request::is('master-admin/dashboard') ? 'active' : '' }}">
                    <a href="/master-admin/dashboard" class="collapsed"> <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if (Auth::user()->id == 1)
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                        <a href="/" class="collapsed" target="_blank"> <i class="fa-solid fa-eye"></i></i>
                            <p>Preview</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Menu</h4>
                    </li>

                    <li class="nav-item {{ Request::is('master-admin/menu') ? 'active' : '' }}">
                        <a href="/master-admin/menu">
                            <i class="fa-solid fa-bars-staggered"></i>
                            <p>Menu</p>
                        </a>
                    </li>
                    {{-- <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Kategori</h4>
                </li>
                <li class="nav-item {{ Request::is('master-admin/kategori-artikel') ? 'active' : '' }}">
                    <a href="/master-admin/kategori-artikel">
                        <i class="fa-solid fa-object-ungroup"></i>
                        <p>Kategori Artikel</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('master-admin/kategori-kegiatan') ? 'active' : '' }}">
                    <a href="/master-admin/kategori-kegiatan">
                        <i class="fa-brands fa-servicestack"></i>
                        <p>Kategori Kegiatan</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('master-admin/kategori-galeri') ? 'active' : '' }}">
                    <a href="/master-admin/kategori-galeri">
                        <i class="fa-solid fa-image"></i>
                        <p>Kategori Galeri</p>
                    </a>
                </li> --}}
                    {{-- <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Konten</h4>
                </li> --}}
                    <li class="nav-item {{ Request::is('master-admin/halaman') ? 'active' : '' }}">
                        <a href="/master-admin/halaman">
                            <i class="fa-solid fa-layer-group"></i>
                            <p>Halaman</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item {{ Request::is('master-admin/artikel') ? 'active' : '' }}">
                    <a href="/master-admin/artikel">
                        <i class="fa-solid fa-newspaper"></i>
                        <p>Artikel</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('master-admin/kegiatan') ? 'active' : '' }}">
                    <a href="/master-admin/kegiatan">
                        <i class="fa-solid fa-universal-access"></i>
                        <p>Kegiatan</p>
                    </a>
                </li> --}}
                    <li class="nav-item {{ Request::is('master-admin/link') ? 'active' : '' }}">
                        <a href="/master-admin/link">
                            <i class="fa-solid fa-link"></i>
                            <p>Link</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item {{ Request::is('master-admin/lelang') ? 'active' : '' }}">
                        <a href="/master-admin/lelang">
                            <i class="fa-solid fa-link"></i>
                            <p>Lelang</p>
                        </a>
                    </li> --}}
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Pengaturan</h4>
                    </li>
                    <li class="nav-item {{ Request::is('master-admin/module') ? 'active' : '' }}">
                        <a href="/master-admin/module">
                            <i class="fa-solid fa-list"></i>
                            <p>Module</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::is('master-admin/setting') ? 'active' : '' }}">
                        <a href="/master-admin/setting">
                            <i class="fa-solid fa-gears"></i>
                            <p>Settings</p>
                        </a>
                    </li>


                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Forum</h4>
                    </li>
                    <li class="nav-item {{ Request::is('master-admin/forum') ? 'active' : '' }}">
                        <a href="/master-admin/forum">
                            <i class="fa-solid fa-list"></i>
                            <p>Forums</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item {{ Request::is('master-admin/urutan') ? 'active' : '' }}">
                    <a href="/master-admin/urutan">
                        <i class="fa-solid fa-layer-group"></i>
                        <p>Urutan Menu</p>
                    </a>
                </li> --}}
                    {{-- <li class="nav-item {{ Request::is('master-admin/slide') ? 'active' : '' }}">
                    <a href="/master-admin/slide">
                        <i class="fa-solid fa-clone"></i>
                        <p>Slide</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('master-admin/galeri') ? 'active' : '' }}">
                    <a href="/master-admin/galeri">
                        <i class="fa-regular fa-images"></i>
                        <p>Galeri</p>
                    </a>
                </li> --}}
                    {{-- <li class="nav-item {{ Request::is('master-admin/peta') ? 'active' : '' }}">
                    <a href="/master-admin/peta">
                        <i class="fa-solid fa-map-location"></i>
                        <p>Peta</p>
                    </a>
                </li> --}}
                    {{-- <li class="nav-item {{ Request::is('master-admin/kontak') ? 'active' : '' }}">
                    <a href="/master-admin/kontak">
                        <i class="fa-solid fa-address-book"></i>
                        <p>Kontak</p>
                    </a>
                </li> --}}
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">User</h4>
                    </li>
                    {{-- <li class="nav-item {{ Request::is('master-admin/wilayah') ? 'active' : '' }}">
                    <a href="/master-admin/wilayah">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <p>Wilayah</p>
                    </a>
                </li> --}}
                    <li class="nav-item {{ Request::is('master-admin/pengguna') ? 'active' : '' }}">
                        <a href="/master-admin/pengguna">
                            <i class="fa-solid fa-users"></i>
                            <p>Pengguna</p>
                        </a>
                    </li>
                @else
                    <li class="nav-item {{ Request::is('master-admin/artikel') ? 'active' : '' }}">
                        <a href="/master-admin/artikel">
                            <i class="fa-solid fa-newspaper"></i>
                            <p>Artikel</p>
                        </a>
                    </li>
                @endif
                {{--
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Data Informasi</h4>
                </li>

                <li class="nav-item {{ Request::is('master-admin/sdm') ? 'active' : '' }}">
                    <a href="/master-admin/sdm">
                        <i class="fa-solid fa-hand-holding-droplet"></i>
                        <p>SDM</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('master-admin/kelembagaan') ? 'active' : '' }}">
                    <a href="/master-admin/kelembagaan">
                        <i class="fa-solid fa-sitemap"></i>
                        <p>Kelembagaan</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('master-admin/relawan') ? 'active' : '' }}">
                    <a href="/master-admin/relawan">
                        <i class="fa-solid fa-handshake-angle"></i>
                        <p>Relawan</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('master-admin/sarpras') ? 'active' : '' }}">
                    <a href="/master-admin/sarpras">
                        <i class="fa-solid fa-building-columns"></i>
                        <p>Sarpras</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('master-admin/regulasi-sop') ? 'active' : '' }}">
                    <a href="/master-admin/regulasi-sop">
                        <i class="fa-sharp fa-solid fa-file-invoice"></i>
                        <p>Regulasi/SOP</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('master-admin/kejadian-kebakaran') ? 'active' : '' }}">
                    <a href="/master-admin/kejadian-kebakaran">
                        <i class="fa-solid fa-fire"></i>
                        <p>Kejadian Kebakaran</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('master-admin/kejadian-penyelamatan') ? 'active' : '' }}">
                    <a href="/master-admin/kejadian-penyelamatan">
                        <i class="fa-solid fa-truck-medical"></i>
                        <p>Kejadian Penyelematan</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('master-admin/kerjasama-daerah') ? 'active' : '' }}">
                    <a href="/master-admin/kerjasama-daerah">
                        <i class="fa-solid fa-handshake"></i>
                        <p>Kerjasama Daerah</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('master-admin/spm') ? 'active' : '' }}">
                    <a href="/master-admin/spm">
                        <i class="fa-solid fa-sheet-plastic"></i>
                        <p>SPM</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('master-admin/anggaran') ? 'active' : '' }}">
                    <a href="/master-admin/anggaran">
                        <i class="fa-solid fa-money-bills"></i>
                        <p>Anggaran</p>
                    </a>
                </li> --}}

                {{-- <li class="nav-item {{ Request::is('master-admin/informasi') ? 'active' : '' }}">
                    <a href="/master-admin/informasi">
                        <i class="fa-solid fa-info"></i>
                        <p>Data Informasi</p>
                    </a>
                </li> --}}










                {{-- <li class="nav-item {{ Request::is('') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Base</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="components/avatars.html">
                                    <span class="sub-item">Avatars</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/buttons.html">
                                    <span class="sub-item">Buttons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/gridsystem.html">
                                    <span class="sub-item">Grid System</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/panels.html">
                                    <span class="sub-item">Panels</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/notifications.html">
                                    <span class="sub-item">Notifications</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/sweetalert.html">
                                    <span class="sub-item">Sweet Alert</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/font-awesome-icons.html">
                                    <span class="sub-item">Font Awesome Icons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/simple-line-icons.html">
                                    <span class="sub-item">Simple Line Icons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/flaticons.html">
                                    <span class="sub-item">Flaticons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/typography.html">
                                    <span class="sub-item">Typography</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Request::is('') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-th-list"></i>
                        <p>Sidebar Layouts</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="sidebar-style-1.html">
                                    <span class="sub-item">Sidebar Style 1</span>
                                </a>
                            </li>
                            <li>
                                <a href="overlay-sidebar.html">
                                    <span class="sub-item">Overlay Sidebar</span>
                                </a>
                            </li>
                            <li>
                                <a href="compact-sidebar.html">
                                    <span class="sub-item">Compact Sidebar</span>
                                </a>
                            </li>
                            <li>
                                <a href="static-sidebar.html">
                                    <span class="sub-item">Static Sidebar</span>
                                </a>
                            </li>
                            <li>
                                <a href="icon-.html">
                                    <span class="sub-item">Icon </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Request::is('') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-pen-square"></i>
                        <p>Forms</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="forms/forms.html">
                                    <span class="sub-item">Basic Form</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Request::is('') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fas fa-table"></i>
                        <p>Tables</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="tables/tables.html">
                                    <span class="sub-item">Basic Table</span>
                                </a>
                            </li>
                            <li>
                                <a href="tables/datatables.html">
                                    <span class="sub-item">Datatables</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Request::is('') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#maps">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Maps</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="maps">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="maps/jqvmap.html">
                                    <span class="sub-item">JQVMap</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Request::is('') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>Charts</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="charts/charts.html">
                                    <span class="sub-item">Chart Js</span>
                                </a>
                            </li>
                            <li>
                                <a href="charts/sparkline.html">
                                    <span class="sub-item">Sparkline</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ Request::is('') ? 'active' : '' }}">
                    <a href="widgets.html">
                        <p>Widgets</p>
                        <span class="badge badge-success">4</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#sub">
                        <i class="fas fa-bars"></i>
                        <p> Levels</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sub">
                        <ul class="nav nav-collapse">
                            <li>
                                <a data-toggle="collapse" href="#subnav1">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav1">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a data-toggle="collapse" href="#subnav2">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav2">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
