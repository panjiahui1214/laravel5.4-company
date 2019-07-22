<?php

namespace App\Http\Requests;

use Request;
use App\Models\Company;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
        $id = Request::route('id');
        $company = Company::find($id);

        if ($company->width && $company->height) {
            $image_val = 'dimensions:width='.$company->width.',height='.$company->height;
        }
        else {
            $image_val = '';
        }

        return [
            'value' =>  'required|max:50',
            'image' =>  $image_val
        ];
    }
}
