<?php

namespace App\Http\Requests;

class DeliveryRequest extends Request
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
            'city_id' => 'required',
            'product_id' => 'required',
            'title' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'area' => 'required'
        ];
    }
}
