
    @include('layouts.header')
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link {{ is_collapsed_route('dashboard') }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>{{__('auth._dashboard')}}</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-heading">{{__('roles.user_management')}}</li>  
            {{-- roles permission      --}}
            <li class="nav-item">
                <a class="nav-link {{ is_collapsed_tab(['role.index', 'user-permission']) }}
                    " data-bs-target="#role-navigation-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>{{__('roles.roles_permission')}}</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="role-navigation-nav" class="nav-content  {{ is_collapse_tab(['role.index', 'user-permission']) }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="{{ is_active_route('role.index') }}" href="{{ route('role.index') }}">
                            <i class="bi bi-circle"></i><span>{{__('roles.role_mgt')}}</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ is_active_route('user-permission') }}" href="{{ route('user-permission') }}">
                            <i class="bi bi-circle"></i><span>{{__('roles.user_permission')}}</span>
                        </a>
                    </li>
                </ul>
            </li>  
            {{-- users    --}}
            <li class="nav-item">
                <a class="nav-link {{ is_collapsed_tab(['user.index',]) }}
                    "data-bs-target="#user-navigation-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-people-fill"></i><span>{{__('roles._users')}}</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="user-navigation-nav" class="nav-content  {{ is_collapse_tab(['user.index',]) }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="{{ is_active_route('user.index') }}" href="{{ route('user.index') }}">
                            <i class="bi bi-circle"></i><span>{{__('roles.user_index')}}</span>
                        </a>
                    </li>
                </ul>
            </li>
            

            <li class="nav-heading">{{__('auth._pages')}}</li>
            <li class="nav-item">
                <a class="nav-link {{ is_collapsed_route('profile.edit') }}" href="{{ route('profile.edit') }}">
                    <i class="bi bi-person"></i>
                    <span>{{__('auth.my_profile')}}</span>
                </a>
            </li><!-- End Profile user Nav -->


            <li class="nav-heading">{{__('roles._general_settings')}}</li>
            {{-- General Settings    --}}
            <li class="nav-item">
                <a class="nav-link {{ is_collapsed_tab(['setting.index', 'currency.index']) }}
                    " data-bs-target="#setting-navigation-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gear-fill"></i><span>{{__('roles._app_settings')}}</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="setting-navigation-nav" class="nav-content  {{ is_collapse_tab(['setting.index', 'currency.index']) }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="{{ is_active_route('setting.index') }}" href="{{ route('setting.index') }}">
                            <i class="bi bi-circle"></i><span>{{__('roles._basic')}}</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ is_active_route('currency.index') }}" href="{{ route('currency.index') }}">
                            <i class="bi bi-circle"></i><span>{{__('roles.currency')}}</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </aside><!-- End Sidebar-->
