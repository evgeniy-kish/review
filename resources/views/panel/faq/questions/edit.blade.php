<?php

/**
 * @var Question $question
 */

use App\Models\Question;

?>
@extends('layouts.panel')

@section('title', 'Редактировать: ' . $question->title)
@section('description', 'Редактировать: ' . $question->title)

@include('panel.faq.questions.form', compact('question'))
