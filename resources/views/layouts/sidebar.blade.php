<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name', 'Pipsotrade') }}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('app_assets/images/favicon.png')}}">
    <!-- Pignose Calender -->
    <link href="{{ asset('app_assets/plugins/pg-calendar/css/pignose.calendar.min.css')}}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('app_assets/plugins/chartist/css/chartist.min.css')}}">
    <link rel="stylesheet" href="{{ asset('app_assets/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css')}}">
    <!-- Custom Stylesheet -->  
    <link href="{{ asset('app_assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('app_assets/plugins/jquery-steps/css/jquery.steps.css')}}" rel="stylesheet">
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="/home">
                    <b class="logo-abbr"><img src="{{ asset('app_assets/images/logo.png')}}" alt=""> </b>
                    <span class="logo-compact"><img src="{{ asset('app_assets/images/logo-compact.png')}}" alt=""></span>
                    <span class="brand-title">
                        <img src="{{ asset('app_assets/images/logo-compact.png')}}" width="150" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">                       
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{ asset('app_assets/images/user/form-user.png')}}" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="/profile"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf                                        
                                        <li class="text-danger"><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                            <i class="icon-key"></i>
                                            <span class="text-danger">Logout</span></a>
                                        </li>
                                        </form>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">{{Auth::user()->name}}</li>
                    <li>
                        <a href="/home" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/select-deposit" aria-expanded="false">
                            <i class="icon-basket menu-icon"></i><span class="nav-text">Deposit</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-wallet menu-icon"></i><span class="nav-text">Investments</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/investments">Active</a></li>
                            <li><a href="/investment-history">History</a></li> 
                        </ul>
                    </li>   
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-briefcase menu-icon"></i><span class="nav-text">Withdrawal</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/mywithdrawals">Pending</a></li>
                            <li><a href="/withdrawal-history">History</a></li> 
                        </ul>
                    </li>
                    <li>
                        <a href="/referrals" aria-expanded="false">
                            <i class="icon-people menu-icon"></i><span class="nav-text">Referrals</span>
                        </a>
                    </li>
                    <li>
                        <a href="/bonus" aria-expanded="false">
                            <i class="icon-diamond menu-icon"></i><span class="nav-text">Bonus</span>
                        </a>
                    </li>
                    <li>
                        <a href="/profile" aria-expanded="false">
                            <i class="icon-user menu-icon"></i><span class="nav-text">Profile</span>
                        </a>
                    </li>
                    @if(Auth::user()->role=="Admin")
                    <hr>
                    <li>
                        <a href="/all-bonuses" aria-expanded="false">
                            <i class="icon-rocket menu-icon"></i><span class="nav-text">Bonuses</span>
                        </a>
                    </li>
                    <li>
                        <a href="/all-investments" aria-expanded="false">
                            <i class="icon-rocket menu-icon"></i><span class="nav-text">Investments</span>
                        </a>
                    </li>
                    <li>
                        <a href="/deposits" aria-expanded="false">
                            <i class="icon-rocket menu-icon"></i><span class="nav-text">Deposits</span>
                        </a>
                    </li>
                    <li>
                        <a href="/withdrawals" aria-expanded="false">
                            <i class="icon-rocket menu-icon"></i><span class="nav-text">Withdrawals</span>
                        </a>
                    </li>
                    <li>
                        <a href="/members" aria-expanded="false">
                            <i class="icon-rocket menu-icon"></i><span class="nav-text">Members</span>
                        </a>
                    </li>
                    <li>
                        <a href="/settings" aria-expanded="false">
                            <i class="icon-settings menu-icon"></i><span class="nav-text">Settings</span>
                        </a>
                    </li>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf 
                    <li>
                        <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                this.closest('form').submit();" 
                                aria-expanded="false">
                            <i class="icon-logout menu-icon text-danger"></i><span class="nav-text text-danger">Logout</span>
                        </a>
                    </li>
                    </form>              
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="container-fluid mt-3">
                @yield('content')
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https:pipsotrade.com">Pipsotrade</a> 2021</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!--Add the following script at the bottom of the web page (before </body></html>)-->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/611a8c3d649e0a0a5cd166ac/1fd7r7kgh';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('app_assets/plugins/common/common.min.js') }}" defer></script>
    <script src="{{ asset('app_assets/js/custom.min.js') }}" defer></script>
    <script src="{{ asset('app_assets/js/settings.js') }}" defer></script>
    <script src="{{ asset('app_assets/js/gleek.js') }}" defer></script>
    <script src="{{ asset('app_assets/js/styleSwitcher.js') }}" defer></script>
    <!-- Chartjs -->
    <script src="{{ asset('app_assets/plugins/chart.js/Chart.bundle.min.js') }}" defer></script>
    <!-- Circle progress -->
    <script src="{{ asset('app_assets/plugins/circle-progress/circle-progress.min.js') }}" defer></script>
    <!-- Datamap -->
    <script src="{{ asset('app_assets/plugins/d3v3/index.js') }}" defer></script>
    <script src="{{ asset('app_assets/plugins/topojson/topojson.min.js') }}" defer></script>
    <script src="{{ asset('app_assets/plugins/datamaps/datamaps.world.min.js') }}" defer></script>
    <!-- Morrisjs -->
    <script src="{{ asset('app_assets/plugins/raphael/raphael.min.js') }}" defer></script>
    <script src="{{ asset('app_assets/plugins/morris/morris.min.js') }}" defer></script>
    <!-- Pignose Calender -->
    <script src="{{ asset('app_assets/plugins/moment/moment.min.js') }}" defer></script>
    <script src="{{ asset('app_assets/plugins/pg-calendar/js/pignose.calendar.min.js') }}" defer></script>
    <!-- ChartistJS -->
    <script src="{{ asset('app_assets/plugins/chartist/js/chartist.min.js') }}" defer></script>
    <script src="{{ asset('app_assets/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}" defer></script>

    <script src="{{ asset('app_assets/js/dashboard/dashboard-1.js') }}" defer></script>

    <script src="{{ asset('app_assets/plugins/jquery-steps/build/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('app_assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('app_assets/js/plugins-init/jquery-steps-init.js') }}"></script>

</body>

</html>