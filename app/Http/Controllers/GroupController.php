<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class GroupController extends Controller
{
    public function __construct()
    {
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = QueryBuilder::for(Group::class);
        $query->allowedIncludes(['users','buildings']);
        $query->orderBy('id', 'DESC');
        $groups = $query->paginate(30);
        return view('manager.group.index',compact('groups'));
    }

    public function create(){
        
        $users=User::whereNull('group_id')->role(User::ROLE_USER)->get();
        return view('manager.group.create',compact('users'));
    }
   
    public function store(Request $request)
    {
        
        $request->validate([
            'name'=>'required|string|max:255'
        ]);
        try{
            $group=Group::create($request->only('name'));
            if($request->filled('users')){
                $users=User::whereIn('id',$request->users)->get();
                foreach($users as $user){
                    $user->group_id=$group->id;
                    $user->save();
                }
            }
            DB::commit();

        } catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
        return redirect(route('group.index'))->with('message', 'created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group=Group::where('id',$id)->with(['users','buildings'])->firstOrFail();
        $users=User::whereNull('group_id')->role(User::ROLE_USER)->get();
        return view('manager.group.show',compact('group','users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
         if($request->filled('users')){
            $users=User::whereIn('id',$request->users)->get();
            foreach($users as $user){
                $user->group_id=$group->id;
                $user->save();
            }
            return redirect()->back();
        }
        $request->validate([
            'name'=>'required|string|max:255' 
         ]);
        $group->update($request->only('name'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->back();
    }

    public function removeFromGroup(Request $request ,User $user){
        if(!$user->group_id==$request->group_id){
            return redirect()->back();
        }
        $user->update(['group_id'=>null]);
        return redirect()->back()->with('message','member is removed!');

    }
}
