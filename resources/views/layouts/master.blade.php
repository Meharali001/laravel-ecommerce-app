<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zay Shop eCommerce HTML CSS Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{asset('assets/user/img/apple-icon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/user/img/favicon.ico')}}">

    <link rel="stylesheet" href="{{asset('assets/user/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/templatemo.css')}}">
    <link rel="stylesheet" href="{{asset('assets/user/css/custom.css')}}">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
            <!-- Bootstrap CSS-->
    <link href="{{ asset('assets/admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{asset('assets/user/css/fontawesome.min.css')}}">
            <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        /* ---my css */
        img.pro-img {
        width: 350px !important;
        height: 300px !important;
        padding: 25px;
    }
    .icon-hover:hover {
            border-color: #3b71ca !important;
            background-color: white !important;
            color: #3b71ca !important;
          }
          
          .icon-hover:hover i {
            color: #3b71ca !important;
          }

          .testimonial-card .card-up {
  height: 120px;
  overflow: hidden;
  border-top-left-radius: 0.25rem;
  border-top-right-radius: 0.25rem;
}
.testimonial-card .avatar {
  width: 110px;
  margin-top: -60px;
  overflow: hidden;
  border: 3px solid #fff;
  border-radius: 50%;
}
    </style>
    {{-- <style>
    
        </style> --}}
        @livewireStyles   
</head>
<body class="animation">
    <livewire:user.header />

    {{-- <div class="container mt-4"> --}}
        {{ $slot }}
    {{-- </div> --}}

    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">X-Y-Z Shop</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            karachi-pakistan
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:010-020-0340">03112281568</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:info@company.com">meharali031122@gmail.com</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Products</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">Luxury</a></li>
                        <li><a class="text-decoration-none" href="#">Sport Wear</a></li>
                        <li><a class="text-decoration-none" href="#">Men's Shoes</a></li>
                        <li><a class="text-decoration-none" href="#">Women's Shoes</a></li>
                        <li><a class="text-decoration-none" href="#">Popular Dress</a></li>
                        <li><a class="text-decoration-none" href="#">Gym Accessories</a></li>
                        <li><a class="text-decoration-none" href="#">Sport Shoes</a></li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Further Info</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">Home</a></li>
                        <li><a class="text-decoration-none" href="#">About Us</a></li>
                        <li><a class="text-decoration-none" href="#">Shop Locations</a></li>
                        <li><a class="text-decoration-none" href="#">FAQs</a></li>
                        <li><a class="text-decoration-none" href="#">Contact</a></li>
                    </ul>
                </div>

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://github.com/Meharali001"><i class="fab fa-github fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/in/mohammed-hasnain-7aa110315/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2025 Company X-Y-Z 
                            | Designed by <a rel="sponsored" href="https://github.com/Meharali001" target="_blank">X-Y-Z</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    @livewireScripts
    <!-- Start Footer -->


    <!-- Start Script -->
    <script src="{{asset('assets/user/js/jquery-1.11.0.min.js')}}"></script>
    <script src="{{asset('assets/user/js/jquery-migrate-1.2.1.min.js')}}"></script>
    <script src="{{asset('assets/user/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/user/js/templatemo.js')}}"></script>
    <script src="{{asset('assets/user/js/custom.js')}}"></script>
        <!-- End Footer -->
        <script src="{{ asset('assets/admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- End Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>
