<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-navy elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.index') }}" class="brand-link navbar-warning">
        <img src="{{ url('resources/assets') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><i>{{ __('msg.sys_name') }}</i></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('resources/assets') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->full_name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link {{ (Request::segment(1) == 'dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('msg.menu_dashboard') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ (Request::segment(1) == 'setting') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (Request::segment(1) == 'setting') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>
                            {{ __('msg.menu_setting') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link {{ (Request::segment(2) == 'user') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('msg.menu_setting_user') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ (Request::segment(1) == 'jv-tranfer') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (Request::segment(1) == 'jv-tranfer') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            {{ __('msg.menu_jv_tranfer') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('jv-tranfer.import-file1') }}" class="nav-link {{ (Request::segment(2) == 'import-file1') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('msg.menu_jv_tranfer_import_file1') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jv-tranfer.import-file2') }}" class="nav-link {{ (Request::segment(2) == 'import-file2') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('msg.menu_jv_tranfer_import_file2') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jv-tranfer.emptrucker') }}"
                                class="nav-link {{ (Request::segment(2) == 'import-emptrucker') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('msg.menu_jv_emptrucker_import') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jv-tranfer.import-file3') }}" class="nav-link {{ (Request::segment(2) == 'import-file3') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('msg.menu_jv_tranfer_import_file3') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jv-tranfer.import-file4') }}" class="nav-link {{ (Request::segment(2) == 'import-file4') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('msg.menu_jv_tranfer_import_file4') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jv-tranfer.import-file5') }}" class="nav-link {{ (Request::segment(2) == 'import-file5') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('msg.menu_jv_tranfer_import_file5') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jv-tranfer.import-file6') }}" class="nav-link {{ (Request::segment(2) == 'import-file6') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('msg.menu_jv_tranfer_import_file6') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jv-tranfer.report') }}" class="nav-link {{ (Request::segment(2) == 'report') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('msg.menu_deprate_daily') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jv-tranfer.report-tranfer-daily') }}" class="nav-link {{ (Request::segment(2) == 'report-tranfer-daily') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('msg.menu_transfer_daily') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jv-tranfer.report-accrue-daily') }}" class="nav-link {{ (Request::segment(2) == 'report-accrue-daily') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('msg.menu_accrue_daily_report') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ (Request::segment(1) == 'jv-payroll') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (Request::segment(1) == 'jv-payroll') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                            {{ __('msg.menu_jv_payroll') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('jv-payroll.import') }}" class="nav-link {{ (Request::segment(2) == 'payroll-import') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('msg.menu_jv_payroll_import') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jv-mapaccount.import') }}"
                                class="nav-link {{ (Request::segment(2) == 'mapaccount-import') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('msg.menu_mapaccount_import') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('jv-payroll.report') }}"
                                class="nav-link {{ (Request::segment(2) == 'report') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('msg.menu_report') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('export.index') }}" class="nav-link {{ (Request::segment(1) == 'export') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-export"></i>
                        <p>
                            {{ __('msg.menu_export') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('auth.logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            {{ __('msg.menu_logout') }}
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
