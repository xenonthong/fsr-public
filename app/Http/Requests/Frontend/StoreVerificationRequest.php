<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class StoreVerificationRequest extends FormRequest
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

    public function rules()
    {
        return [
            'portrait'      => 'required|mimes:jpeg,jpg,png',
            'documentFront' => 'required|mimes:jpeg,jpg,png',
            'documentRear'  => 'required|mimes:jpeg,jpg,png',
        ];
    }
}
