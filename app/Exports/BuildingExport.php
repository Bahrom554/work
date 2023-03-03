<?php

namespace App\Exports;

use App\Models\Building;
use App\Models\Apartment;
use App\Http\Resources\ApartmentResource;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BuildingExport implements  WithMapping,WithHeadings,FromQuery
{
    use Exportable;
    protected $id;
    protected $request;
    public function __construct($request,$id)
    {   
        
        $this->request=$request;
        $this->id=$id;
        
       
    }

    public function query()
    {
        // $apartmets=Apartment::where('building_id',$this->id)->get();
        // return ApartmentResource::collection($apartmets);
        return Building::query();
    
    }
    public function headings(): array
    {
        return [
            '#',
            'User',
            'Date',
        ];
    }
    public function map($invoice): array
    {
        return [
            $invoice->invoice_number,
            $invoice->user->name,
            Date::dateTimeToExcel($invoice->created_at),
        ];
    }
}
