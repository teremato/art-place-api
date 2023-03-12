<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'avatar' => ['nullable', 'file"mimetypes:.jpg,.png', 'max:1', 'size:4096'],
            'name' => ['required', 'string', 'min:4', 'unique:users,name'],
            'password' => ['required', 'min:6', 'string'],
            'email' => ['required', 'email', 'string', 'unique:users,email']
        ];
    }
}
