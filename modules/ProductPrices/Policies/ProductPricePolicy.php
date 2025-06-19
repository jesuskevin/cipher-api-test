<?php

namespace Modules\ProductPrices\Policies;

use App\Models\User;
use Modules\ProductPrices\Models\ProductPrice;

class ProductPricePolicy
{
    public function view(User $user, ProductPrice $productPrice)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, ProductPrice $productPrice)
    {
        //
    }

    public function delete(User $user, ProductPrice $productPrice)
    {
        //
    }
}
