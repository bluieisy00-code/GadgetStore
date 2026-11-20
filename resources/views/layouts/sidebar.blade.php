<!-- BLUEWAVE STATIONERY SIDEBAR -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
    id="accordionSidebar">

    <!-- BRAND -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
       href="{{ url('/') }}">

        <div class="sidebar-brand-icon">
            <i class="fas fa-book-open"></i>
        </div>

        <div class="sidebar-brand-text mx-3">
            BLUEWAVE
            <div style="font-size:10px; letter-spacing:2px;">
                STATIONERY
            </div>
        </div>

    </a>

    <hr class="sidebar-divider my-0">

    <!-- DASHBOARD -->
    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">

        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>

    </li>

    <hr class="sidebar-divider">

    <!-- HEADING -->
    <div class="sidebar-heading">
        MANAJEMEN TOKO
    </div>

    <!-- MENU KATEGORI -->
    @if (Route::has('categories.index'))

        <li class="nav-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">

            <a class="nav-link {{ request()->routeIs('categories.*') ? '' : 'collapsed' }}"
               href="#"
               data-toggle="collapse"
               data-target="#collapseCategories"
               aria-expanded="{{ request()->routeIs('categories.*') ? 'true' : 'false' }}"
               aria-controls="collapseCategories">

                <i class="fas fa-fw fa-tags"></i>
                <span>Kategori Produk</span>

            </a>

            <div id="collapseCategories"
                 class="collapse {{ request()->routeIs('categories.*') ? 'show' : '' }}"
                 data-parent="#accordionSidebar">

                <div class="bg-white py-2 collapse-inner rounded">

                    <h6 class="collapse-header">
                        Kelola Kategori
                    </h6>

                    <a class="collapse-item {{ request()->routeIs('categories.index') ? 'active' : '' }}"
                       href="{{ route('categories.index') }}">

                        <i class="fas fa-list mr-2"></i>
                        Data Kategori

                    </a>

                    @if (Route::has('categories.create'))
                        <a class="collapse-item {{ request()->routeIs('categories.create') ? 'active' : '' }}"
                           href="{{ route('categories.create') }}">

                            <i class="fas fa-plus-circle mr-2"></i>
                            Tambah Kategori

                        </a>
                    @endif

                </div>

            </div>

        </li>

    @endif

    <!-- MENU PRODUK -->
    @if (Route::has('products.index'))

        <li class="nav-item {{ request()->routeIs('products.*') ? 'active' : '' }}">

            <a class="nav-link {{ request()->routeIs('products.*') ? '' : 'collapsed' }}"
               href="#"
               data-toggle="collapse"
               data-target="#collapseProducts"
               aria-expanded="{{ request()->routeIs('products.*') ? 'true' : 'false' }}"
               aria-controls="collapseProducts">

                <i class="fas fa-fw fa-box-open"></i>
                <span>Data Produk</span>

            </a>

            <div id="collapseProducts"
                 class="collapse {{ request()->routeIs('products.*') ? 'show' : '' }}"
                 data-parent="#accordionSidebar">

                <div class="bg-white py-2 collapse-inner rounded">

                    <h6 class="collapse-header">
                        Kelola Produk
                    </h6>

                    <a class="collapse-item {{ request()->routeIs('products.index') ? 'active' : '' }}"
                       href="{{ route('products.index') }}">

                        <i class="fas fa-boxes mr-2"></i>
                        Semua Produk

                    </a>

                    @if (Route::has('products.create'))
                        <a class="collapse-item {{ request()->routeIs('products.create') ? 'active' : '' }}"
                           href="{{ route('products.create') }}">

                            <i class="fas fa-plus-circle mr-2"></i>
                            Tambah Produk

                        </a>
                    @endif

                </div>

            </div>

        </li>

    @endif

    <!-- MENU MONITORING STOK -->
    @if (Route::has('stocks.index'))

        <li class="nav-item {{ request()->routeIs('stocks.*') ? 'active' : '' }}">

            <a class="nav-link"
               href="{{ route('stocks.index') }}">

                <i class="fas fa-fw fa-warehouse"></i>
                <span>Monitoring Stok</span>

            </a>

        </li>

    @endif

    <hr class="sidebar-divider">

    <!-- HEADING LAPORAN -->
    <div class="sidebar-heading">
        LAPORAN
    </div>

    <!-- MENU LAPORAN INVENTARIS -->
    @if (Route::has('reports.index'))

        <li class="nav-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">

            <a class="nav-link"
               href="{{ route('reports.index') }}">

                <i class="fas fa-fw fa-chart-bar"></i>
                <span>Laporan Inventaris</span>

            </a>

        </li>

    @endif

    <hr class="sidebar-divider">

    <!-- HEADING AKUN -->
    <div class="sidebar-heading">
        AKUN
    </div>

    <!-- PROFILE -->
    @auth
        @if (Route::has('profile.edit'))

            <li class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">

                <a class="nav-link"
                   href="{{ route('profile.edit') }}">

                    <i class="fas fa-fw fa-user-circle"></i>
                    <span>Profil Saya</span>

                </a>

            </li>

        @endif

        <!-- LOGOUT -->
        <li class="nav-item">

            <a class="nav-link"
               href="#"
               data-toggle="modal"
               data-target="#logoutModal">

                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span>

            </a>

        </li>
    @endauth

    <hr class="sidebar-divider d-none d-md-block">

    <!-- SIDEBAR TOGGLER -->
    <div class="text-center d-none d-md-inline">

        <button class="rounded-circle border-0"
                id="sidebarToggle">
        </button>

    </div>

    <!-- BRAND FOOTER -->
    <div class="text-center mt-4 mb-3 px-2">

        <small style="color:#FFFFFF; opacity:0.9;">
            <i class="fas fa-heart mr-1"></i>
            BLUEWAVE STATIONERY
        </small>

        <div style="font-size:10px; color:#FFFFFF; opacity:0.75;">
            Smart Inventory Management
        </div>

    </div>

</ul>
<!-- END SIDEBAR -->
