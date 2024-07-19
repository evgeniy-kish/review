<?php

/**
 * @var \App\Models\User $user
 */

?>
@extends('layouts.cabinet')

@section('title', __('Cabinet'))
@section('description', __('Cabinet'))

@push('style')
    <style>
        .card-hover{transition:box-shadow .3s}
        .card-hover:hover{box-shadow:0 3px 12px 1px rgba(43,55,72,.15)!important}
    </style>
@endpush

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{ __('Personal cabinet') }}</h3>
                <div class="nk-block-des text-soft"><p>{{ __('Welcome!') }}</p>
                </div>
            </div>
            @if($user->hasVerifiedEmail())
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu">
                            <em class="icon ni ni-menu-alt-r"></em>
                        </a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li class="nk-block-tools-opt">
                                    <a href="{{ route('cabinet.products.create') }}" class="btn btn-primary">
                                        <em class="icon ni ni-plus"></em><span>Добавить объект</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if(!$user->hasVerifiedEmail())
        <div class="alert alert-pro alert-warning">
            <div class="alert-text">
                <p>{{ __('To leave a review or comment, please confirm your email.') }}</p>
                <p>{{ __('If you didnt receive the email, make sure it doesnt end up in spam folder, also You can follow the') }}
                    <a href="{{ route('verification.notice') }}">{{ __('link') }}</a> {{ __('to resend the message.') }}
                </p>
            </div>
        </div>
    @endif
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-12">
                <ul class="row g-gs preview-icon-svg">
                    <li class="col-lg-4 col-sm-6 col-12">
                        <a class="preview-icon-box card card-bordered card-hover" href="{{ route('home') }}">
                            <div class="preview-icon-wrap">
                                <img src="/dashboard/icons/help-desk.svg" width="90" height="90" alt="">
                            </div>
                            <div><span class="title fw-bold fs-17px text-body">{{ __('To main page') }}</span></div>
                            <div class="fw-medium">{{ __('Go') }}</div>
                        </a>
                    </li>
                    <li class="col-lg-4 col-sm-6 col-12">
                        <a class="preview-icon-box card card-bordered card-hover" href="{{ route('cabinet.profile.index') }}">
                            <div class="preview-icon-wrap">
                                <img src="/dashboard/icons/settings.svg" width="90" height="90" alt="">
                            </div>
                            <div><span class="title fw-bold fs-17px text-body">{{ __('Profile') }}</span></div>
                            <div><span class="fw-medium">{{ $user->name }}</span></div>
                        </a>
                    </li>
                    <li class="col-lg-4 col-sm-6 col-12">
                        <a class="preview-icon-box card card-bordered card-hover" href="{{ route('cabinet.reviews') }}">
                            <div class="preview-icon-wrap">
                                <img src="/dashboard/icons/profile.svg" width="90" height="90" alt="">
                            </div>
                            <div><span class="title fw-bold fs-17px text-body">{{ __('My reviews') }}</span></div>
                            <div class="fw-medium">
                                <span>{{ $reviews_count = $user->reviews()->count() }}</span>
                                <span>{{ trans_choice('dic.review', $reviews_count) }}</span>
                            </div>
                        </a>
                    </li>
                    <li class="col-lg-4 col-sm-6 col-12">
                        <a class="preview-icon-box card card-bordered card-hover" href="{{ route('cabinet.balance') }}">
                            <div class="preview-icon-wrap">
                                <img src="/dashboard/icons/card-credit.svg" width="90" height="90" alt="">
                            </div>

                            <div>
                                <span class="title fw-bold fs-17px text-body">
                                    {{ __('Balance') }} - {{ $user->balance }} @currencyIcon
                                </span>
                            </div>
                            @if($hold = $user->hold)
                                <div class="fw-medium text-warning">{{ __('Hold') }}: {{ $hold }} @currencyIcon</div>
                            @else
                                <div class="fw-medium">{{ __('History') }}</div>
                            @endif
                        </a>
                    </li>
                    <li class="col-lg-4 col-sm-6 col-12">
                        <a class="preview-icon-box card card-bordered card-hover" href="{{ route('cabinet.orders.index') }}">
                            <div class="preview-icon-wrap">
                                <img src="/dashboard/icons/card-debit.svg" width="90" height="90" alt="">
                            </div>
                            <div><span class="title fw-bold fs-17px text-body">{{ __('Transactions') }}</span></div>
                            <div class="fw-medium">
                                <span>{{ $user->orders_count }}</span>
                                <span>{{ trans_choice('dic.operations', $user->orders_count) }}</span>
                            </div>
                        </a>
                    </li>
                    <li class="col-lg-4 col-sm-6 col-12">
                        <a class="preview-icon-box card card-bordered card-hover" href="{{ route('cabinet.products.index') }}">
                            <div class="preview-icon-wrap">
                                <img src="/dashboard/icons/doc-checked.svg" width="90" height="90" alt="">
                            </div>
                            <div><span class="title fw-bold fs-17px text-body">{{ __('Representation') }}</span></div>
                            <div class="fw-medium">
                                <span>{{ $user->products_count }}</span>
                                <span>{{ trans_choice('dic.companies', $user->products_count) }}</span>
                            </div>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
@endsection