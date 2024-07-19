@extends('layouts.auth')

@section('title', __('Email confirmation'))
@section('description', __('Email confirmation'))

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
                <h5 class="nk-block-title">{{ __('Email confirmation') }}</h5>
                <div class="nk-block-des">
                    <p>{{ __('Thank you for registering!') }}
                        <br>
                        {{ __('To access all the features of the service, follow the link in the letter and confirm your email address.') }}</p>
                </div>
                @if (session('status') === 'verification-link-sent')
                    <div class="alert alert-success alert-icon mt-2">
                        <em class="icon ni ni-check-circle"></em>
                        {{ __('To') }} <strong>{{ auth()->user()->email }}</strong>
                        {{ __('confirmation link sent.') }}
                    </div>
                @endif
            </div>
        </div>
        <form action="{{ route('verification.send') }}" class="form-validate is-alter" method="post">
            @csrf
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block">{{ __('Resend?') }}</button>
            </div>
        </form>
    </div>
@endsection