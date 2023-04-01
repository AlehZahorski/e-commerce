<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

trait UserAuthTrait
{
    public function isUserAuth(): bool
    {
        $user =  Auth::guard('sanctum')->user();

        if (!$user) {
            return false;
        }

        return true;
    }
}
