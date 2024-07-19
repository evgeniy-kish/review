<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use App\Services\ImageUploader;
use Symfony\Component\HttpFoundation\Cookie;

class ServiceController extends Controller
{
    public function slugify(Request $request)
    {
        $slug = str($request['slug'])->slug();

        return response()->json(compact('slug'));
    }

    public function uploadBase()
    {
        try {
            $image = ImageUploader::from('file')
                ->save('upload');

            return response()->json([
                'path'   => $image->getPath(),
                'width'  => $image->getWidth(),
                'height' => $image->getHeight()
            ]);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function trumUpload()
    {
        try {
            $image = ImageUploader::from('file')
                ->save('upload');

            return response()->json([
                'status'  => 200,
                'success' => true,
                'link'    => $image->getPath(),
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status'  => 500,
                'success' => false,
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function lang($lang)
    {
        return back()->withCookie(new Cookie('lang', $lang, 0x7FFFFFFF));
    }
}
