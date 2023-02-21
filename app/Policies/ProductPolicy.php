<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->role->name=='admin';
    }

    public function view(User $user)
    {
        return $user->role->name=='moderator';
    }

    public function create(User $user)
    {
        return $user->role->name =='writer';
    }

    public function update(User $user, Product $product)
    {
        //
    }

    public function delete(User $user, Product $product)
    {
        return ($user->id == $product->user_id) || $user->role->name != 'user';
    }

    public function restore(User $user, Product $product)
    {
        //
    }

    public function forceDelete(User $user, Product $product)
    {
        //
    }
}
