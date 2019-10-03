<?php

namespace App\Http\Requests\Frontend;

use App\Enums\FundSource;
use App\Enums\TransferPurpose;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransaction extends FormRequest
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
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'purpose'        => [
                'required',
                Rule::in(TransferPurpose::toSelectOptions()),
            ],
            'source_of_funds' => [
                'required',
                Rule::in(FundSource::toSelectOptions()),
            ],
            'from_currency'  => 'required|exists:currencies,code',
            'to_currency'    => 'required|exists:currencies,code',
            'from_amount'    => 'required|numeric',
            'to_amount'      => 'required|numeric',
        ];
    }
}
