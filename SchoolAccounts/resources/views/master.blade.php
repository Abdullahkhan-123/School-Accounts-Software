<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>TechHize - School Accounts Software</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    <link href="{{ asset('vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/css/fullcalendar.min.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
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
            <a href="{{ route('dashboard') }}" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('images/logo.png') }}" alt="">
                <img class="logo-compact" src="{{ asset('images/logo-text.png') }}" alt="">
                <img class="brand-title" src="{{ asset('images/logo-text.png') }}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <!-- <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div> -->
                        </div>

                        <ul class="navbar-nav header-right">
                            <!-- <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="danger"><i class="ti-bookmark"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Robin</strong> marked a <strong>ticket</strong> as unsolved.
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-heart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-image"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong> James.</strong> has added a<strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i
                                            class="ti-arrow-right"></i></a>
                                </div>
                            </li> -->
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="app-profile.html" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="email-inbox.html" class="dropdown-item">
                                        <i class="icon-envelope-open"></i>
                                        <span class="ml-2">Inbox </span>
                                    </a>
                                    <a href="{{ route('Logout') }}" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">

                    <li class="nav-label first">Main Menu</li>

                            @if(Session::has('AccountType') != 'Accountant')

                                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                            class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                                    <ul aria-expanded="false">
                                        <li><a href="{{ route('dashboard') }}">Charts</a></li>
                                    </ul>
                                </li>

                                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                            class="icon icon-single-04"></i><span class="nav-text">Academy Details</span></a>
                                    <ul aria-expanded="false">
                                        <li><a href="{{ route('ViewAllClasses') }}">Manage Classes</a></li>
                                        <li><a href="{{ route('ViewAllStudent') }}">Admit Student</a></li>
                                    </ul>
                                </li>
                                
                                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                            class="icon icon-single-04"></i><span class="nav-text">Expense</span></a>
                                    <ul aria-expanded="false">
                                        <li><a href="{{ route('AllUtlityExpenseCategory') }}">Expense Category</a></li>
                                        <li><a href="{{ route('AllManageUtlityExpense') }}">Expense Manage</a></li>
                                        <li><a href="{{ route('UtlityExpenseReport') }}">Expense Report</a></li>
                                    </ul>
                                </li>

                                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                            class="icon icon-single-04"></i><span class="nav-text">Liability</span></a>
                                    <ul aria-expanded="false">
                                        <li><a href="{{ route('AllExpenseCategory') }}">Liability Category</a></li>
                                        <li><a href="{{ route('AllManageExpense') }}">Liability Manage</a></li>
                                        <li><a href="{{ route('Expense_Report') }}">Liability Report</a></li>
                                    </ul>
                                </li>
                            

                                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                            class="icon icon-single-04"></i><span class="nav-text">Assets</span></a>
                                    <ul aria-expanded="false">
                                        <li><a href="{{ route('AllAssetsCategories') }}">Assets Category</a></li>
                                        <li><a href="{{ route('AllAssetsManage') }}">Assets Manage</a></li>
                                        <li><a href="{{ route('AssetsReport') }}">Assets Report</a></li>
                                    </ul>
                                </li>

                                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                            class="icon icon-single-04"></i><span class="nav-text">Bank Account Manage</span></a>
                                    <ul aria-expanded="false">
                                        <li><a href="{{ route('AllBankAccounts') }}">Bank Accounts</a></li>
                                    </ul>
                                </li>

                                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                            class="icon icon-single-04"></i><span class="nav-text">Staff Manage</span></a>
                                    <ul aria-expanded="false">
                                        <li><a href="{{ route('ViewStaffAccount') }}">Staff Accounts</a></li>
                                        <li><a href="{{ route('AllEmployeeSalaries') }}">Staff Salary</a></li>
                                    </ul>
                                </li>

                                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                            class="icon icon-single-04"></i><span class="nav-text">Student Manage</span></a>
                                    <ul aria-expanded="false">
                                        <li><a href="{{ route('AllFeesCategory') }}">Fees Manage</a></li>                                        
                                        <li><a href="{{ route('StudentFees') }}">Student Fees</a></li>
                                        <li><a href="{{ route('MakeStudentsPayment') }}">Generate Fees</a></li>
                                    </ul>
                                </li>

                                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                            class="icon icon-single-04"></i><span class="nav-text"> Reports</span></a>
                                    <ul aria-expanded="false">

                                        <li><a href="{{ route('ProfitLossStatements') }}">Profit and Loss Statements</a></li>
                                        
                                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                                class="icon icon-single-04"></i><span class="nav-text">SOFP</span></a>
                                            <ul aria-expanded="false">
                                                <li><a href="{{ route('BalanceSheet') }}">Balance Sheet</a></li>
                                            </ul>
                                        </li>
                                        
                                        <li><a href="{{ route('CashFlowStatement') }}">CashFlow Statement</a></li>
                                    </ul>
                                </li>

                                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                            class="icon icon-single-04"></i><span class="nav-text">Audit Trails</span></a>
                                    <ul aria-expanded="false">
                                        <li><a href="{{ route('TransactionLogs') }}">Transaction Logs</a></li>
                                    </ul>
                                </li>
                                
                            
                            @else
                                <li><a href="{{ route('AllManageExpense') }}">Liability Manage Expense</a></li>
                                <li><a href="{{ route('MakeStudentsPayment') }}">Generate Fees</a></li>
                                <li><a href="{{ route('StudentFees') }}">Student Fees</a></li>
                            @endif
                        
                        
                </ul>
            </div>


        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        @yield('content')        

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
                <p>Distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a></p> 
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/quixnav-init.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>


    <!-- Vectormap -->
    <script src="{{ asset('vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('vendor/morris/morris.min.js') }}"></script>


    <script src="{{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js') }}/Chart.bundle.min.js') }}"></script>

    <script src="{{ asset('vendor/gaugeJS/dist/gauge.min.js') }}"></script>

    <!--  flot-chart js -->
    <script src="{{ asset('vendor/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('vendor/flot/jquery.flot.resize.js') }}"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>

    <!-- Counter Up -->
    <script src="{{ asset('vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>
    
    <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>



    <script src="{{ asset('js/styleSwitcher.js') }}"></script>

    <script src="{{ asset('vendor/jqueryui/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>

    <script src="{{ asset('vendor/fullcalendar/js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/fullcalendar-init.js') }}"></script>

</body>

</html>