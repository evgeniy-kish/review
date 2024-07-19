<?php
/**
 * @var \App\Models\Subject[] $subjects
 * @var \App\Models\Subject   $subject
 */
?>

@extends('layouts.app', ['h' => 'header2'])

@section('title', __('FAQ'))
@section('description', __('FAQ'))

@section('content')
    <!-- Breadcrumb Area-->
    <div class="breadcrumb--area bg-img bg-overlay--gray jarallax" style="background-image: url('/img/custom-img/faq.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="breadcrumb-title">{{ __('FAQ') }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="/">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="#">{{ __('FAQ') }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FAQ Area-->
    <div class="faq--area section-padding-120">
        <div class="container">
            <div class="row g-5">
                @foreach($subjects->splitIn(2) as $key_split => $split)
                    <div class="col-12 col-lg-6">
                        <div class="accordion faq--accordian" id="split-{{ $key_split }}">
                            @foreach($split as $key_subject => $subject)
                                <div class="card border-0">
                                    <div class="card-header">
                                        <button @class(['btn', 'collapsed' => !$loop->first])
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapse-{{ $key_split.'-'. ++$key_subject }}">{{ $key_subject }}. {{ $subject->title }}</button>
                                    </div>
                                    <div @class(['collapse', 'show' => $loop->first])
                                         id="collapse-{{ $key_split.'-'.$key_subject }}"
                                         data-parent="#split-{{ $key_split }}">
                                        <div class="card-body">
                                            <div class="accordion faq--accordian" id="split-{{ $key_split.'-'.$key_subject }}">
                                                @foreach($subject->questions as $key_question => $question)
                                                    <div class="card border-0">
                                                        <div class="card-header">
                                                            <button class="btn collapsed"
                                                                    type="button"
                                                                    data-toggle="collapse"
                                                                    data-target="#collapse-{{ $key_split.'-'.$key_subject.'-'.$question->id }}">{{ $key_subject }}.{{ ++$key_question }}. {{ $question->title }}</button>
                                                        </div>
                                                        <div class="collapse"
                                                             id="collapse-{{ $key_split.'-'.$key_subject.'-'.$question->id }}"
                                                             data-parent="#split-{{ $key_split.'-'.$key_subject }}">
                                                            <div class="card-body">
                                                                {{ $question->answer }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container">
        <div class="border-top"></div>
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
                <div class="col-12 col-sm-4 text-sm-right">
                    <a class="btn saasbox-btn white-btn" href="#">{{ __('Go') }}</a>
                </div>
            </div>
        </div>
    </section>
@endsection
