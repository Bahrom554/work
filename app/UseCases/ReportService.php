<?php

namespace App\UseCases;

use App\Models\Building;
use Illuminate\Http\Request;


class ReportService
{
    public function buildingReport(Request $request){
       return Building::all();
    }







}