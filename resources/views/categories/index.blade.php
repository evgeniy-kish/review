<?php
/**
 * @var \App\Models\Category[] $categories
 */
?>
@extends('layouts.app', ['h' => 'header2'])

@section('title', 'Все отзывы о компаниях, услугах, товарах и фильмах | iRate')
@section('description', 'Читайте свежие отзывы реальных людей на портале iRate. Оставьте отзыв о личном опыте.')

@section('content')
<!-- Breadcrumb Area-->
<div class="breadcrumb--area bg-img bg-overlay--gray jarallax" style="background-image: url('/img/custom-img/categories.jpg');">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h2 class="breadcrumb-title">{{ __('Reviews') }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active"><a href="#">{{ __('All categories') }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Reviews Area-->
<section class="reviews-area section-padding-120">
    <div class="container">
        <ul id="nav_accordion" class="nav flex-column">
            @foreach($categories as $category)
            <li class="accordion-item">
                <a class="accordion-button collapsed"
                    data-toggle="collapse"
                    data-target="#menu-item-{{ $category->id }}"
                    href="#">{{ $category->title }}<i class="bi small bi-caret-down-fill"></i>
                </a>
                <ul id="menu-item-{{ $category->id }}" class="submenu collapse">
                    @foreach($category->children as $child)
                    <li class="position-relative">
                        <a class="nav-link" href="{{ route('reviews.product', ['category1' => $category->slug, 'category2' => $child->slug]) }}">
                            {{ $child->title }}
                            @if($child->products_count)
                                <span class="position-absolute top-50 end-0 translate-middle badge rounded-pill bg-warning text-dark">
                                {{ ($child->products_count > 99) ? '99+' : $child->products_count }}
                            </span>
                            @endif
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
    </div>
</section>

<!-- Features Area-->
@include('partials.features')

@endsection
