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
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:"H:i"',
            'email_amount' => 'required|digits_between:1,10',
            'first_alert_timing' => 'required|date_format:"H:i"',
            'second_alert_flag' => 'required|boolean',
            'second_alert_timing' => 'nullable|date_format:"H:i"'
        ];
    }
}
