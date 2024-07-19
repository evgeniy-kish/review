@extends('layouts.auth')

@section('title', __('Password recovery'))
@section('description', __('Password recovery'))

@section('content')
    <div class="nk-block nk-block-middle nk-auth-body">
        <div class="brand-logo pb-5">
            <a href="{{ route('home') }}" class="logo-link">
                <img class="logo-light logo-img logo-img-lg" src="/img/core-img/logo-white.png" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="/img/core-img/logo.png" alt="logo-dark">
            </a>
        </div>
        @if (session('status'))
            <div class="alert alert-success alert-icon">
                <em class="icon ni ni-check-circle"></em>
                {{ session('status') }}
            </div>
        @else
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">{{ __('Restore password') }}</h5>
                    <div class="nk-block-des">
                        <p>{{ __('If you have forgotten your password, then we will send you instructions on how to restore access to the specified email address.') }}</p>
                    </div>
                    @error('email')
                    <div class="alert alert-icon alert-danger mt-2" role="alert">
                        <em class="icon ni ni-alert-circle"></em>
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <form action="{{ route('password.email') }}" class="form-validate is-alter" method="post">
                @csrf
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="email">Email</label>
                        <a class="link link-primary link-sm" href="{{ route('support') }}">{{ __('Need help?') }}</a>
                    </div>
                    <div class="form-control-wrap">
                        <input type="email" class="form-control form-control-lg" id="email" name="email"
                                placeholder="{{ __('Your email') }}" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">{{ __('Restore access') }}</button>
                </div>
            </form>
            <div class="form-note-s2 pt-5">
                <a href="{{ route('login') }}"><strong>{{ __('Back to login page') }}</strong></a>
            </div>
        @endif
    </div>
@endsection