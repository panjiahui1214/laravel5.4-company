<?php

namespace App\Http\Requests;

use Request;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
        // 持续性课程，开始结束日期为空
        if (!Request::input('start_date') && !Request::input('end_date')) {
            $if_sDate = 'nullable';
            $if_eDate = 'nullable';
        }
        else {
            if (Request::input('start_date')) {
                // 开始日期必须大于当前日期
                $if_sDate = 'required|after:'.Carbon::now();

                // 结束日期必须大于开始日期
                $start_date = date_create(Request::input('start_date'));
                $start_date = date_format($start_date, 'Y/m/d');
                $if_eDate = 'required|after:'.$start_date;
            }
            else {
                $if_sDate = 'required';
                $if_eDate = 'required';
            }
        }

        return [
            'name'  => 'required|string|max:50',
            'start_date'    =>  $if_sDate,
            'end_date'      =>  $if_eDate,
            'keywords'      =>  'required|string|max:255', 
            'description'   =>  'required|string|max:255',
            'belong'    =>  'required|max:50',
            'text'      =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'start_date.after'   =>      '必须大于当前日期',
            'end_date.after'     =>      '必须大于开始日期',
            'start_date.required'   =>   '开始日期和结束日期必须同时填写或不填',
            'end_date.required'  =>      '开始日期和结束日期必须同时填写或不填'
        ];
    }
}
