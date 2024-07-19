<?php

namespace App\Observers;

use App\Models\Review;
use App\Models\BalanceStream;

class ReviewObserver
{
    /**
     * Handle the Review "created" event.
     *
     * @param Review $review
     *
     * @return void
     */
    public function created(Review $review): void
    {
        if (! $review->product->isReviewsModOn()) {
            $review->user->balances()->create([
                'charge'  => Review::PRICE,
                'current' => $review->user->realBalance() + Review::PRICE,
                'type'    => BalanceStream::TYPES['REVIEW'],
                'reason'  => $review->product->title . '|||' . $review->id,
            ]);

            $this->generateRating($review);
        }
    }

    /**
     * Handle the Review "updated" event.
     *
     * @param Review $review
     *
     * @return void
     */
    public function updated(Review $review): void
    {
        $review->user->balances()->create([
            'charge'  => $charge = $review->activity ? Review::PRICE : -Review::PRICE,
            'current' => $review->user->realBalance() + $charge,
            'type'    => BalanceStream::TYPES['REVIEW'],
            'reason'  => $review->product()->withTrashed()->first()->title . '|||' . $review->id,
        ]);

        $this->generateRating($review);
    }

    /**
     * Handle the Review "deleted" event.
     *
     * @param Review $review
     *
     * @return void
     */
    public function deleted(Review $review): void
    {
        if ($review->isActivity()) {
            $review->user->balances()->create([
                'charge'  => -Review::PRICE,
                'current' => $review->user->realBalance() - Review::PRICE,
                'type'    => BalanceStream::TYPES['REVIEW'],
                'reason'  => $review->product()->withTrashed()->first()->title . '|||' . $review->id,
            ]);

            $this->generateRating($review);
        }
    }

    /**
     * Handle the Review "restored" event.
     *
     * @param Review $review
     *
     * @return void
     */
    public function restored(Review $review): void
    {
    }

    /**
     * Handle the Review "force deleted" event.
     *
     * @param Review $review
     *
     * @return void
     */
    public function forceDeleted(Review $review): void
    {
    }

    /**
     * Обновляет рейтинг компании
     *
     * @param Review $review
     *
     * @return bool
     */
    protected function generateRating(Review $review)
    {
        $review->load([
            'product' => static function ($q) {
                $q->withTrashed();
            },
        ]);

        return $review->product->update([
            'rating' => $review
                ->product
                ->loadAvg(['reviews' => fn($q) => $q->where('activity', 1)], 'rating')
                ->reviews_avg_rating ?: 0,
        ]);
    }
}
