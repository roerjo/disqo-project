<?php

namespace App\Services;

use App\Models\{Note, User};
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

    /**
     * Create a new user note.
     *
     * @param  \App\Models\User  $user
     * @param  array  $noteAttributes
     * @return self
     */
    public function createNote(User $user, array $noteAttributes): self
    {
        try {
            $note = Note::create(
                array_merge($noteAttributes, ['user_id' => $user->id])
            );

            $this->setSuccess([
                'note' => $note,
            ]);
        } catch (Exception $e) {
            $this->setError('Error while creating note', $e);
        }

        return $this;
    }
}
