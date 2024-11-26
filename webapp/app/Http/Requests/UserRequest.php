<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore(auth()->id())  // ユニーク制約を追加
            ],
            'profile_img' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048'  // ファイルアップロードのルールに変更
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ユーザー名は必須です',
            'email.required' => 'メールアドレスは必須です',
            'email.email' => '有効なメールアドレスを入力してください',
            'profile_img.mimes' => '画像ファイル（jpeg, png, jpg, gif）を選択してください',  // .imgから.mimesに修正
            'profile_img.max' => '画像サイズは2MB以下にしてください'
        ];
    }
}
