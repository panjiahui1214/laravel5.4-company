<?php

namespace App\Http\Requests;

use Auth;
use Request;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    protected $table = TABLE_ADMINS;

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
            'password' => 'required|string|min:6|max:16|confirmed',
        ];
    }
}
