<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Building;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = QueryBuilder::for(Building::class);
        $query->allowedIncludes(['group','customer']);
        $query->orderBy('id', 'DESC');
        $buildings = $query->paginate(30);
        return view('manager.building.index',compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups=Group::all();
        $customers=Customer::all();
        return view('manager.building.create',compact('groups','customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'customer'=>'required|string',
            'floor'=>'required|integer',
            'cost'=>'nullable',
            'group_id'=>'nullable|integer|exists:groups,id'
        ]);
        try{
            $building=Building::make($request->only('name','floor','cost','group_id'));
            $customer = Customer::firstOrCreate(array('name' => $request->customer));
            $building->customer_id=$customer->id;
            $building->save();
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
        return redirect(route('building.index'))->with('message', 'created successfully');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $building=Building::where('id',$id)->with('apartments','group')->firstOrFail();
        return view('manager.building.show',compact('building'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    $building=Building::where('id',$id)->with('group','customer')->firstOrFail();
        $groups=Group::all();
        $customers=Customer::all();
        return view('manager.building.edit',compact('groups','customers','building'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building $building)
    {
        
        $request->validate([
            'name'=>'required|string|max:255',
            'customer'=>'required|string',
            'floor'=>'required|integer',
            'cost'=>'nullable',
            'group_id'=>'nullable|integer|exists:groups,id'
        ]);
        try{
            $customer = Customer::firstOrCreate(array('name' => $request->customer));
            $request['customer_id']=$customer->id;
           $building->update($request->only('name','floor','cost','group_id'));
           DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
      
        return redirect(route('building.index'))->with('message', 'created successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        $building->delete();
        return redirect()->back()->with('message','deleted');
    }

   
}
