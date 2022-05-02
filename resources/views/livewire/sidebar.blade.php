<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-navy elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.index') }}" class="brand-link navbar-warning">
        <img src="{{ url('resources/assets') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-light"><i>{{ __('msg.sys_name') }}</i></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('resources/assets') }}/dist/img/user2-160x160.jpg" class="img-circle"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->username }}</a>
                <a href="#" class="d-block"><small>{{ Auth::user()->full_name }}</small></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('msg.menu_dashboard') }}
                        </p>
                    </a>
                </li>
                @if (!empty($menu))
                    @foreach ($menu as $item)
                        @if ($item->menu_link == '')
                            @if (count($item->get_sub_menu) > 0)
                                <li
                                    class="nav-item {{ Request::segment(1) == $item->menu_section ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ Request::segment(1) == $item->menu_section ? 'active' : '' }}">
                                        {!! $item->menu_icon !!}
                                        <p>
                                            {{ $item->menu_name }}
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    @if (!empty($item->get_sub_menu))
                                        @foreach ($item->get_sub_menu as $item2)
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="{{ url($item2->menu_link) }}"
                                                        class="nav-link {{ Request::segment(2) == explode('/', $item2->menu_link)[1] ? 'active' : '' }}">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>{{ $item2->menu_name }}</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endforeach
                                        @if ($item->menu_section == 'pay-slip')
                                            <ul class="nav nav-treeview">
                                                <li class="nav-item">
                                                    <a href="{{ url('payslip') }}" target="_blank"
                                                        class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Print Slip</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    @endif
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a href="{{ url($item->menu_link) }}"
                                    class="nav-link {{ Request::segment(1) == $item->menu_link ? 'active' : '' }}">
                                    {!! $item->menu_icon !!}
                                    <p>
                                        {{ $item->menu_name }}
                                    </p>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
                {{-- @if (Auth::user()->hr_role == 'yes')
                    <li class="nav-item">
                        <a href="{{ route('print-slip.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-print"></i>
                            <p>
                                {{ __('msg.menu_print_slip') }}
                            </p>
                        </a>
                    </li>
                @endif --}}

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
