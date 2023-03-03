<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class TeamController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function index()
    {
        $query = QueryBuilder::for(Team::class);
        $query->allowedIncludes(['users']);
        $query->orderBy('id', 'DESC');
        $teams = $query->paginate(30);
        return view('team.index',compact('teams'));
    }

    public function create(){
        
        $users=User::whereNull('team_id')->role(User::ROLE_USER)->get();
        return view('team.create',compact('users'));
    }
   
    public function store(Request $request)
    {
        
        $request->validate([
            'name'=>'required|string|max:255'
        ]);
        DB::beginTransaction();
        try{
            $team=Team::create($request->only('name'));
            if($request->filled('users')){
                $users=User::whereIn('id',$request->users)->get();
                foreach($users as $user){
                    $user->team_id=$team->id;
                    $user->save();
                }
            }
            DB::commit();

        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect(route('team.index'))->with('message', 'created successfully');
    }

   
    public function show($id)
    {
        $team=Team::where('id',$id)->with(['users'])->firstOrFail();
        $users=User::whereNull('team_id')->role(User::ROLE_USER)->get();
        return view('team.show',compact('team','users'));
    }

   
    public function edit(Team $team)
    {
        
    }


    public function update(Request $request, Team $team)
    {
         if($request->filled('users')){
            $users=User::whereIn('id',$request->users)->get();
            foreach($users as $user){
                $user->team_id=$team->id;
                $user->save();
            }
            return redirect()->back();
        }
        $request->validate([
            'name'=>'required|string|max:255' 
         ]);
        $team->update($request->only('name'));
        return redirect()->back();
    }

    
    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->back();
    }

    public function removeFromTeam(Request $request ,User $user){
        if(!$user->team_id==$request->team_id){
            return redirect()->back();
        }
        $user->update(['team_id'=>null]);
        return redirect()->back()->with('message','member is removed!');

    }
}
