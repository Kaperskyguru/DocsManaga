<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'DocsManaga | ') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{asset('css/css/animate.css')}}">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{asset('css/css/icomoon.css')}}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{asset('css/css/bootstrap.css')}}">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{asset('css/css/magnific-popup.css')}}">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('css/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/css/owl.theme.default.min.css')}}">

    <!-- Theme style  -->
    <link rel="stylesheet" href="{{asset('css/css/style.css')}}">

    <!-- Modernizr JS -->
    <script src="{{asset('js/js/modernizr-2.6.2.min.js')}}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
    <![endif]-->

    {{--
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {{--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

</head>

<body>

    <div class="colorlib-loader"></div>

    <div id="page">
        <nav class="colorlib-nav" role="navigation">
            <div class="top-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <div id="colorlib-logo"><a href="/">DocsManaga</a></div>
                        </div>
                        <div class="col-md-10 text-right menu-1">
                            <ul>
                                <li class="active"><a href="/">Home</a></li>
                                <li><a href="{{route('services')}}">Services</a></li>
                                <li><a href="{{route('about')}}">About</a></li>
                                <li><a href="{{route('contact')}}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>






        @yield('content')








        <footer id="colorlib-footer">
            <div class="container">
                <div class="row row-pb-md">
                    <div class="col-md-4 colorlib-widget">
                        <h4>About DocsManaga</h4>
                        <p>Far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in
                            Bookmarksgrove right at the coast of the Semantics</p>
                        <p>
                            <ul class="colorlib-social-icons">
                                <li><a href="#"><i class="icon-twitter"></i></a></li>
                                <li><a href="#"><i class="icon-facebook"></i></a></li>
                                <li><a href="#"><i class="icon-linkedin"></i></a></li>
                                <li><a href="#"><i class="icon-dribbble"></i></a></li>
                            </ul>
                        </p>
                    </div>
                    <div class="col-md-4 colorlib-widget">
                        <h4>Information</h4>
                        <p>
                            <ul class="colorlib-footer-links">
                                <li><a href="#"><i class="icon-check"></i> Home</a></li>
                                <li><a href="#"><i class="icon-check"></i> Gallery</a></li>
                                <li><a href="#"><i class="icon-check"></i> About</a></li>
                                <li><a href="#"><i class="icon-check"></i> Blog</a></li>
                                <li><a href="#"><i class="icon-check"></i> Contact</a></li>
                                <li><a href="#"><i class="icon-check"></i> Privacy</a></li>
                            </ul>
                        </p>
                    </div>

                    {{-- <div class="col-md-3 colorlib-widget">
                        <h4>Recent Blog</h4>
                        <div class="f-blog">
                            <a href="blog.html" class="blog-img" style="background-image: url(images/blog-1.jpg);">
                        </a>
                            <div class="desc">
                                <h2><a href="blog.html">Photoshoot Technique</a></h2>
                                <p class="admin"><span>30 March 2018</span></p>
                            </div>
                        </div>
                        <div class="f-blog">
                            <a href="blog.html" class="blog-img" style="background-image: url(images/blog-2.jpg);">
                        </a>
                            <div class="desc">
                                <h2><a href="blog.html">Camera Lens Shoot</a></h2>
                                <p class="admin"><span>30 March 2018</span></p>
                            </div>
                        </div>
                        <div class="f-blog">
                            <a href="blog.html" class="blog-img" style="background-image: url(images/blog-3.jpg);">
                        </a>
                            <div class="desc">
                                <h2><a href="blog.html">Imahe the biggest photography studio</a></h2>
                                <p class="admin"><span>30 March 2018</span></p>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-md-4 colorlib-widget">
                        <h4>Contact Info</h4>
                        <ul class="colorlib-footer-links">
                            <li>KM. 10 Idiroko Road, <br />Canaan Land, Ota, Ogun State,Nigeria</li>
                            <li><a href="tel://1234567920"><i class="icon-phone"></i>+234 903 355 0046<br />+234 903 355 0049</a></li>
                            <li><a href="mailto:info@yoursite.com"><i class="icon-envelope"></i> VC: vc@covenantuniversity.edu.ng <br />Registrar: registrar@covenantuniversity.edu.ng</a></li>
                            <li><a href="http://m.covenantuniversity.edu.ng"><i class="icon-location4"></i>covenantuniversity.edu.ng</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
    </div>

    <!-- jQuery -->
    <script src="{{asset('js/js/jquery.min.js')}}"></script>
    <!-- jQuery Easing -->
    <script src="{{asset('js/js/jquery.easing.1.3.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('js/js/bootstrap.min.js')}}"></script>
    <!-- Waypoints -->
    <script src="{{asset('js/js/jquery.waypoints.min.js')}}"></script>
    <!-- Stellar Parallax -->
    <script src="{{asset('js/js/jquery.stellar.min.js')}}"></script>
    <!-- YTPlayer -->
    <script src="{{asset('js/js/jquery.mb.YTPlayer.min.js')}}"></script>
    <!-- Owl carousel -->
    <script src="{{asset('js/js/owl.carousel.min.js')}}"></script>
    <!-- Magnific Popup -->
    <script src="{{asset('js/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('js/js/magnific-popup-options.js')}}"></script>
    <!-- Counters -->
    <script src="{{asset('js/js/jquery.countTo.js')}}"></script>
    <!-- Main -->
    <script src="{{asset('js/js/main.js')}}"></script>

    @yield('scripts')

</body>

</html>