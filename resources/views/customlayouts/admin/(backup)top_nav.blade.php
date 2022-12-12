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
            @if(Auth::guard('admin')->user()->user_type == 1 or Auth::guard('admin')->user()->user_type == 2 or Auth::guard('admin')->user()->user_type == 4)
            <!-- Notifications -->
            <li class="dropdown notifications-menu">
                @if (App\WalletDeposit::getPendingCount() != null)
                <span class="label label-danger">
                    <span style="font-size: 9px"><b>{{App\WalletDeposit::getPendingCount()}}</b></span>
                </span>
                @endif
                <a href="#" class="waves-effect waves-light dropdown-toggle btn-danger-light" data-toggle="dropdown"
                    title="Notifications">
                    <i class="icon-Notifications"><span class="path1"></span><span class="path2"></span></i>
                </a>
                <ul class="dropdown-menu animated bounceIn">

                    <li class="header">
                        <div class="p-20">
                            <div class="flexbox">
                                <div>
                                    <h4 class="mb-0 mt-0">Wallet Request</h4>
                                </div>
                                <div>
                                    <a href="#" class="text-danger">Clear All</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu sm-scrol">
                            @php
                            $walletRequest = App\walletDeposit::where('status', 'Pending')->latest()->get();
                            @endphp
                            @if (App\walletDeposit::getPendingCount() != null)
                            @foreach ($walletRequest as $deposit)
                            <li>
                                <a href="{{ route('deposit.index') }}">
                                    <img src="{{ asset('dashboard/admin/images/dashboard_icon/pending_deposits.svg') }}"
                                        width="16px" alt="">
                                    {{$deposit->agent->username}} agent request for balance
                                </a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </li>
                    <li class="footer">
                        <a href="{{ route('notification-wallet-request') }}">View all</a>
                    </li>
                </ul>
            </li>
            @endif

            @if(Auth::guard('admin')->user()->user_type == 1 or Auth::guard('admin')->user()->user_type == 2)
            <!-- Notifications -->
            <li class="dropdown notifications-menu">
                @if (App\AdminUser::statusCount() != '')
                <span class="label label-danger">
                    <span style="font-size: 9px"><b>{{App\AdminUser::statusCount()}}</b></span>
                </span>
                @endif
                <a href="#" class="waves-effect waves-light dropdown-toggle btn-danger-light" data-toggle="dropdown"
                    title="User">
                    <i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
                </a>
                <ul class="dropdown-menu animated bounceIn">

                    <li class="header">
                        <div class="p-20">
                            <div class="flexbox">
                                <div>
                                    <h4 class="mb-0 mt-0">Agent Request</h4>
                                </div>
                                <div>
                                    <a href="#" class="text-danger">Clear All</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu sm-scrol">
                            @php
                            $user_type = Auth::guard('admin')->user()->user_type;
                            if ($user_type == 1 or $user_type == 2) {
                            $agentRequest = App\AdminUser::whereIn('user_type', [7, 8])->where('status', '=',
                            0)->latest()->get();
                            }
                            @endphp
                            @if (App\AdminUser::statusCount() != null)
                            @foreach ($agentRequest as $agent)
                            <li>
                                <a href="{{ route('beagent-request.index') }}">
                                    <img src="{{ asset('dashboard/admin/images/dashboard_icon/agent_request.svg') }}"
                                        width="9px" alt="">
                                    {{$agent->username}} has sent agent request
                                </a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </li>
                    <li class="footer">
                        <a href="{{ route('notification-agent-request') }}">View all</a>
                    </li>
                </ul>
            </li>
            @endif

            {{-- @if(Auth::guard('admin')->user()->user_type == 1 or Auth::guard('admin')->user()->user_type == 4)
            <!-- Notifications -->
            <li class="dropdown notifications-menu">
                @if (App\CarBook::carbookStatus() != null)
                <span class="label label-danger">
                    <span style="font-size: 9px"><b>{{App\WalletDeposit::getPendingCount()}}</b></span>
                </span>
                @endif
                <a href="#" class="waves-effect waves-light dropdown-toggle btn-danger-light" data-toggle="dropdown"
                    title="Notifications">
                    <i class="icon-Notifications"><span class="path1"></span><span class="path2"></span></i>
                </a>
                <ul class="dropdown-menu animated bounceIn">

                    <li class="header">
                        <div class="p-20">
                            <div class="flexbox">
                                <div>
                                    <h4 class="mb-0 mt-0">Booking Request</h4>
                                </div>
                                <div>
                                    <a href="#" class="text-danger">Clear All</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu sm-scrol">
                            @if (App\CarBook::carbookStatus() != null)
                            @foreach ($bookingStatus as $row)
                            <li>
                                <a href="{{ route('deposit.index') }}">
                                    <i class="fa fa-id-card text-info"></i>
                                    {{$row->status}}
                                </a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </li>
                    <li class="footer">
                        <a href="{{ route('notification-booking-request') }}">View all</a>
                    </li>
                </ul>
            </li>
            @endif --}}

            <!-- Messages -->
            {{-- <li class="dropdown messages-menu">
                <span class="label label-danger">5</span>
                <a href="#" class="dropdown-toggle btn-danger-light" data-toggle="dropdown" title="Messages">
                    <i class="icon-Incoming-mail"><span class="path1"></span><span class="path2"></span></i>
                </a>
                <ul class="dropdown-menu animated bounceIn">

                    <li class="header">
                        <div class="p-20">
                            <div class="flexbox">
                                <div>
                                    <h4 class="mb-0 mt-0">Messages</h4>
                                </div>
                                <div>
                                    <a href="#" class="text-danger">Clear All</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu sm-scrol">
                            <li>
                                <!-- start message -->
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="images/user2-160x160.jpg" class="rounded-circle" alt="User Image">
                                    </div>
                                    <div class="mail-contnet">
                                        <h4>
                                            Lorem Ipsum
                                            <small><i class="fa fa-clock-o"></i> 15 mins</small>
                                        </h4>
                                        <span>Lorem ipsum dolor sit amet, consectetur adipiscing
                                            elit.</span>
                                    </div>
                                </a>
                            </li>
                            <!-- end message -->
                            <li>
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="images/user3-128x128.jpg" class="rounded-circle" alt="User Image">
                                    </div>
                                    <div class="mail-contnet">
                                        <h4>
                                            Nullam tempor
                                            <small><i class="fa fa-clock-o"></i> 4 hours</small>
                                        </h4>
                                        <span>Curabitur facilisis erat quis metus congue viverra.</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="images/user4-128x128.jpg" class="rounded-circle" alt="User Image">
                                    </div>
                                    <div class="mail-contnet">
                                        <h4>
                                            Proin venenatis
                                            <small><i class="fa fa-clock-o"></i> Today</small>
                                        </h4>
                                        <span>Vestibulum nec ligula nec quam sodales rutrum sed
                                            luctus.</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="images/user3-128x128.jpg" class="rounded-circle" alt="User Image">
                                    </div>
                                    <div class="mail-contnet">
                                        <h4>
                                            Praesent suscipit
                                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                        </h4>
                                        <span>Curabitur quis risus aliquet, luctus arcu nec, venenatis
                                            neque.</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="pull-left">
                                        <img src="images/user4-128x128.jpg" class="rounded-circle" alt="User Image">
                                    </div>
                                    <div class="mail-contnet">
                                        <h4>
                                            Donec tempor
                                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                                        </h4>
                                        <span>Praesent vitae tellus eget nibh lacinia pretium.</span>
                                    </div>

                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="footer">
                        <a href="#">See all e-Mails</a>
                    </li>
                </ul>
            </li> --}}
            <!-- Control Sidebar Toggle Button -->
            {{-- <li class="btn-group nav-item">
                <span class="label label-primary">5</span>
                <a href="#" data-toggle="control-sidebar" title="Setting"
                    class="waves-effect waves-light nav-link full-screen btn-primary-light">
                    <i class="icon-Settings-2"></i>
                </a>
            </li> --}}
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