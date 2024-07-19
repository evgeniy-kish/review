@extends('layouts.auth')

@section('title', __('Registration'))
@section('description', __('Registration'))

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
                <h5 class="nk-block-title">{{ __('Registration') }}</h5>
                <div class="nk-block-des">
                    <p>{{ __('Create a new account.') }}</p>
                </div>
            </div>
        </div>

        <form action="{{ route('register.store') }}" class="crutch-validate is-alter" method="post">
            <div class="form-group">
                <label class="form-label" for="name">{{ __('Name') }}</label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control form-control-lg" id="name" name="name"
                            placeholder="{{ __('Your name') }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <div class="form-control-wrap">
                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                            placeholder="{{ __('Your email') }}" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">{{ __('Password') }}</label>
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
                <label class="form-label" for="password_confirmation">{{ __('Password confirmation') }}</label>
                <div class="form-control-wrap">
                    <a tabindex="-1" href="#" class="form-icon form-icon-right lg passcode-switch" data-target="password_confirmation">
                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <input type="password" class="form-control form-control-lg" id="password_confirmation"
                            name="password_confirmation" placeholder="{{ __('Password confirmation') }}" required>
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-control-xs custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="tos" name="tos" required>
                    <label class="custom-control-label" for="tos">
                        {{ __('I agree with') }}
                        <a tabindex="-1" href="{{ route('terms-for-use') }}">
                            {{ __('user agreement') }}
                        </a>
                        {{ __('and') }}
                        <a tabindex="-1" href="{{ route('privacy-policy') }}">
                            {{ __('the privacy policy') }}
                        </a>
                        {{ config('app.name') }}.
                    </label>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block">{{ __('Sign up') }}</button>
            </div>
        </form>

        <div class="form-note-s2 pt-4">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}"><strong>{{ __('Login') }}</strong></a>
        </div>
        @include('auth.social')
    </div>
@endsection