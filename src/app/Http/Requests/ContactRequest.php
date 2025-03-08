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
            'tel_area' => ['required', 'numeric'], // 090部分
            'tel_number' => ['required', 'numeric'], // 1234部分
            'tel_end' => ['required', 'numeric'], // 5678部分
            'address' => ['required', 'string', 'max:255'],  // 住所
            'building' => ['nullable', 'string', 'max:255'],  // 建物名（任意）
            'detail' => ['required', 'string', 'max:120'],  // お問い合わせ内容
        ];
    }

    // 電話番号のバリデーション
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $telArea = $this->input('tel_area');
            $telNumber = $this->input('tel_number');
            $telEnd = $this->input('tel_end');

            // 各フィールドを結合して1つの電話番号を作成
            $tel = $telArea . '-' . $telNumber . '-' . $telEnd;


            // 各フィールドの長さをチェック
            $areaLen = strlen((string) $telArea);
            $numberLen = strlen((string) $telNumber);
            $endLen = strlen((string) $telEnd);

            $isEmpty = ($areaLen === 0 || $numberLen === 0 || $endLen === 0);
            $isTooLong = ($areaLen > 5 || $numberLen > 5 || $endLen > 5);

            // 未入力チェック（どれか1つでも空欄ならエラー）
            if ($isEmpty) {
                $validator->errors()->add('tel', '電話番号を入力してください');
            }

            // 長さチェック（どれかが6桁以上ならエラー）
            if ($isTooLong) {
                $validator->errors()->add('tel', '電話番号は5桁以内で入力してください');
            }
        });
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
            'first_name.required' => '姓を入力してください',
            'last_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'detail.max' => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
