<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarUpdateRequest extends FormRequest
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
            'title' => 'bail|required|min:2',
            'condition' => 'bail|required|exists:cars,new',
            'price' => 'bail|required|numeric|min:500|gt:0',
            'car_mark' => 'bail|required|exists:car_marks,id',
            'model' => 'bail|required|exists:car_models,id',
            'year' => 'bail|numeric',
            'mileage' => 'bail|numeric|gt:-1',
            'description' => 'bail|max:1000',
        ];
    }
}
