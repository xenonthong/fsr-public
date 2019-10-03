<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\UpdateAccountRequest;
use App\Models\Address;
use App\Models\Model;
use App\Models\Profile;
use App\Notifications\AccountUpdatedByCustomer;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Show customer's details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        $user = Auth::user();

        $user->loadMissing('profile', 'points');

        return response()->json(['account' => $user]);
    }

    /**
     * Update customer's account.
     *
     * @param \App\Http\Requests\Frontend\UpdateAccountRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateAccountRequest $request)
    {
        $profile = Profile::updateOrCreate(
            ['user_id' => Auth::id()],
            $request->only('nationality', 'contact_number', 'dob')
        );

        $address = Address::updateOrCreate(
            ['addressable_type' => Profile::class, 'addressable_id' => $profile->id],
            $request->only(
                'line_1',
                'line_2',
                'country',
                'state',
                'city',
                'postal_code'
            )
        );

        if ($profile->wasChanged() || $address->wasChanged()) {
            $request->user()->notify(new AccountUpdatedByCustomer());
        }

        return response()->json('Account has been updated');
    }
}
