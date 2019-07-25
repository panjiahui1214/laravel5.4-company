<?php

namespace App\Http\Requests;

use Request;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    protected $table = 'products';
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
            'name'      => 'required|string|max:50',
            'belong'    =>  'required|max:50',
            'href'      =>  'nullable|max:100',
            'txt'       =>  'required'
        ];
    }
}
