<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

abstract class ParentService
{
    /**
     * Error message, if any
     */
    private string $error = '';

    /**
     * Success data, if any
     */
    private array $success = [];

    /**
     * Determine if error occurred.
     *
     * @return bool
     */
    public function hasError(): bool
    {
        return !empty($this->error);
    }

    /**
     * Log the error and set the error message property.
     *
     * @param  string  $message
     * @param  Exception  $e
     * @return void
     */
    public function setError(string $message, Exception $e): void
    {
        Log::error($message, [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),                
            'line' => $e->getLine(),                
        ]);

        $this->error = $message;
    }

    /**
     * Retrieve the error message.
     *
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * Set the success data array.
     *
     * @param  array  $successData
     * @return void
     */
    public function setSuccess(array $successData): void
    {
        $this->success = $successData;
    }

    /**
     * Retrieve the success data.
     *
     * @return array
     */
    public function getSuccess(): array
    {
        return $this->success;
    }
}
