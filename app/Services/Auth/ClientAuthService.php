<?php


namespace App\Services\Auth;


use App\Models\Client;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

final class ClientAuthService
{
    public function login(array $credentials)
    {
        DB::beginTransaction();
        try {

            $client = Client::where('phone',$credentials['phone'])->firstOrFail();

            Auth::guard('client')->loginUsingId($client->id);

            config(['auth.guards.api.provider' => 'client']);

            $client = Client::select('clients.*')->find(auth()->guard('client')->user()->id);

            if(!$client){
                throw new AuthenticationException();
            }

            $tokenResult = $client->createToken('Client Access Token');
            $token = $tokenResult->token;
            $token->save();

            DB::commit();
            return $tokenResult;
        }catch(Exception $exception){

            DB::rollBack();
            throw $exception;
        }
    }


    public function setPassword(array $data): bool
    {
        DB::beginTransaction();
        try {

            $password = Hash::make($data['code']);

            $client = Client::where('phone',$data['phone'])->update(['password' => $password]);

            DB::commit();
            return $client;
        }catch (Exception $exception){

            DB::rollBack();
            throw $exception;
        }
    }
}
