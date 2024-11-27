<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
            'user_id' => 'required|max:20',
            'task_status' => 'required|in:0,1,2,3',
            'title' => 'required|max:255',
            'comment' => 'nullable|max:1000',

        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => '担当者を選択してください',
            'task_status.required' => 'ステータスを選択してください',
            'title.required' => 'タイトルを入力してください'
        ];
    }
}
