<?php
/**
 * @var Article $article
 */

use App\Models\Article;

?>

@extends('layouts.app')

@section('title', $article->title . ' | Блог iRate')
@section('description', $article->title . ' – статья в разделе ' . $article->rubric->title . ' блога iRate. Время чтения – ' . time_to_read($article->body) . ' мин.')

@section('content')
    <!-- Scroll Indicator-->
    <div id="scrollIndicator"></div>
    <!-- Breadcrumb Area-->
    <div class="breadcrumb--area bg-img bg-overlay jarallax" style="background-image: url('{{ $article->img }}');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb-title">{{ $article->title }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">{{ __('Blog') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('blog.rubric', $article->rubric) }}">{{ $article->rubric->title }}</a></li>
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
                        <a class="like-touch {{ $article->is_liked ? 'liked': '' }}" href="#" data-action="{{ route('blog.article.like', $article) }}">
                            <i class="fa fa-thumbs-o-up"></i>
                        </a>
                    @else
                        <a href="#"><i class="fa fa-thumbs-o-up"></i></a>
                    @endauth
                    <span>{{ $article->likes_count ?: '' }}</span>
                </div>

                <div class="col-12 col-sm-10 col-md-8">
                    <!-- Blog Details Area-->
                    <div class="single-blog-details-area"><img class="post-thumbnail mb-5" src="{{ $article->img }}" alt="">
                        <div class="post-date mb-2">{{ $article->created_at->format('d.m.Y H:i') }}</div>
                        <h2 class="mb-3">{{ $article->title }}</h2>
                        <div class="post-meta mb-5">
                            <p class="post-author">{{ $article->user->roleName() }}</p>
                            <a class="post-tutorial" href="{{ route('users.show', $article->user) }}">{{ $article->user->name }}</a></div>
                        <p>{!! $article->body !!}</p>
                    </div>
                    <!-- Post Tag & Share Button-->
                    <div class="post-tag-share-button d-sm-flex align-items-center justify-content-between my-5">
                        <!-- Post Tags-->
{{--                        <div class="post-tag pb-5">--}}
{{--                            <ul class="d-flex align-items-center pl-0">--}}
{{--                                <li><a href="#">ягоды</a></li>--}}
{{--                                <li><a href="#">блюда</a></li>--}}
{{--                                <li><a href="#">рецепт</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                        <!-- Share Button-->
                        <div class="share-button pb-5">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                    <!-- Comments Area -->
                    @include('partials.comments', ['comments' => $article->comments])
                    <!-- Comments Form -->
                    @include('partials.comment_form', ['route' => route('blog.comment.store', $article)])
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
