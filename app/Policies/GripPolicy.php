<?php

namespace App\Policies;

use App\Models\Grip;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GripPolicy
{
    public function delete(User $user): bool
    {
        return $user->role == 'admin';
    }
}
