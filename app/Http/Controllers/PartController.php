<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartCreateRequest;
use App\Http\Requests\PartEditRequest;
use App\Models\Part;
use App\UseCases\PartService;
use Dotenv\Result\Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartController extends Controller
{
    private $service;

    public function __construct(PartService $service)
    {
        $this->service=$service;
        
    }
    public function index()
    {
        $parts=Part::all();
        return view('part.index',compact('parts'));
    }
   
    public function store(PartCreateRequest $request)
    {
        try{
            $this->service->create($request);
        }catch(\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
     
     return redirect()->back()->with('message','created ');
       
    }

   
    public function edit(Part $part)
    {
        return view('part.edit',compact('part'));
        
    }

   
    public function update(PartEditRequest $request, Part $part)
    {
        try{
            $this->service->edit($request,$part);
        }catch(\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect(route('part.index'))->with('message','updated ');
       
    }

   
    public function destroy(Part $part)
    {
        try{
            $this->service->destroy($part);
        }catch(\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->back()->with('message','deleted');
    }
    public function createPivot(Request $request){
        try{
            $this->service->createWithPivot($request);
        }catch(\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
           
        }
        return redirect()->back()->with('message','deleted'); 
    }
}
