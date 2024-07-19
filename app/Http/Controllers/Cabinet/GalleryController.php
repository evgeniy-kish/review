<?php

namespace App\Http\Controllers\Cabinet;

use App\Models\Product;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function edit(Product $product)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize('update', $product);

        return view('cabinet.products.gallery', compact('product'));
    }
}