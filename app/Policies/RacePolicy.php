<?php

namespace App\Policies;

use App\Models\Race;
use App\Models\User;

class RacePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Race $race): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Race $race): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Race $race): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Race $race): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Race $race): bool
    {
        return $user->isAdmin();
    }

    public function register(User $user, Race $race): bool
    {
        return $user->isPilot() && $race->status === 'upcoming';
    }
}