<?php

namespace App\Http\Requests;

use Request;
use App\Models\AdvertisesType;
use Illuminate\Foundation\Http\FormRequest;

class AdvertiseRequest extends FormRequest
{
    protected $table = 'advertises';
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
        $tpid = Request::route('tpid');
        $advType = AdvertisesType::find($tpid);

        if ($id) {
            $sort_val = 'required|unique:'.$this->table.',sort,'.$id.',id,tpid,'.$tpid;
        }
        else {
            $sort_val = 'required|unique:'.$this->table.',sort,null,null,tpid,'.$tpid;
        }

        if ($advType->width && $advType->height) {
            $image_val = 'dimensions:width='.$advType->width.',height='.$advType->height;
        }
        else {
            $image_val = '';
        }

        return [
            'name'  =>  'required|max:50',
            'sort'  =>  $sort_val,
            'image' =>  $image_val,
            'href'  =>  'nullable|max:255',
        ];
    }
}
