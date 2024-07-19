<?php

/**
 * @var Article $article
 */

use App\Models\Article;

?>
@extends('layouts.panel')

@section('title')Добавить статью в блог@endsection
@section('description')Добавить статью в блог@endsection

@include('panel.blog.articles.form', compact('article'))
