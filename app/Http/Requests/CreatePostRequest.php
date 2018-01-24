<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true; // true if we plan to check user access elsewhere
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'title' => 'required|min:3|max:180',
            'sortdesc' => 'required|min:30|max:300',
            //'metatitle' => 'required|min:30|max:300',
            'main_img' => 'mimes:jpeg,png|dimensions:min_width=500,min_height=300,max_width=6000,max_height=4000|max:6000'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        return [
                // In most cases, you will probably specify your custom messages
                // in a language file instead of passing them directly to the Validator.
                // To do so, add your messages to custom array in the
                // resources/lang/xx/validation.php language file.
                /*
                  'title.required' => 'A title is required',
                  'title.min' => 'Title must have atleast :min chars .. ',
                 */
        ];
    }

}
