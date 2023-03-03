<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
  protected $fillable = ['building_id','total','floor', 'apartment_number', 'badge'];
  protected $appends = ['workers'];
  public function building()
  {
    return $this->belongsTo(Building::class);
  }

  public function parts()
  {
    return $this->belongsToMany(Part::class, 'apartment_parts')->withPivot('area', 'users', 'status')->withTimestamps();
  }

  public function getWorkersAttribute()
  {
    $parts = $this->parts;
    $workers = [];
    foreach ($parts as $part) {
      $users = User::whereIn('id', json_decode($part->pivot->users))->get();
      foreach ($users as $user) {
        if (!in_array($user->name, $workers)) {
          array_push($workers, $user->name);
        }
      }
    }
    return implode(" , ", $workers);
  }
}
