<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;



class Register extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'confirm_pass' => 'required|same:password',
            // 'role' => 'required',
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'email.required' => 'Vui lòng nhập email',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'confirm_pass.required' => 'Vui lòng xác nhận mật khẩu',
            'confirm_pass.same' => 'Mật khẩu không khớp',
            'email.unique' => 'Email đã tồn tại',

        ];
    }
}