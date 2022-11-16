<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRec extends FormRequest
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
            'employee_id' => 'required|unique:users',
            'username' => 'required|string|min:3|max:64',
            'first_name' => 'required|string|min:3|max:64',
            'last_name' => 'required|string|min:3|max:64',
            'position' => 'required',
            'password'=>'required|min:5|max:30',
        ];
    }
}
