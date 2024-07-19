<?php

/**
 * @var Category  $category
 * @var Product[] $products
 */

use App\Models\Category;
use App\Models\Product;

?>
@extends('layouts.app', ['h' => 'header2'])

@section('title', $category->title . ' в Москве - оценки, рейтинг, фото и контакты | iRate')
@section('description', ' Реальные отзывы о компаниях категории ' . $category->title . ' в Москве с оценками пользователей, рейтингом, фотографиями и адресами. ' . $products->count() . ' компаний на странице.')

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
                                <li class="breadcrumb-item">
                                    <a href="{{ route('reviews.product', ['category1' => $category->parent->slug]) }}">
                                        {{ $category->parent->title }}
                                    </a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Meta-->
    <div class="shop-meta section-padding-120-0">
        <div class="container">
            <div class="row">
                <!-- Shop Meta Data-->
                <div class="col-12">
                    <div class="shop-meta-data d-sm-flex align-items-center justify-content-between">
                        <!-- Total Product View-->
                        <div class="total-product-view mb-4 mb-sm-0"><span>{{ __('Presented') }}<span class="rs-counter">{{ $products->count() }}</span>{{ __('companies of') }}<span class="rs-counter">{{ $products->total() }}</span></span>
                        </div>
                        <!-- Sorting Data-->
                        <div>
                            <a class="btn btn-primary" href="{{ route(auth()->user()?->isAdmin() ? 'panel.products.create' : 'cabinet.products.create') }}">
                                Добавить компанию
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews category Area-->
    <div class="shop--area shop-fullwidth section-padding-120">
        <div class="container">
            <div class="row g-5">
                @foreach($products as $product)
                    <!-- Single Shop Card-->
                    <a href="{{ route('reviews.product', ['category1' => $category->parent->slug, 'category2' => $category->slug, 'product' => $product->slug]) }}" class="col-12 col-sm-6 col-lg-3">
                            <div class="card shop-card {{ $product->isPremium() ? 'premium': '' }}">
                                <div class="product-meta d-flex align-items-center justify-content-center p-2">
                                    <div class="product-name">
                                        <h4>{{ $product->title }}</h4>
                                    </div>
                                </div>
                                <div class="card-body p-2 text-center">
                                    <ul class="ratings-list d-flex align-items-center justify-content-center mb-3">
                                        @foreach(range(1,5) as $star)
                                            @if($product->getRate() >= $star)
                                                <li><i class="lni-star-filled"></i></li>
                                            @else
                                                <li><i class="lni-star-empty"></i></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <span>{{ $product->getRate() }} из 5 ({{ $product->reviews_count }} {{ trans_choice('dic.review', $product->reviews_count) }})</span>
                                </div>
                                <div class="product-img-wrap">
                                    <img class="card-img-bottom" src="{{ $product->img ?: '/img/special/no-image-300x300.png' }}" alt="{{ $product->title }}">
                                </div>
                            </div>
                        </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Pagination Area-->
    {{ $products->onEachSide(1)->links('partials.paginate', ['class' => 'section-padding-0-120']) }}

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
