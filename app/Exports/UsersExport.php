<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Building;
use App\Http\Resources\UserListResource;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {   
        $user=User::all();
        return UserListResource::collection($user);
    }
}
