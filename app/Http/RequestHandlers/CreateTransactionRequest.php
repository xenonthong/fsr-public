<?php

namespace App\Http\RequestHandlers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class CreateTransactionRequest
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
     * @var int
     */
    protected $feeWaiverPoints = 100;

    /**
     * CreateTransactionRequest constructor.
     *
     * @param \App\Models\User         $user
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(User $user, Request $request)
    {
        $this->data = $request->all();
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    protected function getPoints()
    {
        return $this->user->points()->valid()->get();
    }

    /**
     * Handles the request.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->userWantsToUsePoints() && $this->userHasEnoughPoints()) {
            $points           = $this->getPoints();
            $deductiblePoints = $this->feeWaiverPoints;

            while ($deductiblePoints !== 0) {
                foreach ($points as $point) {
                    $remainder = $point->remainder;

                    if ($remainder > $deductiblePoints) {
                        $newRemainder     = $remainder - $deductiblePoints;
                        $deductiblePoints = 0;

                        $point->update(['used' => $point->awarded - $newRemainder]);

                        break;
                    }
                    else if ($remainder === $deductiblePoints) {
                        $deductiblePoints = 0;

                        $point->fullyUsed();

                        break;
                    }
                    else {
                        $deductiblePoints -= $remainder;

                        $point->fullyUsed();
                    }
                }
            }

            $this->waiveFees();
        }

        return Transaction::create(array_merge($this->data, ['user_id' => $this->user->id]));
    }

    protected function userHasEnoughPoints()
    {
        return $this->user->points_available >= $this->feeWaiverPoints;
    }

    protected function userWantsToUsePoints()
    {
        return $this->data['use_points'];
    }

    protected function waiveFees()
    {
        $this->data['fees'] = 0;
    }
}