<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewSliderRequest extends Request
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
            //
            'title' => 'required',
            'file' => 'max:40000|required|mimes:mp4,jpeg,png',
            'webm' => 'max:40000|mimes:webm',
        ];
    }

    public function attributes()
    {
        return[
            'title' => 'Заголовок',
            'file' => 'Картинка/Видео',
            'webm' => 'WEBM Видео'
        ];

    }
}
