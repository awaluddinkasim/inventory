<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GripTypePolicy
{
    public function delete(Admin $admin): bool
    {
        return $admin->role == 'admin';
    }
}
