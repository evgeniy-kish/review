<?php

namespace App\Http\Controllers\Cabinet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $user->loadCount(['reviews', 'products', 'orders']);

        return view('cabinet.index')
            ->with('user', $request->user());
    }
}