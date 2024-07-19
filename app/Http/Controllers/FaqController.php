<?php

namespace App\Http\Controllers;

use App\Models\Subject;

class FaqController extends Controller
{
    public function index() {

        $subjects = Subject::has('questions')
            ->with('questions')
            ->get();

        return view('pages.faq', compact('subjects'));
    }
}
