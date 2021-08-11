<?php

namespace App\Services;

use App\Models\Note;
use App\Models\User;
use Exception;

class NoteService extends ParentService
{
    /**
     * Get paginated notes associated with a user.
     *
     * @param  \App\Models\User  $user
     * @return self
     */
    public function getNotes(User $user): self
    {
        try {
            $this->setSuccess([
                'notes' => $user->notes()->paginate(15),
            ]);
        } catch (Exception $e) {
            $this->setError('Error while retrieving user notes', $e);
        }

        return $this;
    }
}
