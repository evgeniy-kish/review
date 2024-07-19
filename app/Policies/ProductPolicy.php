<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param User    $user
     * @param Product $product
     *
     * @return bool
     */
    public function update(User $user, Product $product)
    {
        return $user->id === $product->user_id;
    }
}
