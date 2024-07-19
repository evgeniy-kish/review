<?php

namespace App\Http\Controllers\Cabinet;

use App\Models\Order;
use App\Models\BalanceStream;
use App\Http\Controllers\Controller;

class BalanceController extends Controller
{
    public function index()
    {
        $balance = BalanceStream::where('user_id', auth()->id())
            ->latest('id')
            ->paginate(20);

        $orders = collect([]);

        if(auth()->user()->hold) {
            $orders = Order::where('user_id', auth()->id())
                ->whereIn('status', [Order::STATUS['NEW'], Order::STATUS['PENDING']])
                ->oldest('id')
                ->get();
        }

        return view('cabinet.balance.index', compact('balance', 'orders'));
    }
}