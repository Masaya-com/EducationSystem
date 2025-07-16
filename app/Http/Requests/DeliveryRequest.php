<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
            'delivery_from_date' => 'required|array',
            'delivery_from_date.*' => 'required|date',
            'delivery_to_date' => 'required|array',
            'delivery_to_date.*' => 'required|date',
            'delivery_from_time' => 'required|array',
            'delivery_from_time.*' => 'required|date_format:H:i',
            'delivery_to_time' => 'required|array',
            'delivery_to_time.*' => 'required|date_format:H:i',


        ];
    }

    public function attributes()
    {
        return [
            'delivery_from_date.*' => '開始日',
            'delivery_from_time.*' => '開始時刻',
            'delivery_to_date.*' => '終了日',
            'delivery_to_time.*' => '終了時刻',
        ];
    }
    public function messages()
    {
        return [
            'delivery_from_date.*' => ':attribute は必須項目です',
            'delivery_from_time.*' => ':attribute はは必須項目です',
            'delivery_to_date.*' => ':attribute は必須項目です',
            'delivery_to_time.*' => ':attribute は必須項目です',
        ];
    }

}
