<?php
namespace App\UseCases;

use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PartEditRequest;
use App\Http\Requests\PartCreateRequest;
use App\Models\Apartment;

class PartService
{
    public function index(){

    }
    public function create(PartCreateRequest $request){
        if($part=Part::where('name',$request->name)->where('type',$request->type)->first()){
            return $part;
        }
         return Part::create($request->only('name','type'));
    }
    public function edit(PartEditRequest $request,Part $part){
        if($isexist=Part::where('id','<>',$part->id)->where('name',$request->name)->where('type',$request->type)->first()){
            DB::table('apartment_parts')->where('part_id',$part->id)->update(['part_id'=>$isexist->id]);
             $part->delete();
            return $isexist;
        }
        return $part->update($request->only('name','type'));
    }

    public function destroy(Part $part){
        return $part->delete();
    }

    public function createWithPivot(Request $request){
        $request->validate([
            'part_id'=>'required|integer|exists:parts,id',
            'apartment_id'=>'required|integer|exists:apartments,id',
            'area'=>'required|integer',
            'users'=>'required|array',
            'users.*'=>'required|integer|exists:users,id'
        ]);
        DB::beginTransaction();
        try{
            if(DB::table('apartment_parts')->where('part_id',$request->part_id)->where('apartment_id',$request->apartment_id)->count()){
                return redirect()->back()->withErrors('it had created');
            }
            $part=Part::where('id',$request->part_id)->firstOrFail();
            $part->apartements()->attach($request->apartment_id,['area'=>$request->area,'users'=>json_encode($request->users)]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->back()->with('message','created successfully');
    }
}