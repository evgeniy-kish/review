<?php

namespace App\Http\Controllers\Panel;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function edit(Product $product)
    {
        return view('panel.products.gallery', compact('product'));
    }

    public function update(Product $product, Request $request)
    {
        $gallery = (array)($request['gallery'] ?: []);

        DB::transaction(static function () use ($gallery, $product) {
            $product->photos()->delete();

            foreach ($gallery as $item) {
                $product->photos()->create(['path' => $item]);
            }

            $product->update();
        });

        session()->flash('flash', ['message' => 'Галерея обновлена']);

        return response()->json([
            'redirect' => route($request->routeIs('panel.products.gallery.update')
                ? 'panel.products.gallery.edit'
                : 'cabinet.products.gallery.edit', $product)
        ]);
    }
}
