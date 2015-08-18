<?php

namespace App\Http\Requests;


class CreateImageRequest extends Request {

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
            'label'=>'required',
            'image'=>'required|image|mimes:jpeg,jpg,gif,png,bmp'
        ];
    }
} 