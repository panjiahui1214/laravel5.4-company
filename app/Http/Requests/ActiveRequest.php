<?php

namespace App\Http\Requests;

use Request;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ActiveRequest extends FormRequest
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
        // 持续性活动，开始结束时间为空; 比赛，开始结束时间必填
        if (!Request::input('start_time') && !Request::input('end_time')) {
            $if_sTime = 'nullable';
            $if_eTime = 'nullable';
        }
        else {
            if (Request::input('start_time')) {
                // 开始时间必须大于当前时间
                $if_sTime = 'required|after:'.Carbon::now();

                // 结束时间必须大于开始时间
                $start_time = date_create(Request::input('start_time'));
                $start_time = date_format($start_time, 'Y/m/d H:i:s');
                $if_eTime = 'required|after:'.$start_time;
            }
            else {
                $if_sTime = 'required';
                $if_eTime = 'required';
            }
        }

        return [
            'name'  => 'required|string|max:50',
            'start_time'  =>  $if_sTime,
            'end_time'    =>  $if_eTime,
            'user_num'  =>  'nullable|integer|min:1',
            'address'   =>  'required|max:255',
            'text'   =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'start_time.after'   =>      '必须大于当前时间',
            'end_time.after'     =>      '必须大于开始时间',
            'start_time.required'   =>   '开始时间和结束时间必须同时填写或不填',
            'end_time.required'  =>      '开始时间和结束时间必须同时填写或不填',
        ];
    }
}
