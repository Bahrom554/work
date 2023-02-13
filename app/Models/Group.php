<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable =['name'];

    public function buildings(){
        return $this->hasMany(Building::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
