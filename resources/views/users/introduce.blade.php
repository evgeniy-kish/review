<?php

/**
 * @var \App\Models\User[] $users
*/

?>
@extends('layouts.app', ['h' => 'header2'])

@section('title', 'Компании Москвы с отзывами, рейтингом и контактами | iRate')
@section('description', 'Компании Москвы с адресами, описанием, фотографиями и реальными отзывами клиентов. Выбирайте лучших и делитесь опытом на iRate.')

@section('content')
    <!-- Breadcrumb Area-->
    <div class="breadcrumb--area bg-img bg-overlay--gray jarallax" style="background-image: url('/img/custom-img/faq.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb-title">{{ __('Officials') }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('introduce.index') }}">{{ __('Officials') }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="faq--area section-padding-120">
        <div class="container">
            @foreach($users as $user)
                <div class="card mb-3">
                    <div class="row g-0 p-3">
                        <div class="col-md-2 d-flex flex-column align-items-center justify-content-center position-relative official-combiner">
                            <div class="d-flex flex-column justify-content-center w-100" style="height: 200px;">
                                <a>
                                    <img src="{{ $user->avatar }}" class="img-fluid rounded mx-auto d-block official-img" alt="{{ $user->name }}">
                                </a>
                            </div>
                            <ul class="list-group list-group-flush align-items-center text-center">
                                <li class="list-group-item p-0 mt-2"><a href="{{ route('users.show', $user) }}">{{ $user->name }}</a></li>
                            </ul>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center changeable">
                                    <h5 class="card-title m-0 official">{{ __('Officials') }}:</h5>
                                </div>
                                <ul class="list-group list-group-flush align-items-center">
                                    @foreach($user->products as $product)
                                        <li class="list-group-item d-flex align-items-center justify-content-between w-100">
                                            <a href="{{ route('reviews.product', ['category1' => $product->category->parent->slug, 'category2' => $product->category->slug, 'product' => $product->slug]) }}">
                                                {{ $product->title }}
                                            </a>
                                            <ul class="ratings-list d-flex align-items-center justify-content-center">
                                                @foreach(range(1,5) as $star)
                                                    @if($product->getRate() >= $star)
                                                        <li><i class="lni-star-filled"></i></li>
                                                    @else
                                                        <li><i class="lni-star-empty"></i></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{ $users->onEachSide(1)->links('partials.paginate', ['class' => 'section-padding-0-120']) }}

    <div class="container">
        <div class="border-top"></div>
    </div>

@endsection
