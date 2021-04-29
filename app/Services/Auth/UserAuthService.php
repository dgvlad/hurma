<?php


namespace App\Services\Auth;


use App\Models\User;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class UserAuthService
{
    public function login(array $credentials)
    {
        DB::beginTransaction();
        try {

            $hasPassportCredentials = Auth::guard('user')->attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password'],
            ]);


            if(!$hasPassportCredentials){
                throw new AuthenticationException();
            }

            config(['auth.guards.api.provider' => 'users']);

            $user = User::find(auth()->guard('user')->user()->id);

            if(!$user){
                throw new AuthenticationException();
            }

            $tokenResult = $user->createToken('User Access Token');
            $token = $tokenResult->token;
            $token->save();

            DB::commit();
            return $tokenResult;
        }catch(Exception $exception){

            DB::rollBack();
            throw $exception;
        }
    }
}
