<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class GripModelPolicy
{
    public function delete(User $user): bool
    {
        return $user->role == 'admin';
    }
}
