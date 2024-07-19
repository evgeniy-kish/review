<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', __('Control panel login'))">

    <!--    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">-->

    <link rel="icon" type="image/svg+xml" href="/img/core-img/logo.svg">

    <link rel="stylesheet" href="/dashboard/css/app.css">
    @stack('css')
    <title>@yield('title', __('Control panel login'))</title>
</head>

<body class="nk-body bg-white npc-general pg-auth">
<div class="nk-app-root">
    <div class="nk-main ">
        <div class="nk-wrap nk-wrap-nosidebar">
            <div class="nk-content">
                <div class="nk-split nk-split-page nk-split-md">
                    <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white w-lg-45">
                        @yield('content')
                        <div class="nk-block nk-auth-footer">
                            <div class="nk-block-between">
                                <ul class="nav nav-sm">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('terms-for-use') }}" target="_blank">{{ __('Terms of use') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('privacy-policy') }}" target="_blank">{{ __('Privacy policy') }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="mt-3">
                                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="nk-split-content nk-split-stretch bg-abstract"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/dashboard/js/bundle.js"></script>
<script src="/dashboard/js/scripts.js"></script>
@stack('script')
</body>
</html>