<?php

namespace App\Http\Requests\Frontend;

use App\Data\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAccountRequest extends FormRequest
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
            'dob'            => 'required',
            'contact_number' => 'required|max:20',
            'nationality'    => 'required|max:30',
            'line_1'         => 'required|max:50',
            'line_2'         => 'required|max:50',
            'country'        => ['required', Rule::in(Country::all())],
            'state'          => 'required|max:25',
            'city'           => 'required|max:25',
            'postal_code'    => 'required|numeric|max:9999999',
        ];
    }
}
