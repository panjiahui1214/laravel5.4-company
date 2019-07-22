<?php

namespace App\Http\Requests;

use Request;
use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'sex' => 'max:2',
            'birthday'    =>  'date|nullable',
            'residence'     =>  'max:50',
            'education'     =>  'max:10',
            'school'    =>  'max:50',
            'class'     =>  'max:20'
        ];
    }
}
