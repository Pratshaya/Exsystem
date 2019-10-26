<?php


namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class CreateDepartmentRequest extends FormRequest
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
            'faculty_id' => 'required|exists:faculties,id'
        ];
    }
}