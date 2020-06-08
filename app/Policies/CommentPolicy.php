<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
	use HandlesAuthorization;

	public function before($user)
	{
		if ($user->isSuperAdmin == 1) {
			return true;
		}
	}

	public function update(User $user, Comment $comment)
	{
		return $comment->user_id == $user->id;
	}
}
