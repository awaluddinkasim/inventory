<?php

namespace App\Policies;

use App\Models\GripSize;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GripSizePolicy
{
    public function update(User $user, GripSize $size): bool
    {
        return $user->role == 'admin';
    }

    public function delete(User $user, GripSize $size): bool
    {
        return $user->role == 'admin';
    }
}
