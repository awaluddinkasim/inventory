<?php

namespace App\Policies;

use App\Models\GripModel;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GripModelPolicy
{
    public function update(User $user, GripModel $model): bool
    {
        return $user->role == 'admin';
    }

    public function delete(User $user, GripModel $model): bool
    {
        return $user->role == 'admin';
    }
}
