<?php


namespace App\Http\Requests\Faculty;

use Illuminate\Foundation\Http\FormRequest;

class CreateFacultyRequest extends FormRequest
{
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
            'campus_id' => 'required|exists:campuses,id'
        ];
    }
}