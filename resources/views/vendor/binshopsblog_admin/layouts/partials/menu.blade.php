<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ __('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route("/") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ __('global.dashboard') }}
                        </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("/") }}">
                        <i class="fas fa-fw fa-database nav-icon">
                        </i>
                        <p>
                            Data Laporan
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-newspaper">

                        </i>
                        <p>
                            Berita
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a 
                                href='{{ route('binshopsblog.admin.index') }}'
                                class="nav-link"
                            >
                                <i class="fa-fw nav-icon fas fa-circle-notch">

                                </i>
                                <p>
                                    Semua Berita
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{ route('binshopsblog.admin.create_post') }}'
                                class="nav-link"
                            >
                                <i class="fa-fw nav-icon fas fa-circle-notch">

                                </i>
                                <p>
                                    Tambah Berita
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-file-alt">

                        </i>
                        <p>
                            Halaman
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a 
                                href='{{ route('admin.pages') }}'
                                class="nav-link"
                            >
                                <i class="fa-fw nav-icon fas fa-circle-notch">

                                </i>
                                <p>
                                    Semua Halaman
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href='{{ route('binshopsblog.admin.create_post',["type"=>1]) }}'
                                class="nav-link"
                            >
                                <i class="fa-fw nav-icon fas fa-circle-notch">

                                </i>
                                <p>
                                    Tambah Halaman
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-cogs">

                        </i>
                        <p>
                            Pengaturan
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a 
                                href='{{ route('binshopsblog.admin.index') }}'
                                class="nav-link"
                            >
                                <i class="fa-fw nav-icon fas fa-circle-notch">

                                </i>
                                <p>
                                    Video Beranda
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a 
                                href='{{ route('binshopsblog.admin.index') }}'
                                class="nav-link"
                            >
                                <i class="fa-fw nav-icon fas fa-circle-notch">

                                </i>
                                <p>
                                    Menu Website
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a 
                                href='{{ route('binshopsblog.admin.index') }}'
                                class="nav-link"
                            >
                                <i class="fa-fw nav-icon fas fa-circle-notch">

                                </i>
                                <p>
                                    Tema Website
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ __('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <i class="fas fa-fw fa-sign-out-alt nav-icon">

                        </i>
                        <p>{{ __('global.logout') }}</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>