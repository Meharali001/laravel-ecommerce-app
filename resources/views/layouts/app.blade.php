<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    {{-- <meta nsssame="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <title>My App</title>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="au theme template">
        <meta name="author" content="Hau Nguyen">
        <meta name="keywords" content="au theme template">
    
        <!-- Title Page-->
        <title>Dashboard</title>
    
        <!-- Fontfaces CSS-->
        <link href="{{ asset('assets/admin/css/font-face.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('assets/admin/vendor/font-awesome-4.7/css/font-awesome.min.css')  }}" rel="stylesheet" media="all">
        <link href="{{ asset('assets/admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('assets/admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
    
        <!-- Bootstrap CSS-->
        <link href="{{ asset('assets/admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
    
        <!-- Vendor CSS-->
        <link href="{{ asset('assets/admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('assets/admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
        
        <link href="{{ asset('assets/admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('assets/admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('assets/admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('assets/admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ asset('assets/admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">
    
        <!-- Main CSS-->
        <link href="{{ asset('assets/admin/css/theme.css') }}" rel="stylesheet" media="all">
        <!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> --}}
    @livewireStyles
   
</head>
<body class="animsition">
    <div class="page-wrapper">
                <!-- HEADER MOBILE-->
                <header class="header-mobile d-block d-lg-none">
                    <div class="header-mobile__bar">
                        <div class="container-fluid">
                            <div class="header-mobile-inner">
                                <a class="logo" href="index.html">
                                    <img src="{{ asset('assets/admin/images/icon/logo.png')}}" alt="CoolAdmin" />
                                </a>
                                <button class="hamburger hamburger--slider" type="button">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <nav class="navbar-mobile">
                        <div class="container-fluid">
                            <ul class="navbar-mobile__list list-unstyled">
                                <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                        <li>
                                            <a href="index.html">Dashboard 1</a>
                                        </li>
                                        <li>
                                            <a href="index2.html">Dashboard 2</a>
                                        </li>
                                        <li>
                                            <a href="index3.html">Dashboard 3</a>
                                        </li>
                                        <li>
                                            <a href="index4.html">Dashboard 4</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="chart.html">
                                        <i class="fas fa-chart-bar"></i>Charts</a>
                                </li>
                                <li>
                                    <a href="table.html">
                                        <i class="fas fa-table"></i>Tables</a>
                                </li>
                                <li>
                                    <a href="form.html">
                                        <i class="far fa-check-square"></i>Forms</a>
                                </li>
                                <li>
                                    <a href="calendar.html">
                                        <i class="fas fa-calendar-alt"></i>Calendar</a>
                                </li>
                                <li>
                                    <a href="map.html">
                                        <i class="fas fa-map-marker-alt"></i>Maps</a>
                                </li>
                                <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa-copy"></i>Pages</a>
                                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                        <li>
                                            <a href="login.html">Login</a>
                                        </li>
                                        <li>
                                            <a href="register.html">Register</a>
                                        </li>
                                        <li>
                                            <a href="forget-pass.html">Forget Password</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-sub">
                                    <a class="js-arrow" href="#">
                                        <i class="fas fa-desktop"></i>UI Elements</a>
                                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                        <li>
                                            <a href="button.html">Button</a>
                                        </li>
                                        <li>
                                            <a href="badge.html">Badges</a>
                                        </li>
                                        <li>
                                            <a href="tab.html">Tabs</a>
                                        </li>
                                        <li>
                                            <a href="card.html">Cards</a>
                                        </li>
                                        <li>
                                            <a href="alert.html">Alerts</a>
                                        </li>
                                        <li>
                                            <a href="progress-bar.html">Progress Bars</a>
                                        </li>
                                        <li>
                                            <a href="modal.html">Modals</a>
                                        </li>
                                        <li>
                                            <a href="switch.html">Switchs</a>
                                        </li>
                                        <li>
                                            <a href="grid.html">Grids</a>
                                        </li>
                                        <li>
                                            <a href="fontawesome.html">Fontawesome Icon</a>
                                        </li>
                                        <li>
                                            <a href="typo.html">Typography</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
                <!-- END HEADER MOBILE-->
        <livewire:admin.sidebar />

    <div class="page-container">
        <livewire:admin.header />

    <!-- Main Content -->
    <div class="container mt-4">
        {{ $slot }}
    </div>

    @livewireScripts
    </div>
    </div>
        <!-- Jquery JS-->
        <script src="{{ asset('assets/admin/vendor/jquery-3.2.1.min.js') }}"></script>
        <!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!-- Bootstrap JS-->
        <script src="{{ asset('assets/admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
        {{-- <script src="{{ asset('assets/adminv/endor/bootstrap-4.1/bootstrap.min.js') }}"></script> --}}
        <script src="{{ asset('assets/admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
        <!-- Vendor JS       -->
        <script src="{{ asset('assets/admin/vendor/slick/slick.min.js') }}">
        </script>
        <script src="{{ asset('assets/admin/vendor/wow/wow.min.js') }}"></script>
        <script src="{{ asset('assets/admin/vendor/animsition/animsition.min.js') }}"></script>
        <script src="{{ asset('assets/admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
        

        </script>
        <script src="{{ asset('assets/admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/admin/vendor/counter-up/jquery.counterup.min.js') }}">
        </script>
        <script src="{{ asset('assets/admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
        <script src="{{ asset('assets/admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('assets/admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/admin/vendor/select2/select2.min.js') }}">
        </script>
    
        <!-- Main JS-->
        <script src="{{ asset('assets/admin/js/main.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Livewire.on('showMessage', (message, type = 'success') => {
                    if (type === 'success') {
                        toastr.success(message);
                    } else {
                        toastr.error(message);
                    }
                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Livewire.on('showToastr', (type, message) => {
                    toastr[type](message);
                });
            });
        </script>

        
</body>
</html>
