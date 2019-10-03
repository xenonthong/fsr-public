<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'line_1'      => $this->line_1,
            'line_2'      => $this->line_2,
            'country'     => $this->country,
            'city'        => $this->city,
            'postal_code' => $this->postal_code,
        ];
    }
}
