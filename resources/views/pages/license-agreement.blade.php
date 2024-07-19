@extends('layouts.app', ['h' => 'header2'])

@section('title', __('License agreement'))
@section('description', __('License agreement'))

@section('content')
    <!-- Breadcrumb Area-->
    <div class="breadcrumb--area bg-img bg-overlay--gray jarallax" style="background-image: url('/img/custom-img/faq.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb-title">{{ __('License agreement') }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="#">{{ __('License agreement') }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="faq--area section-padding-120">
        <div class="container">

        </div>
    </div>

    <div class="container">
        <div class="border-top"></div>
    </div>

@endsection
