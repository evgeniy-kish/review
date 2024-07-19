@extends('layouts.auth')

@section('title', __('Password reset'))
@section('description', __('Password reset'))

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
                <h5 class="nk-block-title">{{ __('Confirm password') }}</h5>
                <div class="nk-block-des">
                    <p>{{ __('Enter and confirm a password.') }}</p>
                </div>
            </div>
        </div>
        <form action="{{ route('password.update') }}" class="crutch-validate is-alter" method="post">
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <div class="form-control-wrap">
                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                            value="{{ $request['email'] }}" readonly required>
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
                <button type="submit" class="btn btn-lg btn-primary btn-block">{{ __('Reset the password') }}</button>
            </div>
        </form>
        <div class="form-note-s2 pt-5">
            <a href="{{ route('login') }}"><strong>{{ __('Back to login page') }}</strong></a>
        </div>
    </div>
@endsection