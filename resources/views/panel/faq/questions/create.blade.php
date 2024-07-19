<?php

/**
 * @var Question $question
 */

use App\Models\Question;

?>
@extends('layouts.panel')

@section('title', 'Добавить вопрос в FAQ')
@section('description', 'Добавить вопрос в FAQ')

@include('panel.faq.questions.form', compact('question'))
