<?php

namespace App\Exports;

use App\Models\Part;
use Carbon\Traits\Date;
use App\Models\Apartment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ApartmentExport implements  FromCollection,WithHeadings,ShouldAutoSize
{
    use Exportable;
    protected $id;
    protected $request;
    public function __construct($request,$building_id)
    {  
         $this->request=$request;
        $this->id=$building_id;
    }

    public function collection()
    {  
        $response=[];
        $apartments=Apartment::where('building_id',$this->id)->get();
        $available_part_ids=$this->partlistForDynamicColumn($apartments);
        foreach($apartments as $apartment ){
            array_push($response,$this->mapping($apartment,$available_part_ids));
        }
        return new Collection($response);
    }

    public function headings(): array
    {
        $apartments=Apartment::where('building_id',$this->id)->get();
        $dynamic=$this->partlistForDynamicColumn($apartments,false);
          $static= [
            "#",
            "floor",
            "apartment_number",
            "cost($)",
            "total_area",
            "workers",
           
        ];
        array_splice($static,3,0,$dynamic);
        return $static;
        
    }
  
    private function mapping($apartment,$ids): array
    {   
       $dynamic=[];
       foreach($ids as $id){
        if($area=DB::table('apartment_parts')->where('apartment_id',$apartment->id)->where('part_id',$id)->value('area')){
            array_push($dynamic,$area);
        }else{
            array_push($dynamic,0);
        }
       }
        $static= [
            $apartment->id,
            $apartment->floor,
            $apartment->apartment_number,
            $apartment->building->cost,
            $apartment->total,
            $apartment->workers,
           
        ];
        array_splice($static,3,0,$dynamic);
        return $static;
    }

    private function partlistForDynamicColumn($apartments,$forIds=true){
        $ids=[];
        $names=[];
        foreach($apartments as $apartment){
            foreach($apartment->parts as $part){
                if(!in_array($part->id,$ids)){
                    array_push($ids, $part->id);
                    array_push($names, $part->name."/".$part->type);
                }
            }
         }
         if($forIds){
            return $ids;
         }
         else{
            return $names;
         }
        
    }
}
