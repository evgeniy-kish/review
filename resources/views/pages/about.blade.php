@extends('layouts.app', ['h' => 'header2'])

@section('title', 'О проекте | iRate')
@section('description', 'Информация о проект iRate, его миссии и целях. iRate - сервис, который помогает развиваться тысячам компаний!')

@section('content')
    <!-- Breadcrumb Area-->
    <div class="breadcrumb--area bg-img bg-overlay--gray jarallax" style="background-image: url('/img/custom-img/about.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb-title">{{ __('About project') }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="#">{{ __('About project') }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about--area section-padding-120">
        <div class="container">
            <div class="col-12 col-md-10">
                <div class="mb-80">
                    <p>{{ __('iRate is a space where honest reviews about all products, companies and places in your city are collected. Share an objective assessment and honest reviews to help others.') }}</p>
                    <h5>{{ __('What do we offer?') }}</h5>
                    <p>{{ __('A huge number of reviews about all organizations and products from real customers. Verified and honest information about entrepreneurs. A variety of tools for more efficient use of our service. Publishing only honest reviews about real companies.') }}</p>
                    <p>{{ __('iRate is a service that helps thousands of companies develop!') }}</p>
                    <p class="mb-0">{{ __('Offices in Russia:') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="border-top"></div>
    </div>

@endsection
