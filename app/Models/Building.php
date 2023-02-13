<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable =['name','customer_id','floor','cost','badge','group_id','status'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function apartments(){
       return $this->hasMany(Apartment::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function success(){
        $this->update(['status'=>1]);
        $this->badge-=1;
        }
 
     public function badge(){
        $this->badge+=1;
     }


   
}
