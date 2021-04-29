<?php


namespace App\Http\Request\Client;


use App\Models\Client;
use App\Models\Sms;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

final class ClientLoginRequest extends FormRequest
{
    public function rules(){
        return [
            'phone' => [
                'required',
                'string',
                Rule::exists( Client::class,'phone'),
            ],
            'code' => [
                'required',
                'integer',
                Rule::exists(Sms::class,'code')
            ]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
