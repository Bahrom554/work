<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
   protected $fillable =['building_id','floor','apartment_number','badge']; 

   public function building(){
     return $this->belongsTo(Building::class);
   }

   public function parts(){
    return $this->belongsToMany(Part::class);
   }
}

