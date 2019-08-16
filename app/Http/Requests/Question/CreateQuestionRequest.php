<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuestionRequest extends FormRequest
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
            'name' => 'required',
            'options.*.score' => 'required|integer',
            'options.*.name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'options.*.name.required' => 'กรุณากรอกตัวเลือก',
            'options.*.score.required' => 'กรุณากรอกคะแนนของตัวเลือก',
            'options.*.score.integer' => 'คะแนนต้องเป็นตัวเลข',
        ];
    }
}
