<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

abstract class ParentService
{
    private string $error = '';

    private array $success = [];

    public function hasError(): bool
    {
        return !empty($this->error);
    }

    public function setError(string $message, Exception $e): void
    {
        Log::error($message, [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),                
            'line' => $e->getLine(),                
        ]);

        $this->error = $message;
    }

    public function getError(): string
    {
        return $this->error;
    }

    public function setSuccess(array $successData): void
    {
        $this->success = $successData;
    }

    public function getSuccess(): array
    {
        return $this->success;
    }
}
