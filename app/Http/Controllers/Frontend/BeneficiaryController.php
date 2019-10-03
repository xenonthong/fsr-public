<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreBeneficiary;
use App\Http\Requests\Frontend\UpdateBeneficiary;
use App\Models\Beneficiary;
use App\Notifications\BeneficiaryCreatedByCustomer;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    /**
     * Delete customer's beneficiary.
     *
     * @param \App\Models\Beneficiary $beneficiary
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Beneficiary $beneficiary)
    {
        $result = $beneficiary->delete();

        return response()->json(compact('result'));
    }

    /**
     * Show customer's beneficiaries.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json(['beneficiaries' => $request->user()->beneficiaries]);
    }

    /**
     * Show customer's beneficiary's details
     *
     * @param \App\Models\Beneficiary $beneficiary
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Beneficiary $beneficiary)
    {
        return response()->json(['beneficiary' => $beneficiary]);
    }

    /**
     * Create a beneficiary for a customer.
     *
     * @param \App\Http\Requests\Frontend\StoreBeneficiary $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBeneficiary $request)
    {
        $user        = $request->user();
        $beneficiary = Beneficiary::create(array_merge($request->only([
            'name',
            'account_number',
            'bank_id',
        ]), ['user_id' => $user->id]));

        $user->notify(new BeneficiaryCreatedByCustomer($beneficiary));

        return response()->json('Beneficiary has been added.');
    }

    /**
     * Update customer's beneficiary.
     *
     * @param \App\Models\Beneficiary                       $beneficiary
     * @param \App\Http\Requests\Frontend\UpdateBeneficiary $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Beneficiary $beneficiary, UpdateBeneficiary $request)
    {
        $result = $beneficiary->update($request->only(['name', 'account_number', 'bank_id']));

        return response()->json(compact('result'));
    }
}
