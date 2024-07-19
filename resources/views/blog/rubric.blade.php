<?php
/**
 * @var \App\Models\Rubric    $rubric
 * @var \App\Models\Article[] $articles
 */
?>

@extends('layouts.app')

@section('title', 'Все статьи категории ' . $rubric->title . ' | Блог iRate')
@section('description', 'Читайте статьи и новости категории ' . $rubric->title . ' в блоге iRate.')

@section('content')
    <!-- Breadcrumb Area-->
    <div class="breadcrumb--area bg-img bg-overlay jarallax" style="background-image: url('/img/custom-img/category.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb-title">{{ $rubric->title }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">{{ __('Blog') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="#">{{ $rubric->title }}</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog-category Area-->
    <div class="saasbox--blog--area blog-full section-padding-120">
        <div class="container">
            <div class="row g-5">
            @foreach($articles as $article)
                <!-- Single Blog Post-->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card blog-card border-0 no-boxshadow rounded-0">
                            <a class="d-block mb-4" href="{{ route('blog.show', ['rubric_slug' => $rubric->slug, $article]) }}">
                                <img src="{{ $article->img }}" alt="{{ $article->title }}">
                            </a>
                            <div class="post-content">
                                <a class="d-block mb-1" href="#">{{ $rubric->title }}</a>
                                <a class="post-title d-block mb-3" href="{{ route('blog.show', ['rubric_slug' => $rubric->slug, $article]) }}">
                                    <h4>{{ $article->title }}</h4>
                                </a>
                                <div class="post-meta">
                                    <span class="text-muted">{{ __('Time to read') }} 2 {{ __('min.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination Area-->
            {{ $articles->onEachSide(1)->links('partials.paginate') }}
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
