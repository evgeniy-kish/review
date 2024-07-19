<?php

namespace App\Http\Controllers\Cabinet;

use Throwable;
use Illuminate\Http\Request;
use App\Services\ImageUploader;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Auth\ProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('cabinet.profile.index', compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        $request->user()->update([
            'name' => $request['name']
        ]);

        session()->flash('flash', ['message' => 'Имя изменено']);

        return response()->json(['redirect' => route('cabinet.profile.index')]);
    }

    public function password(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'string', 'confirmed', Rules\Password::min(6)]
        ]);

        $request
            ->user()
            ->update(['password' => Hash::make($request['password'])]);

        session()->flash('flash', ['message' => 'Пароль обновлён']);

        return response()->json(['redirect' => route('cabinet.profile.index')]);
    }

    public function avatar(Request $request)
    {
        try {
            $image = ImageUploader::from('file')
                ->autoOrient()
                ->thumbnail(300, 300, 'top')
                ->setPartialsDir(false)
                ->saveWithoutGeneralSave('avatars');

            $user = $request->user();

            if (!$user->isDefaultAvatar()) {
                Storage::delete($user->avatar);
            }

            $user->update(['avatar' => $image->getPath()]);

            session()->flash('flash', ['message' => 'Аватарка обновлена']);

            return response()->json(['result' => true]);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}