<?php

/**
 * @var Article $article
 */

use App\Models\Article;

?>
@extends('layouts.panel')

@section('title')Редактировать: {{ $article->title }}@endsection
@section('description')Редактировать: {{ $article->title }}@endsection

@include('panel.blog.articles.form', compact('article'))
