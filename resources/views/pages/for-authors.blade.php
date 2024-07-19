@extends('layouts.app', ['h' => 'header2'])

@section('title', __('For authors'))
@section('description', __('For authors'))

@section('content')
    <!-- Breadcrumb Area-->
    <div class="breadcrumb--area bg-img bg-overlay--gray jarallax" style="background-image: url('/img/custom-img/for-authors.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb-title">{{ __('For authors') }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="#">{{ __('For authors') }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="for-authors--area section-padding-120">
        <div class="container">
            <div class="col-12 col-md-10">
                <div class="mb-80">
                    <p>{{ __('The website was created to post reviews on anything! You can leave your impressions about a wide variety of goods and purchases.') }}</p>
                    <p>{{ __('We offer payment for honest reviews! What does that require? Register on iRate Post an honest and unique product review. Get paid for viewing your review.') }}</p>
                    <p class="mb-0">{{ __('Every day you use dozens of products that you can leave a review about. Do not miss the opportunity to turn your experience into income. Join our team and share your honest reviews.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="border-top"></div>
    </div>

@endsection
