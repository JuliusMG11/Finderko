<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function before($user)
	{
		if ($user->isSuperAdmin == 1) {
			return true;
		}
	}

    public function update(User $user, Post $post)
    {
        return $post->user_id == $user->id;
    }

}
