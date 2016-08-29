<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewModelRequest extends Request
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
            'name' => ['require'],
            'bust' => ['require'],
            'waist' => ['require'],
            'hips' => ['require'],
            'dress' => ['require'],
            'shoe' => ['require'],
            'hair' => ['require'],
            'eye' => ['require'],
            'body' => ['require'],
        ];
    }
}
