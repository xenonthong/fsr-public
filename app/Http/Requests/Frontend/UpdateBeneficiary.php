<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBeneficiary extends FormRequest
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
            'name'           => 'required|max:255',
            'bank_id'        => 'required|exists:banks,id',
            'account_number' => 'required|max:30|numeric',
        ];
    }
}
