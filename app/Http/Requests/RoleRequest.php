<?php

namespace App\Http\Requests;

use Request;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    protected $table = 'admins_roles';

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
        $id = Request::route('id');

        return [
            'name' =>  'required|max:25|unique:'.$this->table.',name,'.$id.',id',
            'description'   =>  'required|max:255',
            'menus_id'     =>  'required|max:50'
        ];
    }
}
