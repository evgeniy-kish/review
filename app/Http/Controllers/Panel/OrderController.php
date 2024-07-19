<?php

namespace App\Http\Controllers\Panel;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $mod_orders = Order::whereIn('status', [Order::STATUS['NEW'], Order::STATUS['PENDING']])
            ->with('user:id,name')
            ->oldest('id')
            ->get();

        $orders = Order::whereIn('status', [Order::STATUS['ACCEPTED'], Order::STATUS['REJECTED']])
            ->with('user:id,name')
            ->latest('id')
            ->paginate(20);

        return view('panel.orders.index', compact('mod_orders', 'orders'));
    }

    public function edit(Order $order)
    {
        $order->load(['user' => static fn($q) => $q->withCount(['reviews', 'comments'])]);

        return view('panel.orders.edit', compact('order'));
    }

    public function update(Order $order, Request $request)
    {
        $data = $this->validate($request, [
            'status' => ['required', 'string', Rule::in(Order::STATUS)]
        ]);

        $order->update($data);

        session()->flash('flash', ['message' => 'Статус ордера изменён']);

        return response()->json(['redirect' => route('panel.orders.edit', $order)]);
    }

    public function search()
    {
    }
}