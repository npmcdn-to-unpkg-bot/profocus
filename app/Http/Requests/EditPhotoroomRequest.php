<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditPhotoroomRequest extends Request
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
            'about' => 'required',
            'date' => 'required',
            'photographer' => 'required',
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
            'date' => 'Дата',
            'photographer' => 'Фотограф',
            'location' => 'Локация',
            'hair' => 'Укладка',
            'makeup' => 'Мейкап',
        ];

    }
}
