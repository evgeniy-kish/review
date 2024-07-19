<?php
/**
 * @var Category[] $categories
 * @var Article[]  $articles
 * @var Review[]   $reviews
 */

use App\Models\Review;
use App\Models\Article;
use App\Models\Category;
?>
@extends('layouts.app', ['h' => 'header2', 'search' => true])

@section('title', 'iRate – реальные отзывы о компаниях Москвы, популярных товарах, услугах и фильмах')

@section('content')
    <!-- Welcome Area -->
    <section class="welcome-area hero2" id="home">
        <!-- Background Shape-->
        <div class="hero-background-shape"><img src="/img/core-img/hero-2.png" alt=""></div>
        <!-- Background Animation-->
        <div class="background-animation">
            <div class="star-ani"></div>
            <div class="circle-ani"></div>
            <div class="box-ani"></div>
        </div>
        <!-- Hero Circle-->
        <div class="hero2-big-circle"></div>
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-between">
                <div class="col-12 col-md-6">
                    <!-- Content-->
                    <div class="welcome-content pr-3">
                        <h2 class="wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1000ms">{{ __('Read and post reviews about products and companies, learn and apply the best practices and recommendations.') }}</h2>
                        <p class="mb-4 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">{{ __('Platform for posting authors reviews') }}</p>
                        <!-- Button Group-->
                    </div>
                </div>
                <div class="col-10 col-md-6">
                    <div class="welcome-thumb wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms"><img src="/img/bg-img/hero-6.svg" alt=""></div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="border-dashed mb-4"></div>
    </div>
    <!-- Client Feedback Area -->
    <section class="client-feedback-area flex-column d-md-flex align-items-center justify-content-between section-padding-60 bg-img bg-overlay jarallax" style="background-image: url('/img/custom-img/mountain.jpg');">
        <!-- Client Feedback Heading-->
        <div class="client-feedback-heading">
            <div class="section-heading mb-0 text-right white">
                <h6>{{ __('Reviews') }}</h6>
                <h2 class="mb-4">{{ __('Last added') }}</h2>
            </div>
        </div>
        <!-- Client Feedback Content-->
        <div class="client-feedback-content">
            <div class="client-feedback-slides owl-carousel">
            @foreach($reviews as $review)
                <!-- Single Feedback Slide-->
                    <a href="{{ route('review.show', $review) }}">
                        <div class="card feedback-card bg-white">
                            <div class="card-body">
                                <div class="client-info d-flex align-items-center">
                                    <div class="client-thumb"><img src="{{ $review->user->avatar }}" alt=""></div>
                                    <div class="client-name">
                                        <h6>{{ $review->user->name }}</h6>
                                    </div>
                                </div>
                                <p>{{ str($review->short_text)->limit() }}</p>
                                <ul class="ratings-list d-flex align-items-center justify-content-center mb-3">
                                    @foreach(range(1,5) as $star)
                                        @if($review->rating >= $star)
                                            <li class="active"><i class="lni-star-filled"></i></li>
                                        @else
                                            <li class="active"><i class="lni lni-star-empty"></i></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </a>
            @endforeach
            </div>
        </div>
    </section>
    <!-- About Area-->
    <section class="about-area about3 section-padding-60 bg-gray">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-9 col-lg-7 col-xxl-6">
                    <div class="section-heading text-center">
                        <h2>{{ __('Categories') }}</h2>
                        <h6>{{ __('All categories') }}</h6>
                        <p>{{ __('Extensive database to search for popular products and publish reviews') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="hero--content--area">
                <div class="row justify-content-center g-4">
                    @foreach($categories as $category)
                        <!-- Single Hero Card-->
                        <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-3">
                                <a href="{{ route('reviews.product', ['category1' => $category->slug]) }}"
                                        class="card hero-card h-100 border-0 wow fadeInUp p-3" data-wow-delay="100ms" data-wow-duration="1000ms">
                                    <div class="card-body"><i class="{{ $category->icon }}"></i>
                                        <h5>{{ $category->title }}</h5>
                                        <p class="mb-0">{{ $category->description }}</p>
                                        @if($category->children_count)
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                                                {{ ($category->children_count > 99) ? '99+' : $category->children_count }}
                                            </span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- News Area-->
    <section class="saasbox-news-area news2 section-padding-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-9 col-lg-7 col-xxl-6">
                    <div class="section-heading text-center">
                        <h2>{{ __('Blog') }}</h2>
                        <h6>{{ __('New posts') }}</h6>
                        <p>{{ __('Interesting articles and useful news from the editors') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center g-5">
                @foreach($articles as $article)
                    <!-- Blog Card-->
                    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                            <div class="card blog-card border-0 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1000ms">
                                <a class="d-block mb-4" href="{{ route('blog.show', ['rubric_slug' => $article->rubric->slug, 'article' => $article->slug]) }}">
                                    <img src="{{ $article->img }}" alt="{{ $article->title }}">
                                </a>
                                <div class="post-content">
                                    <a class="d-block mb-1" href="{{ route('blog.rubric', $article->rubric) }}">{{ $article->rubric->title }}</a>
                                    <a class="post-title d-block mb-3" href="{{ route('blog.show', ['rubric_slug' => $article->rubric->slug, 'article' => $article->slug]) }}">
                                        <h4>{{ $article->title }}</h4>
                                    </a>
                                    <div class="post-meta"><span class="text-muted"><i class="lni-timer mr-2"></i>{{ $article->created_at->format('d.m.Y') }}</span></div>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Partner Area-->
    <div class="our-partner-area section-padding-0-120 partner2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="our-partner-slides owl-carousel">
                        <div class="single-partner"><img src="/img/custom-img/camsoda.png" alt=""></div>
                        <div class="single-partner"><img src="/img/custom-img/bally.png" alt=""></div>
                        <div class="single-partner"><img src="/img/custom-img/canon.png" alt=""></div>
                        <div class="single-partner"><img src="/img/custom-img/asus.png" alt=""></div>
                        <div class="single-partner"><img src="/img/custom-img/art.png" alt=""></div>
                        <div class="single-partner"><img src="/img/custom-img/outgunned.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection