<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required','string','min:1','max:50'],
            'contents' => ['required','string','min:1','max:500'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El título es requerido',
            'title.min' => 'El título debe llevar 1 carácteres mínimos',
            'title.max' => 'El título debe llevar 50 carácteres máximos',
            'contents.required' => 'El contenido es requerido',
            'contents.min' => 'El contenido debe llevar 1 carácteres mínimos',
            'contents.max' => 'El contenido debe llevar 500 carácteres máximos',
        ];
    }
}
