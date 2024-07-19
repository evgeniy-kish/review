@extends('layouts.auth')

@section('title', __('Login'))
@section('description', __('Login'))

@section('content')
    <div class="nk-block nk-block-middle nk-auth-body">
        <div class="brand-logo pb-5">
            <a href="{{ route('home') }}" class="logo-link">
                <img class="logo-light logo-img logo-img-lg" src="/img/core-img/logo-white.png" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="/img/core-img/logo.png" alt="logo-dark">
            </a>
        </div>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">{{ __('Login') }}</h5>
                <div class="nk-block-des">
                    <p>{{ __('Use your username and password to login.') }}</p>
                </div>
            </div>
        </div>
        <form action="{{ route('login.store') }}" class="crutch-validate is-alter" method="post">
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <div class="form-control-wrap">
                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                            placeholder="{{ __('Your email') }}" required>
                </div>
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <label class="form-label" for="password">{{ __('Password') }}</label>
                    <a class="link link-primary link-sm" tabindex="-1" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
                <div class="form-control-wrap">
                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <input type="password" class="form-control form-control-lg" id="password" name="password"
                            placeholder="{{ __('Your password') }}" required>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block">{{ __('Login') }}</button>
            </div>
        </form>
        <div class="form-note-s2 pt-4">
            {{ __('First time with us?') }} <a href="{{ route('register') }}">{{ __('Create an account') }}</a>
        </div>
        @include('auth.social')
    </div>
@endsection