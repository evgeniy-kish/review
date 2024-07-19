@extends('layouts.app', ['h' => 'header2'])

@section('title', 'Служба поддержки | iRate')
@section('description', 'Служба поддержки проекта iRate всегда готова помочь вам в решении проблем, связанных с работой на портале.')

@section('content')
    <!-- Breadcrumb Area-->
    <div class="breadcrumb--area bg-img bg-overlay--gray jarallax" style="background-image: url('/img/custom-img/support.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb-title">{{ __('Support') }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="#">{{ __('Support') }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="support--area section-padding-120">
        <div class="container">
            <div class="col-12 col-md-10">
                <div class="mb-80">
                    <p>{{ __('You can view the history of calls to the help center by') }} <a href="#">{{ __('link') }}</a></p>
                    <p>{{ __('Contact to') }} <a href="/contacts">{{ __('customer support') }}</a> {{ __('iRate website') }}</p>
                    <p>{{ __('For website inquiries - please contact') }} <a href="mailto:hello@irate.info">{{ __('e-mail') }}</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="border-top"></div>
    </div>

@endsection
