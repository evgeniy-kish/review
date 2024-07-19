<?php

namespace App\Http\Controllers;

use App\Models\User;

class IntroduceController extends Controller
{
    public function index()
    {
        $users = User::has('products')
            ->with('products.category.parent')
            ->paginate(10);

        return view('users.introduce', compact('users'));
    }
}