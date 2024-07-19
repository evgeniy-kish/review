<?php
/**
 * @var \App\Models\Category $category
 */
?>
@extends('layouts.app', ['h' => 'header2'])

@section('title', $category->title . ' в Москве - оценки, рейтинг, фото и контакты | iRate')
@section('description', ' Реальные отзывы о компаниях категории ' . $category->title . ' в Москве с оценками пользователей, рейтингом, фотографиями и адресами.')

@section('content')
    <!-- Breadcrumb Area-->
    <div class="breadcrumb--area bg-img bg-overlay--gray jarallax" style="background-image: url('/img/custom-img/categories.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb-title">{{ $category->title }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('reviews.index') }}">{{ __('Reviews') }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Area-->
    <section class="about-area about3 section-padding-120 bg-gray">
        <div class="container">
            <div class="hero--content--area">
                <div class="row justify-content-center g-4">
                    @foreach($category->children as $child)
                        <!-- Single Hero Card-->
                            <a href="{{ route('reviews.product', ['category1' => $category->slug, 'category2' => $child->slug]) }}"
                                    class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-3">
                                <div class="card hero-card h-100 border-0 wow fadeInUp p-3" data-wow-delay="100ms" data-wow-duration="1000ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 100ms; animation-name: fadeInUp;">
                                    <div class="card-body"><i class="{{ $category->icon }}"></i>
                                        <h5>{{ $child->title }}</h5>
                                        @if($child->description)
                                            <p class="mb-0">{{ $child->description }}</p>
                                        @endif
                                        @if($child->products_count)
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                                            {{ ($child->products_count > 99) ? '99+' : $child->products_count }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                    @endforeach

                    {{--<!-- Single Feature Area-->
                    <div class="col-12 col-md-3">
                        <div class="card feature-card wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1000ms">
                            <div class="card-body d-flex align-items-center"><i class="lni-wordpress"></i>
                                <div class="fea-text">
                                    <h6>WordPress Solution</h6><span>Ultimate Solution for WP</span>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>
    </section>

    <!-- Features Area-->
    @include('partials.features')

@endsection
