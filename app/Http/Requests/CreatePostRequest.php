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

        $this->sanitize();

        return [
            'title' => 'required|min:3|max:180',
            'sortdesc' => 'required|min:30|max:300',
            //'metatitle' => 'required|min:30|max:300',
            'main_img' => 'mimes:jpeg,png|dimensions:min_width=500,min_height=300,max_width=6000,max_height=4000|max:6000'
        ];
    }

    /**
     * Sanitize inputs before any rules apply
     */
    public function sanitize() {
        $input = $this->all();

        // if (preg_match("#https?://#", $input['url']) === 0) {
        //     $input['url'] = 'http://' . $input['url'];
        // }

        $input['title'] = filter_var($input['title'], FILTER_SANITIZE_STRING);
        $input['sortdesc'] = filter_var($input['sortdesc'], FILTER_SANITIZE_STRING);
        $input['metatitle'] = filter_var($input['metatitle'], FILTER_SANITIZE_STRING);
        $input['metadesc'] = filter_var($input['metadesc'], FILTER_SANITIZE_STRING);
        $input['metakeywords'] = filter_var($input['metakeywords'], FILTER_SANITIZE_STRING);
        $input['tags'] = filter_var($input['tags'], FILTER_SANITIZE_STRING);

        $this->replace($input);
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
