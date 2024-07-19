<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Product;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        Product::flushEventListeners();

        Product::factory(2000)->create()->each(static function (Product $product) {
            $photos = array_map(static function ($v) use ($product) {
                return ['product_id' => $product->id, 'path' => /*"https://picsum.photos/600/600?random={$v}"*/ '/img/special/no-image-300x300.png'];
            }, [1, 2, 3, 4, 5]);

            Review::factory(random_int(1, 5))
                ->create(['product_id' => $product->id])
                ->each(static function (Review $review) {
                    $review->update(['activity' => 1]);

                    Comment::factory(random_int(1, 5))
                        ->create(['post_id' => $review->id, 'post_type' => Review::class]);
                });

            DB::table('product_photos')
                ->insert($photos);
        });
    }
}
