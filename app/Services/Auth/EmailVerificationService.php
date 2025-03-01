<?php

namespace App\Services\Auth;

use App\Contracts\VerifyInterface;
use App\Models\User;
use Carbon\Carbon;

class EmailVerificationService implements VerifyInterface
{
    /**
     * Sends a verification code to the user.
     *
     * @param User $user The user to whom the verification code will be sent.
     * @param string $code The verification code to be sent.
     * @return bool Returns true if the code was successfully sent.
     */
    public function sendVerification(User $user, string $code)
    {
        // Call the sendVerification method on the user model to send the code.
        $user->sendVerification($code);
        return true;
    }

    /**
     * Verifies the user's email using the provided code.
     *
     * @param User $user The user whose email is being verified.
     * @param string $code The verification code to check against.
     * @return bool Returns true if the verification is successful, false otherwise.
     */
    public function verify(User $user, string $code)
    {
        // Compare the provided code with the SHA1 hash of the user's email.
        // The hash_equals function is used to prevent timing attacks.
        $status = hash_equals((string) $code, sha1($user->email));

        // If the code matches and the user's email hasn't been verified yet,
        // mark the email as verified.
        if ($status && !$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        // Return the status of the verification.
        return $status;
    }
}
