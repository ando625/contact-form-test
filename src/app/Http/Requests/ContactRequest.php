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
            'last_name' => 'required',
            'first_name' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'phone1' => 'required|numeric|digits_between:1,4',
            'phone2' => 'required|numeric|digits_between:1,4',
            'phone3' => 'required|numeric|digits_between:1,4',
            'address' => 'required',
            'category_id' => 'required',
            'content' => 'required|max:120',
            'building' => 'nullable', // 任意項目なのでnullable
        ];
    }

    public function messages()
{
    return [
        'last_name.required' => '姓を入力してください',
        'first_name.required' => '名を入力してください',
        'gender.required' => '性別を選択してください',
        'email.required' => 'メールアドレスを入力してください',
        'email.email' => 'メールアドレスはメール形式で入力してください',

        // phone1/2/3 に対応
        'phone1.required' => '電話番号（最初の部分）を入力してください',
        'phone1.numeric' => '電話番号（最初の部分）は半角数字で入力してください',
        'phone1.digits_between' => '電話番号（最初の部分）は1〜4桁で入力してください',

        'phone2.required' => '電話番号（中央部分）を入力してください',
        'phone2.numeric' => '電話番号（中央部分）は半角数字で入力してください',
        'phone2.digits_between' => '電話番号（中央部分）は1〜4桁で入力してください',

        'phone3.required' => '電話番号（最後の部分）を入力してください',
        'phone3.numeric' => '電話番号（最後の部分）は半角数字で入力してください',
        'phone3.digits_between' => '電話番号（最後の部分）は1〜4桁で入力してください',

        'address.required' => '住所を入力してください',

        // inquiry_type に対応
        'category_id.required' => 'お問い合わせの種類を選択してください',

        // content に対応
        'content.required' => 'お問い合わせ内容を入力してください',
        'content.max' => 'お問い合わせ内容は120文字以内で入力してください',
    ];
}
}
