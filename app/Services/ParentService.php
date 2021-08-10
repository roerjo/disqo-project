<?php

namespace App\Services;

abstract class ParentService
{
    private string $error = '';

    private array $success = [];

    public function hasError(): bool
    {
        return !empty($this->error);
    }

    public function getError(): string
    {
        return $this->error;
    }

    public function getSuccess(): array
    {
        return $this->success;
    }
}
