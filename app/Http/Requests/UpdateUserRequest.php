<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required | email|unique:users,email,'.$this->id,// Phần '.$this->id được thêm vào để loại trừ bản ghi hiện tại (nếu có) khỏi quy tắc duy nhất. Điều này giúp khi bạn cập nhật thông tin của một người dùng và muốn giữ nguyên giá trị email hiện tại mà không bị kiểm tra là trùng lặp.
            'address' => 'required',
        ];
    }
}
