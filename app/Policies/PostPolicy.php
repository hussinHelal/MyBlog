<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class PostPolicy
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

    public function store (User $user): Response
    {
         return Response::allow();

        // Or add real logic, e.g. only verified users can post:
        // return $user->hasVerifiedEmail()
        //     ? Response::allow()
        //     : Response::deny("You must verify your email first.");
    }

    public function update (User $user, Post $post): Response
    {
        return $user->isAdmin() || $user->id === $post->user_id
            ? Response::allow()
            : Response::deny('you cant edit this post ');
    }

    public function destroy (User $user, Post $post): Response
    {
        return $user->isAdmin() || $user->id === $post->user_id
            ? Response::allow()
            : Response::deny('you cant delete this post ');
    }


}
