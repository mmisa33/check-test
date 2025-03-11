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

    // バリデーション設定
    public function rules()
    {
        return [
            'category_id' => ['required'], // お問い合わせ種類
            'first_name' => ['required', 'string', 'max:255'],  // 姓
            'last_name' => ['required', 'string', 'max:255'],  // 名
            'gender' => ['required', 'in:1,2,3'],  // 性別
            'email' => ['required', 'email', 'max:255'],  // メールアドレス
            'tel_area' => ['required', 'string', 'digits_between:1,5'], // 電話番号090部分
            'tel_number' => ['required', 'string', 'digits_between:1,5'], // 電話番号1234部分
            'tel_end' => ['required', 'string', 'digits_between:1,5'], // 電話番号5678部分
            'address' => ['required', 'string', 'max:255'],  // 住所
            'building' => ['nullable', 'string', 'max:255'],  // 建物名（任意）
            'detail' => ['required', 'string', 'max:120'],  // お問い合わせ内容
        ];
    }

    /**
     * Get the custom validation messages for the request.
     *
     * @return array
     */

    // エラーメッセージ
    public function messages()
    {
        return [
            'first_name.required' => '名を入力してください',
            'last_name.required' => '姓を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'tel_area.required' => '電話番号を入力してください',
            'tel_number.required' => '電話番号を入力してください',
            'tel_end.required' => '電話番号を入力してください',
            'tel_area.digits_between' => '電話番号は5桁以内で入力してください',
            'tel_number.digits_between' => '電話番号は5桁以内で入力してください',
            'tel_end.digits_between' => '電話番号は5桁以内で入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}