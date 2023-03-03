<?php

namespace App\Models;

use App\Models\Building;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable =['name'];
    protected $appends=['buildings'];

    public function getBuildingsAttribute(){
        return Building::whereJsonContains('teams',(string)$this->id)->get();
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
