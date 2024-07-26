<?php

namespace App\Policies;

use App\Models\GripType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GripTypePolicy
{
    public function update(User $user, GripType $type): bool
    {
        return $user->role == 'admin';
    }

    public function delete(User $user, GripType $type): bool
    {
        return $user->role == 'admin';
    }
}
