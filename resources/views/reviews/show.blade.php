<?php

/**
 * @var Review $review
 */

use App\Models\Review;
?>

@extends('layouts.app')

@section('title', __('Review of') . " {$review->product->title}")
@section('description', __('Review of') . " {$review->product->title}")

@section('content')
    <!-- Scroll Indicator-->
    <div id="scrollIndicator"></div>
    <!-- Breadcrumb Area-->
    <div class="breadcrumb--area bg-img bg-overlay jarallax" style="background-image: url(/img/custom-img/blog.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('reviews.index') }}">{{ __('Reviews') }}</a></li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('reviews.product', ['category1' => $review->product->category->parent->slug]) }}">
                                        {{ $review->product->category->parent->title }}
                                    </a>
                                </li>

                                <li class="breadcrumb-item" aria-current="page">
                                    <a href="{{ route('reviews.product', ['category1' => $review->product->category->parent->slug, 'category2' => $review->product->category->slug]) }}">
                                        {{ $review->product->category->title }}
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <a href="{{ $review->product->getFullPath() }}">
                                        {{ $review->product->title }}
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- saasbox Blog Area-->
    <div class="saasbox--blog--area section-padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="post--like-post">
                    @auth
                        <a class="like-touch {{ $review->is_liked ? 'liked': '' }}" href="#" data-action="{{ route('review.like', $review) }}">
                            <i class="fa fa-thumbs-o-up"></i>
                        </a>
                    @else
                        <a href="#"><i class="fa fa-thumbs-o-up"></i></a>
                    @endauth
                    <span>{{ $review->likes_count ?: '' }}</span>
                </div>
                <div class="col-12 col-sm-10 col-md-8">
                    <!-- Blog Details Area-->
                    <div class="single-blog-details-area">
                        <div class="card product-description-card mb-5">
                            <h6 class="product-meta-title mb-0 pl-5 py-4">
                                <a class="link-primary" href="{{ $review->product->getFullPath() }}">Отзыв о {{ $review->product->title }}</a>
                            </h6>
                            <div class="row g-0">
                                <div class="col-md-12 text-center p-4 mx-auto">
                                    <a href="{{ $review->product->getFullPath() }}">
                                        <img src="{{ $review->product->img }}" alt="{{ $review->product->title }}" style="width: 300px; height: 300px">
                                    </a>
                                    <ul class="ratings-list d-flex align-items-center justify-content-center mb-3">

                                        @foreach(range(1,5) as $star)
                                            @if($review->product->getRate() >= $star)
                                                <li><i class="lni-star-filled"></i></li>
                                            @else
                                                <li><i class="lni-star-empty"></i></li>
                                            @endif
                                        @endforeach

                                    </ul>

                                    <span>
                                        @if($review->product->reviews_count > 0)
                                            {{ __('rating') }}: {{ $review->product->getRate() }} {{ __('of') }} 5 ({{ $review->product->reviews_count }} {{ trans_choice('dic.review', $review->product->reviews_count) }})

                                        @else
                                            Пока нет отзывов
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="post-date mb-2">{{ $review->created_at->format('d.m.Y H:i') }}</div>
                        <!-- Данные продукта -->
{{--                        <div class="данные продукта">--}}
{{--                            @dump($review->product)--}}
{{--                            <ul class="example">--}}
{{--                                <li>{{ $review->product->title }}</li>--}}
{{--                                <li>{{ $review->product->rating }}</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}

                        <div class="">
                            {!! nl2br($review->body) !!}
                        </div>
                        <!-- Post Author-->
                        <div class="profile-content-wrapper">
                            <!-- Settings Option-->
                            <div class="profile-settings-option">
                                <a href="{{ route('users.show', $review->user_id) }}" data-toggle="tooltip" data-placement="left" title="{{ __('View profile') }}">
                                    <i class="lni lni-eye"></i>
                                </a>
                            </div>
                            <div class="container">
                                <!-- User Meta Data-->
                                <div class="user-meta-data d-flex align-items-center">
                                    <!-- User Thumbnail-->
                                    <div class="user-thumbnail">
                                        <img src="{{ $review->user->avatar }}" alt="">
                                    </div>
                                    <!-- User Content-->
                                    <div class="user-content">
                                        <div class="d-flex justify-content-start">
                                            <h6>{{ $review->user->name }}</h6>
                                            <!-- Share Button-->
                                            <div class="share-button ms-2">
                                                <a href="#"><i class="fa fa-facebook"></i></a>
                                                <a href="#"><i class="fa fa-twitter"></i></a>
                                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                            </div>
                                        </div>
                                        <p>{{ $review->user->roleName() }}</p>
                                        <div class="user-meta-data d-flex align-items-center justify-content-between">
                                            <p class="mx-1">
                                                <span>{{ __('grade') }}</span>
                                                <span class="rating">
                                                    @foreach(range(1,5) as $star)
                                                        @if($review->rating >= $star)
                                                            <i class="lni lni-star-filled"></i>
                                                        @else
                                                            <i class="lni lni-star-empty"></i>
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </p>
                                            <p class="mx-1">
                                                <span>{{ trans_choice('dic.review', $review->user->reviews_count) }}</span>
                                                <span class="counter">{{ $review->user->reviews_count }}</span>
                                            </p>
                                            <p class="mx-1"><span>{{ __('rating') }}</span><span class="counter">{{ $review->user->reviews_count + $review->user->comments_count }}</span></p>
                                            <p class="mx-1"><span>{{ __('member') }}</span><span class="counter">{{ $review->user->created_at->diffForHumans('', true) }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Post Tag & Share Button-->
                        <div class="post-tag-share-button d-sm-flex align-items-center justify-content-end my-5">
                            <!-- Post Tags-->
{{--                            <div class="post-tag pb-5">--}}
{{--                                <ul class="d-flex align-items-center pl-0">--}}
{{--                                    <li><a href="#">ягоды</a></li>--}}
{{--                                    <li><a href="#">блюда</a></li>--}}
{{--                                    <li><a href="#">рецепт</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <!-- Comments Area -->
                    @include('partials.comments', ['comments' => $review->comments])
                    <!-- Comments Form -->
                    @include('partials.comment_form', ['route' => route('review.comment.store', $review)])
                </div>
            </div>
        </div>
    </div>
    <!-- Cool Facts Area-->
    <section class="cta-area cta3 py-5">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 col-sm-8">
                    <div class="cta-text mb-4 mb-sm-0">
                        <h3 class="text-white mb-0">{{ __('Interesting product') }}</h3>
                    </div>
                </div>
                <div class="col-12 col-sm-4 text-sm-right"><a class="btn saasbox-btn white-btn" href="#">{{ __('Go') }}</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
<script src="/js/app.js"></script>
@endpush
