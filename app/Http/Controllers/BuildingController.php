<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Building;
use App\Models\Customer;
use App\Models\Apartment;
use Illuminate\Http\Request;
use App\Exports\BuildingExport;
use App\Exports\ApartmentExport;
use App\UseCases\BuildingService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\QueryBuilder\QueryBuilder;

class BuildingController extends Controller
{
    protected $service;
    public function __construct(BuildingService $service)
    {   
        $this->service=$service;
        $this->middleware(['role:admin|manager'], ['except' => [
            'index','show'
        ]]);
    }
    
    public function index()
    {
        
        $query = QueryBuilder::for(Building::class);
        $query->allowedIncludes(['customer']);
        $query->orderBy('id', 'DESC');
        $buildings = $query->paginate(30);
        return view('building.index',compact('buildings'));
    }

   
    public function create()
    {
        $teams=Team::all();
        $customers=Customer::all();
        return view('building.create',compact('teams','customers'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'customer'=>'required|string',
            'floor'=>'required|integer|min:1',
            'cost'=>'nullable|integer|min:0',
            'teams'=>'required|array',
            'teams.*'=>'required|integer|exists:teams,id'
        ]);
        DB::beginTransaction();
        try{
            $building=Building::make($request->only('name','floor','cost','teams'));
            $customer = Customer::firstOrCreate(array('name' => $request->customer));
            $building->customer_id=$customer->id;
            $building->save();
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect(route('building.index'))->with('message', 'created successfully');
       
    }

   
    public function show($id)
    {
        $building=Building::where('id',$id)->with('apartments')->firstOrFail();
        
        return view('building.show',compact('building'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    $building=Building::where('id',$id)->with('customer')->firstOrFail();
        $teams=Team::all();
        $customers=Customer::all();
        return view('building.edit',compact('teams','customers','building'));
        
    }

    
    public function update(Request $request, Building $building)
    {
        
        $request->validate([
            'name'=>'required|string|max:255',
            'customer'=>'required|string',
            'floor'=>'required|integer',
            'cost'=>'nullable',
            'teams'=>'required|array',
            'teams.*'=>'required|integer|exists:teams,id'
        ]);
        try{
            $customer = Customer::firstOrCreate(array('name' => $request->customer));
            $request['customer_id']=$customer->id;
           $building->update($request->only('name','floor','cost','teams','customer_id'));
           DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
      
        return redirect(route('building.index'))->with('message', 'created successfully');
    }

    
    public function destroy(Building $building)
    {
        $building->delete();
        return redirect()->back()->with('message','deleted');
    }

    public function report(Request $request, Building $building){
        
        return Excel::download(new ApartmentExport($request,$building->id), $building->name.'.xlsx');
    }

   
}
