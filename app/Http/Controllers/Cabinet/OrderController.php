<?php

namespace App\Http\Controllers\Cabinet;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)
            ->latest('id')
            ->paginate(20);

        return view('cabinet.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $data = $this->validate($request, [
            'amount' => ['required', 'integer', 'min:1', 'max:' . $user->balance],
            'info'   => ['required', 'string'],
        ]);

        DB::transaction(static function () use ($user, $data) {
            $user->orders()->create($data);
            $user->update(['balance' => $user->balance - (int)$data['amount']]);
        });

        session()->flash('flash', ['message' => 'Запрос на вывод добавлен']);

        return response()->json(['redirect' => route('cabinet.orders.index')]);
    }
}
