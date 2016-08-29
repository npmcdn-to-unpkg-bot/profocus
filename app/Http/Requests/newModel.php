<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class newModel extends Request
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
            'name' => 'required',
            'thumbnailWide' => 'required',
            'thumbnail' => 'required',
            'bust' => 'required|numeric',
            'waist' => 'required|numeric',
            'hips' => 'required|numeric',
            'dress' => 'required|numeric',
            'shoe' => 'required|numeric',
            'hair' => 'required',
            'eye' => 'required',
            'stature' => 'required',
        ];
    }

    public function attributes()
    {
        return[
            'name' => 'Имя',
            'bust' => 'Бюст',
            'waist' => 'Талия',
            'hips' => 'Бедра',
            'dress' => 'Размер платья',
            'shoe' => 'Размер обуви',
            'hair' => 'Цвет волос',
            'eye' => 'Цвет глаз',
            'stature' => 'Рост',
        ];

    }
}
