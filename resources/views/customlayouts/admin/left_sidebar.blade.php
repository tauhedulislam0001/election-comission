@php
$user = Auth::guard('admin')->user();
@endphp
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">

                    {{-- Dashboard --}}

                    @if ($user->can('dashboard.view'))
                    <li class="@yield('dashboard')">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="glyphicon glyphicon-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @endif

                    {{-- User Management --}}

                    @if ($user->can('permission.create') || $user->can('permission.view') ||
                    $user->can('permission.edit') || $user->can('permission.delete') || $user->can('permission.approve')
                    || $user->can('role.create') || $user->can('role.view') || $user->can('role.edit') ||
                    $user->can('role.delete') || $user->can('role.approve') ||
                    $user->can('user.create') || $user->can('user.view') || $user->can('user.edit')
                    || $user->can('user.delete'))
                    <li class="treeview @yield('Manage-user')">
                        <a href="#">
                            <i class="icon-Group">
                                <span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            <span>User Management</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">

                            @if ($user->can('permission.create') || $user->can('permission.view') ||
                            $user->can('permission.edit') || $user->can('permission.delete') ||
                            $user->can('permission.approve') || $user->can('role.create') ||
                            $user->can('role.view') || $user->can('role.edit'))
                            <li class="treeview">

                                {{-- Role Management system --}}

                                <a href="#">
                                    <i class="icon-Commit"><span class="path1 wrap-role"></span><span
                                            class="path2"></span></i>Role & Permission
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">

                                    {{-- Permissions --}}

                                    @if ($user->can('permission.create') || $user->can('permission.view') ||
                                    $user->can('permission.edit') || $user->can('permission.delete') ||
                                    $user->can('permission.approve'))
                                    <li class="@yield('manage-user.permission-list')">
                                        <a href="{{ route('permissions.index') }}">
                                            <i class="icon-Commit">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>Permissions</a>
                                    </li>
                                    @endif

                                    {{-- Roles --}}

                                    @if ($user->can('role.create') || $user->can('role.view') || $user->can('role.edit')
                                    ||
                                    $user->can('role.delete') || $user->can('role.approve'))
                                    <li class="@yield('manage-user.roles')">
                                        <a href="{{ route('roles.index') }}"><i class="icon-Commit">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>Roles</a>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                            @endif

                            {{-- Garibook Admin User --}}

                            @if ($user->can('user.create') || $user->can('user.view') || $user->can('user.edit')
                            || $user->can('user.delete'))
                            <li class="treeview">

                                {{-- Garibook Admin User --}}

                                @if ($user->can('user.create') || $user->can('user.view') || $user->can('user.edit')
                                    ||
                                    $user->can('user.delete') || $user->can('user_sole_distributor.credit_form'))
                                    <li class="@yield('manage-user.user-details')">
                                        <a href="{{ route('user.index') }}"><i class="icon-Commit">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>Users</a>
                                        </a>
                                    </li>
                                @endif
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    {{-- Visit Site --}}

                    @if ($user->can('visit_site.view'))
                    <li class="@yield('message')">
                        <a href="{{ route('message.index') }}" class="garibook-home" style="margin-top: 8px">
                            <i class="glyphicon glyphicon-comment"></i>
                            <span class="position-wrap">Message</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </section>
</aside>