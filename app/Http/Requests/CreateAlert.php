<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAlert extends FormRequest
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
            'name' => 'required|max:50',
            'time' => 'required|date_format:"H:i"',
            'email_amount' => 'required|digits_between:1,10',
            'first_alert_timing' => 'required|date_format:"H:i"',
            'second_alert_flag' => 'boolean',
            'second_alert_timing' => 'nullable|date_format:"H:i"'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '予定名',
            'time' => '予定時刻',
            'email_amount' => 'メール数',
            'first_alert_timing' => '１回目のメールを送るタイミング',
            'second_alert_flag' => '２回目のメールを送るかどうか',
            'second_alert_timing' => '２回目のメールを送るタイミング',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute は入力必須です。',
            'name.max' => ':attribute は50文字以内で入力してください。',
            'time.required' => ':attribute は入力必須です。',
            'time.date_format' => ':attribute は入力形式が無効です。',
            'email_amount.required' => ':attribute は入力必須です。',
            'email_amount.digits_between' => ':attribute は1から10までの整数を入力してください。',
            'first_alert_timing.required' => ':attribute は入力必須です。',
            'first_alert_timing.date_format' => ':attribute は入力形式が無効です。',
            'second_alert_flag.boolean' => ':attribute は入力形式が無効です。',
            'second_alert_timing.date_format' => ':attribute は入力形式が無効です。',
        ];
    }
}
