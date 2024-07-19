@extends('layouts.app', ['h' => 'header2'])

@section('title', 'Контактная информация | iRate')
@section('description', 'Контактная информация о компании iRate – форма обратной связи, страница в социальной сети vk, мессенджеры WhatsApp и Telegram.')

@section('content')
    <!-- Breadcrumb Area-->
    <div class="breadcrumb--area bg-img bg-overlay--gray jarallax" style="background-image: url('/img/custom-img/contacts.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb-title">{{ __('Contacts') }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="#">{{ __('Contacts') }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contacts Area-->
    <div class="saasbox-contact-us-area section-padding-120-40">
        <div class="container">
            <div class="row justify-content-between">
                <!-- Contact Side Info-->
                <div class="col-12 col-lg-5 col-xl-4">
                    <div class="contact-side-info mb-80">
                        <h1 class="mb-3">{{ __('We will be glad') }} <br> {{ __('feedback!') }}</h1>
                        <p class="mb-4">{{ __('Write to us. We will contact you as soon as possible. Managers usually respond within 24 hours.') }}</p>
                        <div class="contact-mini-card-wrapper">
                            <!-- Contact Mini Card-->
                            <div class="contact-mini-card">
                                <div class="contact-mini-card-icon"><i class="lni lni-vk"></i></div>
                                <p>vk.com</p>
                            </div>
                            <!-- Contact Mini Card-->
                            <div class="contact-mini-card">
                                <div class="contact-mini-card-icon"><i class="lni lni-whatsapp"></i></div>
                                <p>whatsapp.com</p>
                            </div>
                            <!-- Contact Mini Card-->
                            <div class="contact-mini-card">
                                <div class="contact-mini-card-icon"><i class="lni lni-telegram"></i></div>
                                <p>telegram.org</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Contact Form-->
                <div class="col-12 col-lg-7">
                    <div class="contact-form mb-80">
                        <form id="main_contact_form" action="{{ route('contacts') }}" method="post">
                            @csrf
                            <div id="success_fail_info"></div>
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <label class="form-label" for="name">{{ __('Name:') }}</label>
                                    <input class="form-control mb-30" id="name" type="text" placeholder="{{ __('Your name') }}" value="{{ auth()->user()?->name }}" name="name" required>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label class="form-label" for="email">Email:</label>
                                    <input class="form-control mb-30" id="email" type="email" placeholder="test@test.test" name="email" value="{{ auth()->user()?->email }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="subject">{{ __('Topic:') }}</label>
                                    <input class="form-control mb-30" id="subject" type="text" placeholder="{{ __('Offer') }}" name="subject" value="">
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="message">{{ __('Message:') }}</label>
                                    <textarea class="form-control mb-30" id="message" name="message" placeholder="{{ __('Your message') }}"></textarea>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn saasbox-btn w-100" type="submit">{{ __('Send') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Google Maps-->
    <div class="google-maps-wrapper">
        <iframe src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJybDUc_xKtUYRTM9XV8zWRD0&key=AIzaSyDNvZwDINy6AJe-Aqas44Y2dZje_7bU-ys" allowfullscreen=""></iframe>
    </div>
@endsection
