<?php

/**
 * @var User $user
 */

use App\Models\User;

?>
@extends('layouts.app', ['h' => 'header2'])

@section('title', __('User profile'))
@section('description', __('User profile'))

@section('content')
    <!-- Breadcrumb Area-->
    <div class="breadcrumb--area bg-img bg-overlay--gray jarallax" style="background-image: url('/img/custom-img/faq.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb-title">{{ __('User profile') }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('users.show', $user) }}">{{ __('User profile') }} {{ $user->name }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="{{ $user->avatar }}" alt="avatar"
                                class="rounded img-fluid" style="width: 250px;">
                        <h5 class="my-3">{{ $user->name }}</h5>
{{--                        <p class="text-muted mb-1">Full Stack Developer</p>--}}
{{--                        <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>--}}
{{--                        <div class="d-flex justify-content-center mb-2">--}}
{{--                            <button type="button" class="btn btn-primary">Follow</button>--}}
{{--                            <button type="button" class="btn btn-outline-primary ms-1">Message</button>--}}
{{--                        </div>--}}
                    </div>
                </div>
{{--                <div class="card mb-4 mb-lg-0">--}}
{{--                    <div class="card-body p-0">--}}
{{--                        <ul class="list-group list-group-flush rounded-3">--}}
{{--                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">--}}
{{--                                <i class="fas fa-globe fa-lg text-warning"></i>--}}
{{--                                <p class="mb-0">https://mdbootstrap.com</p>--}}
{{--                            </li>--}}
{{--                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">--}}
{{--                                <i class="fab fa-github fa-lg" style="color: #333333;"></i>--}}
{{--                                <p class="mb-0">mdbootstrap</p>--}}
{{--                            </li>--}}
{{--                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">--}}
{{--                                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>--}}
{{--                                <p class="mb-0">@mdbootstrap</p>--}}
{{--                            </li>--}}
{{--                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">--}}
{{--                                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>--}}
{{--                                <p class="mb-0">mdbootstrap</p>--}}
{{--                            </li>--}}
{{--                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">--}}
{{--                                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>--}}
{{--                                <p class="mb-0">mdbootstrap</p>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">{{ __('Name') }}</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">{{ __('Role') }}</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->roleName() }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">{{ __('Registered') }}</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $user->created_at->format('d.m.Y') }} | {{ $user->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <hr>
                        @if($reviews = $user->reviews()->count())
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">{{ __('Total reviews') }}</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $reviews }}</p>
                                </div>
                            </div>
                            <hr>
                        @endif
                        @if($comments = $user->comments()->count())
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">{{ __('Total comments') }}</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $comments }}</p>
                                </div>
                            </div>
                            <hr>
                        @endif
                        @if($products = $user->products()->count())
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">{{ __('Representation of') }}</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $products }} {{ __('objects') }}</p>
                                </div>
                            </div>
                            <hr>
                        @endif
                    </div>
                </div>
{{--                <div class="row">--}}
{{--                    <div class="col-md-6">--}}
{{--                        <div class="card mb-4 mb-md-0">--}}
{{--                            <div class="card-body">--}}
{{--                                <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status--}}
{{--                                </p>--}}
{{--                                <p class="mb-1" style="font-size: .77rem;">Web Design</p>--}}
{{--                                <div class="progress rounded" style="height: 5px;">--}}
{{--                                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"--}}
{{--                                            aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                                <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>--}}
{{--                                <div class="progress rounded" style="height: 5px;">--}}
{{--                                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"--}}
{{--                                            aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                                <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>--}}
{{--                                <div class="progress rounded" style="height: 5px;">--}}
{{--                                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"--}}
{{--                                            aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                                <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>--}}
{{--                                <div class="progress rounded" style="height: 5px;">--}}
{{--                                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"--}}
{{--                                            aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>--}}
{{--                                <div class="progress rounded mb-2" style="height: 5px;">--}}
{{--                                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"--}}
{{--                                            aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6">--}}
{{--                        <div class="card mb-4 mb-md-0">--}}
{{--                            <div class="card-body">--}}
{{--                                <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status--}}
{{--                                </p>--}}
{{--                                <p class="mb-1" style="font-size: .77rem;">Web Design</p>--}}
{{--                                <div class="progress rounded" style="height: 5px;">--}}
{{--                                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"--}}
{{--                                            aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                                <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>--}}
{{--                                <div class="progress rounded" style="height: 5px;">--}}
{{--                                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"--}}
{{--                                            aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                                <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>--}}
{{--                                <div class="progress rounded" style="height: 5px;">--}}
{{--                                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"--}}
{{--                                            aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                                <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>--}}
{{--                                <div class="progress rounded" style="height: 5px;">--}}
{{--                                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"--}}
{{--                                            aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>--}}
{{--                                <div class="progress rounded mb-2" style="height: 5px;">--}}
{{--                                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"--}}
{{--                                            aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <div class="container">
        <div class="border-top">
        </div>
    </div>

@endsection
