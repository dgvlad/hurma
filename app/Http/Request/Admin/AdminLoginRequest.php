<?php


namespace App\Http\Request\Admin;


use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class AdminLoginRequest extends FormRequest
{
    public function rules(){
        return [
            'email' => [
                'required',
                'email',
                Rule::exists( User::class,'email'),
            ],
            'password' => 'required:string'
        ];
    }
}
