<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductObserver
{
    /**
     * Handle the Product "deleted" event.
     *
     * @param Product $product
     *
     * @return void
     * @noinspection PhpUndefinedMethodInspection
     * @noinspection UnknownInspectionInspection
     */
    public function deleted(Product $product): void
    {
        $product->reviews->each->delete();
    }

    /**
     * Handle the Review "force deleted" event.
     *
     * @param Product $product
     *
     * @return void
     * @noinspection PhpUndefinedMethodInspection
     * @noinspection UnknownInspectionInspection
     */
    public function forceDeleting(Product $product): void
    {
        // 1. Удалить картинку логотипа с диска
        if ($path = $product->getRawOriginal('img')) {
            Storage::delete($path);
        }

        // 2. Удалить галерею
        $product->photos->each->delete();
    }
}
