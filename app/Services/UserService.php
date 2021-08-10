<?php

namespace App\Services;

use App\Models\User;
use Exception;

class UserService extends ParentService
{
    public function registerUser(array $userAttributes): self
    {
        try {
            $user = User::create($userAttributes);

            $token = $user->createToken('api_token');

            $this->setSuccess([
                'token' => $token->plainTextToken,
            ]);
        } catch (Exception $e) {
            $this->setError('Error while registering user', $e);
            
            return $this;
        }

        // Trigger UserRegistered event?
        
        return $this;
    }
}
