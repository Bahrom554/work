<?php

namespace App\UseCases;

use App\Models\Building;
use Illuminate\Http\Request;


class BuildingService
{
    public function buildingReport(Request $request,$id){
       return Building::where('id',$id)->get();
    }







}