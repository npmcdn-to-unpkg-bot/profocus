<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewPhotoroomRequest extends Request
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
            'thumbnail' => 'required',
            'date' => 'required',
            'photo' => 'required',
            'location' => 'required',
            'hair' => 'required',
            'makeup' => 'required',
        ];
    }
    public function attributes()
    {

        return[
            'title' => 'Заголовок',
            'about' => 'О локации',
            'thumbnail' => '376X240',
            'date' => 'Дата',
            'photographer' => 'Фотограф',
            'location' => 'Локация',
            'hair' => 'Укладка',
            'makeup' => 'Мейкап',
        ];

    }
}
