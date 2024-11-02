<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required',
            'email' => 'required|email|max:255',
            'phone1' => 'required|regex:/^[0-9]+$/|digits_between:1,5',
            'phone2' => 'required|regex:/^[0-9]+$/|digits_between:1,5',
            'phone3' => 'required|regex:/^[0-9]+$/|digits_between:1,5',
            'address' => 'required|string|max:255',
            'category' => 'required',
            'detail' => 'required|string|max:120',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => '名を入力してください',
            'last_name.required' => '姓を入力してください',
            'name.required' => '名前を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'phone1.required' => '電話番号を入力してください',
            'phone2.required' => '電話番号を入力してください',
            'phone3.required' => '電話番号を入力してください',
            'phone1.regex' => '電話番号は半角数字で入力してください',
            'phone2.regex' => '電話番号は半角数字で入力してください',
            'phone3.regex' => '電話番号は半角数字で入力してください',
            'phone1.digits_between' => '電話番号は5桁までの数字で入力してください',
            'phone2.digits_between' => '電話番号は5桁までの数字で入力してください',
            'phone3.digits_between' => '電話番号は5桁までの数字で入力してください',
            'address.required' => '住所を入力してください',
            'category.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
