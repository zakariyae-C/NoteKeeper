<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Note;
use Illuminate\Auth\Access\Response;

class NotePolicy
{
    /**
     * Create a new policy instance.
     */
    public function view(User $user, Note $note) : bool|Response
    {
        return $user->id === $note->user_id
                ? Response::allow()
                : Response::denyAsNotFound();
    }

    

    public function update(User $user, Note $note) : bool
    {
        return $user->id === $note->user_id;
    }

    public function delete(User $user, Note $note) : bool{
        return $user->id === $note->user_id;
    }
}
