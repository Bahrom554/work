<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
  protected $fillable = ['name', 'type'];
  // protected $appends = ['workers'];
  public function apartements()
  {
    return $this->belongsToMany(Apartment::class, 'apartment_parts')->withPivot('area', 'users', 'status')->withTimestamps();
  }
  public function getWorkersAttribute()
  {
    $workers = '';
    $users = User::whereIn('id', json_decode($this->pivot->users))->get();
    foreach ($users as $user) {
      $workers =$workers. " " . $user->name.", ";
    }
   return $workers;
  }

}
