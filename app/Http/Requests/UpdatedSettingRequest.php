<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatedSettingRequest extends FormRequest
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
            //'title' => 'required|min:3|max:180|unique',
            'cachetime' => 'required|min:1|max:10800|numeric|integer',
            'artlistpagin' => 'required|min:1|max:100|numeric|integer',
        ];
    }
}
