<?php

namespace App\Http\Controllers\Panel;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BalanceStream;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('reviews')
            ->latest('id')
            ->paginate(10);

        return view('panel.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $reviews = $user
            ->reviews()
            ->with(['user:id,name', 'product:id,title'])
            ->latest('id')
            ->paginate(10);

        return view('panel.users.show', compact('user', 'reviews'));
    }


    public function create(Request $request)
    {


        if ($_POST){
            $user = User::create($request->all());

            $user->password = Hash::make($request->password);

            $user->save();

            session()->flash('flash', ['message' => 'Пользователь успешно создан']);

            return response()->json(['redirect' => route('panel.users.index')]);
        }

        return view('panel.users.create');
    }


    public function update(UserRequest $request, User $user)
    {
        $user->update([
            'name' => $request['name']
        ]);

        return response()->json([
            'redirect' => route('panel.users.show', $user)
        ]);
    }




    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return to_route('panel.users.index')
                ->with('error', ['message' => 'Администратор не может быть удалён!']);
        }

        $user->delete();

        return to_route('panel.users.index')
            ->with('flash', ['message' => 'Пользователь удалён!']);
    }

    public function search(Request $request)
    {
        $users = User::where('name', 'like', "%{$request['token']}%")
            ->orWhere('email', 'like', "%{$request['token']}%")
            ->take(10)
            ->get();

        if ($users->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('panel.users.table', compact('users'))->render();
    }

    public function balance(User $user, Request $request)
    {
        $data = $this->validate($request, [
            'charge' => ['required', 'integer', 'not_in:0'],
            'reason' => ['required', 'string']
        ]);

        $user
            ->balances()
            ->create([
                'charge'  => $data['charge'],
                'current' => $user->realBalance() + $data['charge'],
                'type'    => BalanceStream::TYPES['CORRECT'],
                'reason'  => $data['reason'],
            ]);

        session()->flash('flash', ['message' => 'Баланс успешно изменён']);

        return response()->json(['redirect' => route('panel.users.show', $user)]);
    }
}
