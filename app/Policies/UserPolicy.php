<?php

namespace App\Policies;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Http\Controllers\AuthController;
class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function before(User $user, string $ability): bool|null
    {
        if ($user->isSuperAdmin()) {
            return true;
        }

        return null;
    }

    // Only superadmin can create users (handled by before())
    public function create(User $user): Response
    {
        return Response::deny('Only superadmins can create users.');
    }

    // Superadmin: any user | Admin: any user | User: only themselves
    public function update(User $user, User $target): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return $user->id === $target->id
            ? Response::allow()
            : Response::deny('You can only edit your own profile.');
    }

    // Only superadmin can delete (handled by before())
    // Admin and user are denied here
    public function delete(User $user, User $target): Response
    {
        return Response::deny('Only superadmins can delete users.');
    }

    // Superadmin: any | Admin: any | User: only themselves
    public function view(User $user, User $target): Response
    {
        if ($user->isAdmin()) {
            return Response::allow();
        }

        return $user->id === $target->id
            ? Response::allow()
            : Response::deny('You cannot view this profile.');
    }

    // Only superadmin and admin can see the full user list
    public function viewAny(User $user): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny('You do not have access to the user list.');
    }
}
