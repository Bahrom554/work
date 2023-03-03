<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\UseCases\UserService;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserCreateRequest;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service=$service;
        $this->middleware(['role:admin|manager']);
        
    }
    public function index(Request $request)
    {
      $users=$this->service->index($request);
      return view('users.index',compact('users'));
    }

    public function create(){
        $teams=Team::all();
        return view('users.create',compact('teams'));
    }


    public function store(UserCreateRequest $request)
    {
        $user=$this->service->create($request);

        return redirect(route('user.index'))->with('message','created');
    }

    public function edit(User $user){
        $teams=Team::all();
        
           return view('users.edit',compact('user','teams'));
    }
    public function update(UserEditRequest $request, User $user)
    {
        if($request->filled('password')){
            $this->validate($request,[
                'password'=>'required|string|min:6',
            ]);
            $this->service->resetPassword($request, $user->id);
        }
        $this->service->edit($user->id,$request);
        return redirect(route('user.index'))->with('message','updated Successfully');

    }

  

    public function destroy(User $user)
    {
        if(!$user->hasRole(User::ROLE_ADMIN)){
            $this->service->remove($user->id);
        }
        return redirect()->back();
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }


}
