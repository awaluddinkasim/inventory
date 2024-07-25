<?php

namespace App\Policies;

use App\Models\Grip;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GripPolicy
{
    public function update(User $user, Grip $grip): bool
    {
        return $user->role == 'admin';
    }

    public function delete(User $user, Grip $grip): bool
    {
        return $user->role == 'admin';
    }
}
