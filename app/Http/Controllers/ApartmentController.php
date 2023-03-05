<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\User;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\UseCases\ApartmentService ;

class ApartmentController extends Controller
{
    
    private $service;

    public function __construct(ApartmentService $service)
    {
        $this->service=$service;
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
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
            'floor'=>'required|integer',
            'apartment_number'=>'required|integer',
            'building_id'=>'required|integer|exists:buildings,id'
        ]);
        try{
            $apartment=Apartment::make($request->only('floor','apartment_number','building_id'));
            $apartment->save();
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
            
        }
        return redirect()->back()->with('message', 'created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    
        $result = DB::table('apartment_parts')->where('apartment_id',$id)->selectRaw('sum(area) as total')->first();
        
        $apartment=Apartment::where('id',$id)->with('building','parts')->firstOrFail();
        $apartment->total=$result->total ?? 0;
        $apartment->save();
        $users=User::whereIn('team_id',$apartment->building->teams ?? [])->get();
        $parts=Part::all();
        return view('apartment.show',compact('apartment','users','parts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
