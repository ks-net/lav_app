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
            'site_url' => 'required|max:300|active_url',
            'cachetime' => 'required|min:1|max:86400|numeric|integer',
            'artlistpagin' => 'required|min:1|max:100|numeric|integer',
            'panellistpagin' => 'required|min:1|max:100|numeric|integer',
            'disqus_site_url' => 'nullable|max:300|active_url',
            'admin_title_trim' => 'required|min:0|max:500|numeric|integer',
            'admin_desc_trim' => 'required|min:0|max:500|numeric|integer',
            'frontend_title_trim' => 'required|min:0|max:500|numeric|integer',
            'frontend_desc_trim' => 'required|min:0|max:500|numeric|integer',
            'frontend_next_prev_trim' => 'required|min:0|max:200|numeric|integer',
            'post_main_img_width' => 'required|between:400,5000|numeric|integer',
            'post_main_img_height' => 'required|between:400,3000|numeric|integer',
            'post_medium_img_width' => 'required|between:300,1920|numeric|integer',
            'post_medium_img_height' => 'required|between:300,1024|numeric|integer',
            'post_thumb_img_width' => 'required|between:30,400|numeric|integer',
            'post_thumb_img_height' => 'required|between:30,400|numeric|integer',
            'media_full_img_width' => 'required|between:400,5000|numeric|integer',
            'media_medium_img_width' => 'required|between:300,1920|numeric|integer',
            'media_thumb_img_width' => 'required|between:30,400|numeric|integer',
            'media_thumb_img_height' => 'required|between:30,400|numeric|integer',
        ];
    }
}
