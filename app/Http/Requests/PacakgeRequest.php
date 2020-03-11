<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacakgeRequest extends FormRequest
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
            "sku"              => "required|unique:packages,sku",
            "title"            => "required",
            "description"      => "required",
            "price"            => "required",
            "rebillCommission" => "required",
            "rebillPrice"      => "required",
        ];
    }
}
