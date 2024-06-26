<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class MemberFormRequest extends FormRequest
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
            'id' => '',
            'name' => '',
            'thumb' => '',
            'gender' => '',
            'birthday' => '',
            'birth_place' => '',
            'degree' => '',
            'degree_2' => '',
            'function' => '',
            'specialized' => '',
            'year' => '',
            'name_school' => '',
            'thumb_2' => '',
            'name_company' => '',
            'office' => '',
            'address' => '',
            'date' => '',
            'email' => 'email',
            'phone' => '',
        ];
    }


    public function messages() : array
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'thumb.required' => 'Ảnh chân dung không được trống',
            'gender.required' => 'Vui lòng nhập giới tính',
            'birthday.required' => 'Vui lòng nhập Ngày/tháng/năm sinh',
            'birth_place.required' => 'Vui lòng nhập nơi sinh',
            'degree.required' => 'Vui lòng nhập học vị',
            'degree_2.required' => 'Vui lòng nhập học vị',
            'function.required' => 'Vui lòng nhập học hàm',
            'specialized.required' => 'Vui lòng nhập Chuyên ngành',
            'year.required' => 'Vui lòng nhập năm tốt nghiệp',
            'name_school.required' => 'Vui lòng nhập tên trường tốt nghiệp',
            'thumb_2.required' => 'Vui lòng nhập up ảnh bằng tốt nghiệp',
            'name_company.required' => 'Vui lòng nhập tên cơ quan',
            'office.required' => 'Vui lòng nhập chức vụ tại nơi công tác',
            'address.required' => 'Vui lòng nhập địa chỉ'
        ];
    }
}