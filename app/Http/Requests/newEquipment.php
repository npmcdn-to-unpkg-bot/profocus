<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class newEquipment extends Request
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
            'thumbnail' => 'required|mimes:jpeg,png',

        ];
    }

    public function attributes()
    {
        return[
            'title' => 'Заголовок',
            'thumbnail' => 'Картинка'
        ];

    }
}
