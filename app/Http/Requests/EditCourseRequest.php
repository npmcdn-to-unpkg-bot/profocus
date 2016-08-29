<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditCourseRequest extends Request
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
            'price' => 'required',
            'about' => 'required',
        ];
    }
    public function attributes()
    {

        return[
            'title' => 'Заголовок',
            'price' => 'Цена',
            'body' => 'Текст',
        ];

    }
}
