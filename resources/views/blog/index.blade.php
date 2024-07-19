<?php
/**
 * @var \App\Models\Rubric[]  $rubrics
 * @var \App\Models\Article[] $articles
 * @var \App\Models\Article[] $news
 */
?>

@extends('layouts.app')

@section('title', 'Блог iRate')
@section('description', 'Читайте актуальные, интересные и подробные статьи и новости в блоге iRate.')

@section('content')
    <!-- Breadcrumb Area-->
    <div class="breadcrumb--area bg-img bg-overlay jarallax" style="background-image: url('/img/custom-img/blog.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb-title">{{ __('Blog') }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ __('Blog') }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Area-->
    <div class="saasbox--blog--area section-padding-120">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-12 col-md-7" id="search-blog">
                    @include('blog.rows', compact('articles'))
                    {{ $articles->onEachSide(0)->links('partials.paginate') }}
                </div>

                <div class="col-12 col-md-5 col-lg-4">
                    <div class="blog-sidebar-area">
                        <!-- Single Widget Area-->
                        <div class="single-widget-area mb-5">
                            <!-- Search Form-->
                            <div class="widget-form">

                                <input
                                        class="form-control panel-search"
                                        data-search-target="#search-blog"
                                        data-search-url="{{ route('services.search.blog') }}"
                                        type="search"
                                        placeholder="{{ __('Blog search...') }}"
                                >

                                <button type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <!-- Single Widget Area-->
                        <div class="single-widget-area mb-5">
                            <h4 class="widget-title mb-30">{{ __('Categories') }}</h4>
                            <ul class="catagories-list pl-0">
                                @foreach($rubrics as $rubric)
                                    <li>
                                        <a href="{{ route('blog.rubric', $rubric) }}">
                                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>{{ $rubric->title }}
                                            <span class="text-muted ml-2">({{ $rubric->articles_count }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Single Widget Area-->
                        <div class="single-widget-area mb-5">
                            <h4 class="widget-title mb-30">{{ __('New posts') }}</h4>
                        @foreach($news as $article)
                            <!-- Single Recent Post-->
                            <div class="single-recent-post d-flex align-items-center">
                                <div class="post-thumb">
                                    <a href="{{ route('blog.show', ['rubric_slug' => $article->rubric->slug, 'article' => $article->slug]) }}">
                                        <img src="{{ $article->img }}" alt="{{ $article->title }}">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <a class="post-title" href="{{ route('blog.show', ['rubric_slug' => $article->rubric->slug, 'article' => $article->slug]) }}">{{ $article->title }}</a>
                                    <p class="post-date">{{ $article->created_at->format('d.m.Y') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- Single Widget Area-->
{{--                        <div class="single-widget-area">--}}
{{--                            <h4 class="widget-title mb-30">Популярные теги</h4>--}}
{{--                            <ul class="popular-tags clearfix pl-0">--}}
{{--                                <li><a href="#">ягода</a></li>--}}
{{--                                <li><a href="#">кольцо</a></li>--}}
{{--                                <li><a href="#">выходной</a></li>--}}
{{--                                <li><a href="#">праздник</a></li>--}}
{{--                                <li><a href="#">вечер</a></li>--}}
{{--                                <li><a href="#">туризм</a></li>--}}
{{--                                <li><a href="#">лето</a></li>--}}
{{--                                <li><a href="#">хорошее настроение</a></li>--}}
{{--                                <li><a href="#">природа</a></li>--}}
{{--                                <li><a href="#">солнце</a></li>--}}
{{--                                <li><a href="#">лес</a></li>--}}
{{--                                <li><a href="#">море</a></li>--}}
{{--                                <li><a href="#">пляж</a></li>--}}
{{--                                <li><a href="#">напитки</a></li>--}}
{{--                                <li><a href="#">сок</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
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
    <script src="/js/panel/search.js"></script>
@endpush
