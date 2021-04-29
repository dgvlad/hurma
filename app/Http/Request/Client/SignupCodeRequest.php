<?php


namespace App\Http\Request\Client;


use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

final class SignupCodeRequest extends FormRequest
{
    public function rules(){
        return [
            'phone' => [
                'required',
                'string',
                'min:9',
                Rule::exists(Client::class,'phone'),
            ]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
