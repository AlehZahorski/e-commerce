<?php

namespace App\Helpers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

trait UserAuthTrait
{
    public function isUserAuth(): bool
    {
        if (!$this->getUser()) {
            return false;
        }

        return true;
    }

    public function getUserId(): ?int
    {
        if (!$this->getUser()) {
            return null;
        }

        return $this->getUser()->getAuthIdentifier();
    }

    private function getUser(): Authenticatable
    {
        return Auth::guard('sanctum')->user();
    }
}
