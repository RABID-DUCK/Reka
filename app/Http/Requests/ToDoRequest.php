<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToDoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'image' => 'nullable',
            'tags' => 'nullable|string',
            'user_id' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле названия должно быть заполнено!',
            'user_id.required' => 'Ошибка пользователя'
        ];
    }
}
