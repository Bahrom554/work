<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use App\UseCases\UserService;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service=$service;
        
    }
    public function index(Request $request)
    {
      $users=$this->service->index($request);
      return view('users.index',compact('users'));
    }

    public function create(){
        return view('users.create');
    }


    public function store(UserCreateRequest $request)
    {
        $user=$this->service->create($request);

        return redirect(route('users.index'));
    }

    public function edit(User $user){
        return view('users.edit',compact('user'));
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
        return redirect(route('users.index'));

    }

    public function destroy(User $user)
    {
        if(!$user->isAdmin()){
            $this->service->remove($user->id);
        }
        return redirect()->back();
    }


}
