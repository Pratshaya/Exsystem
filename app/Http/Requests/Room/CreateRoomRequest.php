<?php


namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoomRequest extends FormRequest
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
            'detail' => 'required',
            'department_id' => 'required|exists:departments,id'
        ];
    }
}