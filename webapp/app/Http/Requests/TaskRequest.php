<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'id' => 'required|max20',
            'user_id' => 'required|max20',
            'task_status' => 'required|in:0,1,2,3',
            'title' => 'required|max255',
            'comment' => 'nullable|max1000',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'タスク名は必須です',
            'user_id.required' => '担当者は必須です',
            'status.required' => 'ステータスは必須です',
        ];
    }
}
