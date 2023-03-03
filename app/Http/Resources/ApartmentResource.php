<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $users = User::whereIn('id', json_decode($this->parts->users))->get();
        $workers = [];
        foreach ($users as $user) {
            $workers[] = $user->name;
        };

        return [
            'floor' => $this->floor,
            'apartmentNumber' => $this->apartment_number,
            'cost' => $this->building->cost,
            'users' => 'ghj',

        ];
    }
}
