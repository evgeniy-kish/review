<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', 'Выбирайте рестораны, аптеки, кинотеатры и другие организации Москвы на основе реальных отзывов. На нашем сайте вы найдете фотографии, описание, рейтинг и честные отзывы.')">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'iRate – реальные отзывы о компаниях Москвы, популярных товарах, услугах и фильмах')</title>
    <link rel="icon" type="image/svg+xml" href="/img/core-img/logo.svg">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @stack('css')
</head>
<body>

<!-- Preloader -->
<div class="preloader" id="preloader">
    <div class="spinner-grow text-light" role="status"><span class="sr-only">Загрузка...</span></div>
</div>

<!-- Header Area -->
<header class="header-area {{ $h ?? '' }}">
    <div class="container">
        <div class="classy-nav-container breakpoint-off">
            <nav class="classy-navbar navbar2 justify-content-between" id="saasboxNav">
                <!-- Logo--><a class="nav-brand mr-5" href="/"><img src="@if(isset($h))/img/core-img/logo.png @else/img/core-img/logo-white.png @endif" alt=""></a>
                <!-- Navbar Toggler-->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span><span></span></span></div>
                <!-- Menu-->
                <div class="classy-menu">
                    <!-- close btn-->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start-->
                    <div class="classynav">
                        <ul id="corenav">
                            <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                            <li><a href="{{ route('reviews.index') }}">{{ __('Reviews') }}</a></li>
                            <li><a href="{{ route('blog.index') }}">{{ __('Blog') }}</a></li>
                            <li><a href="{{ route('introduce.index') }}">{{ __('Companies') }}</a></li>
                            <li><a href="{{ url('/contacts') }}">{{ __('Contacts') }}</a></li>
                        </ul>
                        <!-- Login Button-->
                        <div class="login-btn-area ml-4 mt-4 mt-lg-0">
                            @auth
                                @if(auth()->user()->isModerator())
                                    <a class="btn saasbox-btn btn-sm" href="{{ route('panel.index') }}">{{ __('To panel') }}</a>
                                @else
                                    <a class="btn saasbox-btn btn-sm" href="{{ route('cabinet.index') }}">{{ __('Cabinet') }}</a>
                                @endif
                            @else
                                <a class="btn saasbox-btn btn-sm" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    @isset($search)
        <div class="container mb-4">
            <div class="row height d-flex justify-content-center align-items-center">
                <div class="col-12">
                    <form action="{{ route('search') }}" method="get">
                        <div class="form">
                            <i class="fa fa-search"></i>
                            <!--suppress HtmlFormInputWithoutLabel -->
                            <input type="text" name="text" class="form-control form-input" value="{{ request('text') }}" placeholder="{{ __('Search...') }}" required>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endisset
</header>

@yield('content')

<!-- Cookie Alert Area-->
{{--
<div class="cookiealert mb-0" role="alert">
    <p>This site uses cookies. We use cookies to ensure you get the best experience on our website. For details, please check our <a href="#" target="_blank"> Privacy Policy.</a></p>
    <button class="btn btn-primary acceptcookies" type="button" aria-label="Close">I agree</button>
</div>
--}}

<!-- Footer Area-->
<footer class="footer-area section-padding-120">
    <div class="container">
        <div class="row justify-content-between">
            <!-- Footer Widget Area-->
            <div class="col-12 col-sm-10 col-lg-3">
                <div class="footer-widget-area mb-70">
                    <a class="d-block mb-4" href="/"><img src="/img/core-img/logo.png" alt=""></a>
                    <p>{{ __('For all questions of cooperation, you can contact us through') }} <a href="{{ route('contacts') }}">{{ __(' the feedback form ') }}</a> {{ __('and using the social networks listed below') }}</p>
{{--                    <div class="newsletter-form">--}}
{{--                        <form action="#">--}}
{{--                            <!--suppress HtmlFormInputWithoutLabel -->--}}
{{--                            <input class="form-control" type="email" placeholder="{{ __('Your email') }}">--}}
{{--                            <button class="btn d-none" type="submit">Go</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
                    <div class="footer-social-icon d-flex align-items-center">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Facbook"><i class="fa fa-facebook"></i></a><a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a><a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a><a href="#" data-toggle="tooltip" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a><a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <!-- Footer Widget Area-->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                <div class="footer-widget-area mb-70">
                    <h5 class="widget-title">{{ __('Leave review') }}</h5>
                    <ul>
                        <li><a href="/reviews/v-gorode/v-gorode-raznoe">{{ __('about company') }}</a></li>
                        <li><a href="/reviews/internet-i-sayty/internet-i-sayty-raznoe">{{ __('about website') }}</a></li>
                        <li><a href="/reviews/odezhda-i-obuv/odezhda-i-obuv-raznoe">{{ __('about product') }}</a></li>
                        <li><a href="/reviews/filmy-video-i-tv/filmy-i-video">{{ __('about movie') }}</a></li>
                    </ul>
                </div>
            </div>
            <!-- Footer Widget Area-->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                <div class="footer-widget-area mb-70">
                    <h5 class="widget-title">{{ __('Sitemap') }}</h5>
                    <ul>
                        <li><a href="{{ route('reviews.index') }}">{{ __('Reviews') }}</a></li>
                        <li><a href="{{ route('blog.index') }}">{{ __('Blog') }}</a></li>
                        <li><a href="{{ route('introduce.index') }}">{{ __('Companies') }}</a></li>
                        <li><a href="{{ route('contacts') }}">{{ __('Contacts') }}</a></li>
                    </ul>
                </div>
            </div>
            <!-- Footer Widget Area-->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                <div class="footer-widget-area mb-70">
                    <h5 class="widget-title">{{ __('Rules') }}</h5>
                    <ul>
                        <li><a href="{{ route('faq.index') }}">{{ __('FAQ') }}</a></li>
                        <li><a href="{{ route('for-authors') }}">{{ __('Information for authors') }}</a></li>
                        <li><a href="{{ route('for-companies') }}">{{ __('Information for companies') }}</a></li>
                        <li><a href="{{ route('terms-for-use') }}">{{ __('Terms of use') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 col-lg-5">
                <!-- Copywrite Text-->
                <div class="footer--content-text">
                    <p class="mb-0">
                        <span>{{ date('Y') }}</span>
                        <a href="{{ route('home') }}" target="_blank">{{ config('app.name') }}</a>
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-5">
                <!-- Footer Nav-->
                <div class="footer-nav">
                    <ul class="d-flex">
                        <li><a href="{{ route('about') }}" target="_blank">{{ __('About project') }}</a></li>
                        <li><a href="{{ route('privacy-policy') }}" target="_blank">{{ __('Policy') }}</a></li>
                        <li><a href="{{ route('support') }}" target="_blank">{{ __('Support') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-2">
                <!-- Default dropup button-->
                <div class="language-dropdown text-center text-lg-right mt-4 mt-lg-0">
                    <div class="btn-group dropup">
                        <button class="btn saasbox-btn-2 dropdown-toggle text-white" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('Language selection') }}</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><span class="mr-2 flag-icon flag-icon-ru"></span>Русский</a>
                            <a class="dropdown-item" href="#"><span class="mr-2 flag-icon flag-icon-us"></span>English</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- All JavaScript Files-->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/default/classy-nav.min.js"></script>
<script src="/js/waypoints.min.js"></script>
<script src="/js/jquery.easing.min.js"></script>
<script src="/js/default/jquery.scrollup.min.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/imagesloaded.pkgd.min.js"></script>
<script src="/js/default/isotope.pkgd.min.js"></script>
<script src="/js/jquery.magnific-popup.min.js"></script>
<script src="/js/jquery.animatedheadline.min.js"></script>
<script src="/js/jquery.counterup.min.js"></script>
<script src="/js/wow.min.js"></script>
<script src="/js/jarallax.min.js"></script>
<script src="/js/jarallax-video.min.js"></script>
<script src="/js/default/cookiealert.js"></script>
<script src="/js/default/jquery.passwordstrength.js"></script>
<script src="/js/default/mail.js"></script>
<script src="/js/default/active.js"></script>
@stack('script')
@production
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(96328271, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/96328271" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
@endproduction

</body>
</html>
