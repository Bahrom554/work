<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = ['name','category','type'];

    public function apartemens(){
        return $this->belongsToMany(Apartment::class);
       }
}
