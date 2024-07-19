@extends('layouts.app', ['h' => 'header2'])

@section('title', __('For companies'))
@section('description', __('For companies'))

@section('content')
    <!-- Breadcrumb Area-->
    <div class="breadcrumb--area bg-img bg-overlay--gray jarallax" style="background-image: url('/img/custom-img/for-companies.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb-title">{{ __('For companies') }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="#">{{ __('For companies') }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="for-companies--area section-padding-120">
        <div class="container">
            <div class="col-12 col-md-10">
                <div class="mb-80">
                    <h5>{{ __('For companies') }}</h5>
                    <ul>
                        <li style="list-style: disc;">{{ __('Add or change your company details') }}</li>
                        <li style="list-style: disc;">{{ __('Add logo') }}</li>
                        <li style="list-style: disc;">{{ __('Reply to incoming customer reviews') }}</li>
                        <li style="list-style: disc;">{{ __('Add a photo on behalf of the company') }}</li>
                        <li style="list-style: disc;">{{ __('Track the statistics of the transition to the website and visits') }}</li>
                    </ul>
                    <p>{{ __('Finding your company is as easy as shelling pears - enter the name of the company in the search on the page and go in one click. If your company is already in the website database, you will see it after clicking the «find» button.') }}</p>
                    <p class="mb-0">{{ __('To access your company, request permission by clicking «I am the owner». If you have not yet registered on the iRate website, after filling out the application field, you automatically become a user of our website.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="border-top"></div>
    </div>

@endsection
