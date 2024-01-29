<?php

namespace App\GraphQL\Mutations\Users;

use Exception;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Translation\Translator;
use DanielDeWit\LighthouseSanctum\Contracts\Services\ResetPasswordServiceInterface;

final class ForgetPassword
{
          

    /**
     * @param mixed $_
     * @param array<string, mixed> $args
     * @return array<string, string>
     * @throws Exception
     */
    public function __invoke($_, array $args): array
    {
        $user = User::with('forgetPassword')->where('email',$args['email'])->first();
        if ($user->forgetPassword === null) {
            $password_reset = PasswordReset::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'token' => sha1(time()),
            ]);
        } 
        else {
            $password_reset = $user->forgetPassword;
            
            $password_reset->email =  $user->email;
            $password_reset->token = sha1(time());
            $password_reset->save();
        }
        // """
        // The url used to reset the password.
        // Use the `__EMAIL__` and `__TOKEN__` placeholders to inject the reset password email and token.

        // e.g; `https://my-front-end.com?reset-password?email=__EMAIL__&token=__TOKEN__`
        // """
        if ($user) {
            $user->resetPassword($args['client']);
            return [
                'status'  => 'EMAIL_SENT',
                'message' => 'Verification email sent!',
            ];
        }

        return [
            'status'  => 'EMAIL_SENT',
            'message' => 'EMAIL_SENT',
        ];
    }
}
