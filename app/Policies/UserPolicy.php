<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before($user, $comment)
	{
		if ($user->isSuperAdmin == 1) {
			return true;
		}
    }
    
    public function update(User $user, User $model)
    {
        return $model->user_id == $user->id;
    }
}
