<?php


namespace App\Services\Auth;


use App\Models\Sms;

final class SignupCodeService
{

    private $apiCLient;

    const SENDER_NAME = 'Hurma';

    public function __construct()
    {
        $this->apiCLient = app('SendPulse');
    }

    public function sendCode(string $phone): string
    {
        $params = [
            'sender' => self::SENDER_NAME,
            'body' => rand(00000000, 99999999),
        ];

        $response = $this->apiCLient->sendSmsByList( [$phone],$params,[]);
        if( !$response->result ) throw new \UnexpectedValueException('Sendpulse error');

        Sms::create(['code' => $params['body']]);
        return $params['body'];
    }


//    1)Сгенерить пароль , создать челика, отправить его по смс, 2) создать гит запушить тестануть + сидер доделать нормальный


}
