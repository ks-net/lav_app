<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'required|min:3|max:180',
            'sortdesc' => 'required|min:30|max:300',
            //'metatitle' => 'required|min:30|max:300',
            'main_img' => 'mimes:jpeg,png|dimensions:min_width=500,min_height=300,max_width=6000,max_height=4000|max:6000'
        ];
    }
}
