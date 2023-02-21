<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Comment $comment)
    {

    }

    public function create(User $user)
    {
        return $user->role->name =='user';
    }

    public function update(User $user, Comment $comment)
    {
    }

    public function delete(User $user, Comment $comment)
    {
        return ($user->id == $comment->user_id) || $user->role->name != 'user' || $user->role->name == 'moderator' || $user->role->name == 'admin';
    }

    public function restore(User $user, Comment $comment)
    {
        //
    }

    public function forceDelete(User $user, Comment $comment)
    {
        //
    }
}
