<?php

namespace App\Contracts;

use App\Models\User;

interface VerifyInterface
{
    public function sendVerification(User $user, string $code);
    public function verify(User $user, string $code);
}
