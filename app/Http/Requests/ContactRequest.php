<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|min:5|max:50',
            'phone'     => 'required|min:10',
            'email'     => 'required|email:rfc,dns,filter',
            'paddresshone' => 'required',
            'content'   => 'max:500',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập họ tên.',
            'name.min' => 'Họ tên không thể nhỏ hơn 5 ký tự.',
            'name.max' => 'Họ tên không thể lớn hơn 50 ký tự.',
            'email.required' => 'Bạn chưa nhập email.',
            'email.email' => 'Email phải là một địa chỉ email hợp lệ.',
            'email.rfc' => 'Email phải là một địa chỉ email hợp lệ.',
            'email.dns' => 'Email phải là một địa chỉ email hợp lệ.',
            'email.filter' => 'Email phải là một địa chỉ email hợp lệ.',
            'phone.required' => 'Bạn chưa nhập số điện thoại.',
            'phone.min' => 'Số điện thoại sai.',
            'paddresshone.required' => 'Bạn chưa nhập địa chỉ.',
            'content.max' => 'Nội dung không được lớn hơn 500 ký tự.',
        ];
    }
}
