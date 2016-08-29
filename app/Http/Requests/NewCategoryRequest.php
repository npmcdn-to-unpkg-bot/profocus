<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewCategoryRequest extends Request
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
            'body' => 'required',
            'thumbnail' => 'required|mimes:jpeg,png',
            'wide' => 'required|mimes:jpeg,png'
        ];
    }
    public function attributes()
    {

        return[
            'title' => 'Заголовок',
            'body' => 'Текст',
            'thumbnail' => '370x550',
            'wide' => '1920x600',
        ];

    }
}
