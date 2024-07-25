 <!-- start: Sidebar -->
    <div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
        <div class="d-flex align-items-center p-3">
            <a href="#" class="sidebar-logo text-uppercase fw-bold text-decoration-none text-indigo fs-4">Data Sekolah</a>
            <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
        </div>
        <ul class="sidebar-menu p-3 m-0 mb-0">
            <li class="sidebar-menu-item {{ request()->is('/') ? 'active' : '' }}">
                <a href="<?= route("home") ?>">
                    <i class="ri-dashboard-line sidebar-menu-item-icon"></i>
                    Dashboard
                </a>
            </li>
            <li class="sidebar-menu-item {{ request()->is('siswa') ? 'active' : '' }}">
                <a href="<?= route("siswa.index") ?>">
                    <i class="ri-admin-line sidebar-menu-item-icon"></i>
                    Data Siswa
                </a>
            </li>
            @if (Auth::user()->role_id !=3)
                <li class="sidebar-menu-item {{ request()->is('admin-sekolah') ? 'active' : '' }}">
                    <a href="<?= route("admin-sekolah.index") ?>">
                        <i class="ri-admin-line sidebar-menu-item-icon"></i>
                        Admin Sekolah
                    </a>
                </li>
            @endif
            @if (Auth::user()->role_id==1)
                
                <li class="sidebar-menu-item {{ request()->is('super-admin') ? 'active' : '' }}">
                    <a href="<?= route("super-admin.index") ?>">
                        <i class="ri-admin-line sidebar-menu-item-icon"></i>
                        Admin Kota
                    </a>
                </li>
            @endif
           
            {{-- <li class="sidebar-menu-item {{ request()->is('admin-kota') ? 'active' : '' }}">
                <a href="<?= route("admin-kota.index") ?>">
                    <i class="ri-admin-line sidebar-menu-item-icon"></i>
                    Data Sekolah
                </a>
            </li> --}}

            {{-- @if (Auth::user()->role_id == 2 || Auth::user()->role_id==1)
            <li class="sidebar-menu-item has-dropdown {{ request()->is('admin-kota') ? 'focused' : '' }}">

                <a href="javascript:;">
                    <i class="ri-admin-line sidebar-menu-item-icon"></i>
                    Admin Kota
                    <i class="ri-arrow-down-s-line sidebar-menu-item-accordion ms-auto"></i>
                </a>

                <ul class="sidebar-dropdown-menu">

                    <li class="sidebar-dropdown-menu-item {{ request()->is('admin-kota') ? 'focused' : '' }}">
                        <a href="<?= route("admin-kota.index") ?>">
                            index
                        </a>
                    </li>
                    <li class="sidebar-dropdown-menu-item {{ request()->is('admin-kota-generate') ? 'focused' : '' }}">
                        <a href="<?= route("admin-kota.generate") ?>">
                            Laporan Per Kota
                        </a>
                    </li>
                </ul>
            </li>
            @endif --}}

            {{-- @if (Auth::user()->role_id != 3) --}}
            {{-- <li class="sidebar-menu-item has-dropdown {{ request()->is('admin-sekolah') ? 'focused' : '' }}">

                <a href="javascript:;">
                    <i class="ri-admin-line sidebar-menu-item-icon"></i>
                    Admin Sekolah
                    <i class="ri-arrow-down-s-line sidebar-menu-item-accordion ms-auto"></i>
                </a>

                <ul class="sidebar-dropdown-menu">

                    <li class="sidebar-dropdown-menu-item {{ request()->is('admin-sekolah') ? 'focused' : '' }}">
                        <a href="<?= route("admin-sekolah.index") ?>">
                            index
                        </a>
                    </li>
                    <li class="sidebar-dropdown-menu-item {{ request()->is('admin-sekolah-generate') ? 'focused' : '' }}">
                        <a href="<?= route("admin-sekolah.generate") ?>">
                            Laporan Per Sekolah
                        </a>
                    </li>
                    <li class="sidebar-dropdown-menu-item {{ request()->is('admin-sekolah-datasiswa') ? 'focused' : '' }}">
                        <a href="<?= route("admin-sekolah.datasiswa") ?>">
                            Laporan Data Siswa
                        </a>
                    </li>
                    
                </ul>
            </li>    
            @endif --}}
            

           
            <li class="sidebar-menu-divider mt-3 mb-1 text-uppercase">Apps</li>
            <li class="sidebar-menu-item {{ request()->is('sekolah-ubah-password') ? 'active' : '' }}">
                <a href="{{ route('sekolah-ubah-password') }}">
                    <i class="ri-lock-line sidebar-menu-item-icon"></i>
                    Ubah Password
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="<?= route("logout") ?>">
                    <i class="ri-logout-circle-r-line sidebar-menu-item-icon"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-overlay"></div>
    <!-- end: Sidebar -->