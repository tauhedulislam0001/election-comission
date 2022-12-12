<!-- Header Navbar -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <div class="app-menu">
        <ul class="header-megamenu nav">
            <li class="btn-group nav-item d-md-none">
                <a href="#" class="waves-effect waves-light nav-link push-btn btn-info-light" data-toggle="push-menu"
                    role="button">
                    <span class="glyphicon glyphicon-arrow-right"><span class="path1"></span><span class="path2"></span><span
                            class="path3"></span></span>
                </a>
            </li>
            <li class="btn-group nav-item d-none d-xl-inline-block">
                <div class="app-menu">
                    <div class="search-bx mx-5">
                        {{-- <form>
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="Search" aria-label="Search"
                                    aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn" type="submit" id="button-addon3"><i
                                            class="ti-search"></i></button>
                                </div>
                            </div>
                        </form> --}}
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <div class="navbar-custom-menu r-side">
        <ul class="nav navbar-nav">
            <li class="btn-group nav-item d-lg-inline-flex d-none">
                <a href="#" data-provide="fullscreen"
                    class="waves-effect waves-light nav-link full-screen btn-info-light" title="Full Screen">
                    <i class="icon-Expand-arrows"><span class="path1"></span><span class="path2"></span></i>
                </a>
            </li>
            <!-- Right Sidebar Toggle Button -->
            <li class="btn-group nav-item d-xl-none d-inline-flex">
                <a href="#" class="push-btn right-bar-btn waves-effect waves-light nav-link full-screen btn-info-light">
                    <span class="icon-Layout-left-panel-1"><span class="path1"></span><span class="path2"></span></span>
                </a>
            </li>
            <!-- User Account-->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle p-0 text-dark hover-primary ml-md-30 ml-10" data-toggle="dropdown"
                    title="{{ Auth::guard('admin')->user()->username }}">
                    <span class="pl-30 d-md-inline-block d-none">Hello,</span> <strong
                        class="d-md-inline-block d-none">{{ Auth::guard('admin')->user()->username }}</strong>
                    @if (Auth::guard('admin')->user()->avatar == !'')
                    <img src="{{ asset(Auth::guard('admin')->user()->avatar) }}"
                        class="user-image rounded-circle avatar bg-white mx-10" alt="User Image">
                    @elseif(Auth::guard('admin')->user()->profile_pic == '' && Auth::guard('admin')->user()->gender == 'female')
                    <img src="{{ asset('dashboard/admin/images/avatar/avatar_female.jpg') }}"
                        class="user-image rounded-circle avatar bg-white mx-10" alt="User Image">
                    @else
                    <img src="{{ asset('dashboard/admin/images/avatar/avatar_male.jpg') }}"
                        class="user-image rounded-circle avatar bg-white mx-10" alt="User Image">
                    @endif
                </a>
                <ul class="dropdown-menu animated flipInX">
                    <li class="user-body">
                        <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                                class="ti-user text-muted mr-2"></i>
                            My Profile</a>
                        <a class="dropdown-item" href="{{ route('admin.change-password') }}"><i
                                class="ti-lock text-muted mr-2"></i>Change Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="ti-lock text-muted mr-2"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    <li class="btn-group nav-item d-xl-none">
        <div class="app-menu">
            <div class="search-bx mx-5">
                <div class="wallet-balance">
                    @if (Auth::guard('admin')->user()->wallet_balance != '')
                    @if (Auth::guard('admin')->user()->wallet_balance >= 500)
                    <span class="badge badge-success" style="font-size: 15px"><b>Wallet Balance:
                            {{ Auth::guard('admin')->user()->wallet_balance }} {{
                            Auth::guard('admin')->user()->currency }}</b>
                    </span><br>
                    @if (Auth::guard('admin')->user()->user_type == 4 )
                    <span class="badge badge-info mt-5"
                        style="font-size: 15px; background-color:#1DB5EE; font-weight: bolder; width: 178px;">Refer
                        code : {{
                        Auth::guard('admin')->user()->agent_code }}</span>
                    @endif
                    @else
                    <span class="badge badge-success" style="font-size: 15px"><b>Wallet Balance:
                            {{ Auth::guard('admin')->user()->wallet_balance }} {{
                            Auth::guard('admin')->user()->currency }}</b></span>
                    <span class="text-primary">low balance!</span>
                    @if (Auth::guard('admin')->user()->user_type == 4 )
                    <span class="badge badge-info"
                        style="font-size: 15px; background-color:#1DB5EE; font-weight: bolder; width: 178px;">Refer
                        code : {{
                        Auth::guard('admin')->user()->agent_code }}</span>
                    @endif
                    @endif
                    @endif
                </div>
                {{-- <form>
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Search" aria-label="Search"
                            aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn" type="submit" id="button-addon3"><i
                                    class="ti-search"></i></button>
                        </div>
                    </div>
                </form> --}}
            </div>
        </div>
    </li>
</nav>