<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|max20',
            'name' => 'required|max255',
            'email' => 'required|max255',
            'password' => 'required|max225',
            'remember_token' => 'nullable|max100',
            'profile_img' => 'nullable|max225',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ユーザー名は必須です',
            'email.required' => 'メールアドレスは必須です',
            'email.email' => '有効なメールアドレスを入力してください',
            'profile_image.image' => '画像ファイルを選択してください'
        ];
    }
}
