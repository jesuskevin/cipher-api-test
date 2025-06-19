<?php

namespace Modules\Products\Policies;

use App\Models\User;
use Modules\Products\Models\Product;

class ProductPolicy
{
    public function view(User $user, Product $product)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Product $product)
    {
        //
    }

    public function delete(User $user, Product $product)
    {
        //
    }
}
