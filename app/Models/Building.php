<?php

namespace App\Models;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Building extends Model
{
    protected $fillable =['name','customer_id','floor','cost','badge','teams','status'];
    protected $casts=[
        'teams'=>'array'
    ];
    protected $appends=['team'];
    
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function apartments(){
       return $this->hasMany(Apartment::class)->orderBy('floor','ASC');
    }

    public function getTeamAttribute(){
        return Team::whereIn('id',$this->teams)->get();
    }

    public function success(){
        $this->update(['status'=>1]);
        $this->badge-=1;
        }
 
     public function badge(){
        $this->badge+=1;
     }

     protected static function booted()
     {
         static::addGlobalScope('inprogress', function (Builder $builder) {
             if(!Auth::user()->hasAnyRole([User::ROLE_ADMIN, User::ROLE_MANAGER])){
                 $builder->whereJsonContains('teams',(string)Auth::user()->team_id);
             }
         });
     }



   
}
