<?php

/**
 * @var \App\Models\User $user
*/

?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description', __('Cabinet'))">

    <!-- <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicons/favicon-16x16.png">
    -->

    <link rel="icon" type="image/svg+xml" href="/img/core-img/logo.svg">
    <link rel="stylesheet" href="/dashboard/css/app.css?v=2">
    <link rel="stylesheet" href="/dashboard/css/crutchstyle.css?v=1">
    @stack('style')
    <title>@yield('title', __('Cabinet'))</title>
</head>
<body class="nk-body bg-lighter npc-general has-sidebar">
<div class="nk-app-root">
    <div class="nk-main">
        <div class="nk-wrap ">
            <div class="nk-header nk-header-fixed is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-header-brand">
                            <a href="{{ route('home') }}" class="logo-link">
                                <img class="logo-dark logo-img" src="/img/core-img/logo.png" alt="logo-dark">
                            </a>
                        </div>
                        <div class="nk-header-news d-none d-xl-block">
                            <div class="nk-news-list">
                                <a class="nk-news-item" href="#" onclick="return false;">
                                    <div class="nk-news-icon"><em class="icon ni ni-card-view"></em></div>
                                    <div class="nk-news-text">
                                        <p>{{ __('The current date:') }} <span>{{ date('d.m.Y') }}</span></p>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                <em class="icon ni ni-user-alt"></em>
                                            </div>
                                            <div class="user-info d-none d-md-block">
                                                <div class="user-status">{{ $user->roleName() }}</div>
                                                <div class="user-name dropdown-indicator">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                    <span>{{ $user->firstLetter() }}</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{ $user->name }}</span>
                                                    <span class="sub-text">{{ $user->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner user-account-info">
                                            <h6 class="overline-title-alt">{{ __('Balance') }}</h6>
                                            <div class="user-balance">
                                                <span class="balance">{{ $user->balance }}</span>
                                                <small class="currency currency-usd">@currencyIcon</small>
                                            </div>
                                            @if($hold = $user->hold)
                                                <div class="text-warning">{{ __('Hold') }}: {{ $hold }} @currencyIcon</div>
                                            @endif
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="{{ route('cabinet.profile.index') }}"><em class="icon ni ni-user-list"></em><span>{{ __('Profile') }}</span></a></li>
                                                <li><a href="{{ route('cabinet.reviews') }}"><em class="icon ni ni-star"></em><span>{{ __('Reviews') }}</span></a></li>
                                                @if($user->isAdmin())
                                                    <li><a href="{{ route('panel.index') }}"><em class="icon ni ni-account-setting-alt"></em><span>{{ __('Panel') }}</span></a></li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li>
                                                    <form action="{{ route('logout') }}" method="post" onsubmit="return confirm('{{ __('Exit?') }}')">
                                                        <button type="submit" class="btn btn-icon">
                                                            <em class="icon ni ni-signout"></em> {{ __('Exit') }}
                                                        </button>
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="nk-content nk-content-fluid">
                <div class="container-xl wide-xl">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <div class="nk-footer">
                <div class="container-fluid">
                    <div class="nk-footer-wrap">
                        <div class="nk-footer-copyright"> &copy; {{ date('Y') }} <a href="" target="_blank">{{ config('app.name', 'Отзовик') }}</a>
                        </div>
                        <div class="nk-footer-links">
                            <ul class="nav nav-sm">
                                <li class="nav-item"><a class="nav-link" href="{{ route('terms-for-use') }}">{{ __('Terms of use') }}</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('privacy-policy') }}">{{ __('Privacy policy') }}</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('support') }}">{{ __('Support') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@yield('modal')
<script src="/dashboard/js/bundle.js"></script>
<script src="/dashboard/js/scripts.js"></script>
@if(session('flash'))
    <script>
      Swal.fire(
        "{{ session('flash.title', '👌') }}",
        "{{ session('flash.message', 'Yea!') }}",
        "{{ session('flash.type', 'success') }}",
      );
    </script>
@endif
@stack('script')
</body>
</html>