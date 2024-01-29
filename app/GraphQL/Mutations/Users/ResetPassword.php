<?php
declare(strict_types=1);

namespace App\GraphQL\Mutations\Users;

use Exception;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Translation\Translator;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use DanielDeWit\LighthouseSanctum\Exceptions\GraphQLValidationException;
use DanielDeWit\LighthouseSanctum\Contracts\Services\ResetPasswordServiceInterface;

final class ResetPassword
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $token = PasswordReset::where('token', $args['token'])->first();
        if($token){

            $user = $token->user;
            if($user && $user->forgetPassword!==null){
                if(
                    $user->forgetPassword->token === $args['token'] && 
                    $args['password'] === $args['password_confirmation']
                ){
                    $user->password = Hash::make($args['password']);
                    $user->save();
                    $user->forgetPassword->delete();
                    return [
                        'status'  => 'Success',
                        'message' => 'EMAIL_SENT',
                    ];
                }
                return [
                    'status'  => 'Failed',
                    'message' => 'Password is no matched!',
                ];
            }
        }
        return [
            'status'  => 'Failed',
            'message' => 'Link Expire!',
        ];
    }
}
