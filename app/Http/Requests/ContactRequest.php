<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return[
            'name'=>'required|string|max:255',     
            'email'=>'required|email|max:255',
            'message'=>'required|string',
        ];
    }

    public function messages()
    {
        return[
            'name.required'=>'名前は必須です。',
            'email.required'=>'メールアドレスは必須です。',
            'email.email' => 'メールアドレスの形式が正しくありません。',
            'message.required'=>'お問い合わせ内容は必須です。',  
        ];
    }
}

